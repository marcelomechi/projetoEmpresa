<?php

/**
 * Description of Login
 *
 * @author br03206
 */
class Autenticacao extends Model {

     /* pega os dados do usuario através do cpf */

    public function dadosUsuario($cpf) {
        $dados = array(
            'id_usuario' => '',
            'nome' => ''
        );

        $sql = "SELECT * FROM TB_WFM_USUARIO U ";
        $sql .= "JOIN TB_CAD_COLABORADOR C ON C.CPF = U.CPF ";
        $sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN ";
        $sql .= "WHERE U.CPF = :cpf ";
        $sql .= "LIMIT 1 ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':cpf', $cpf);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
  
            if (empty($sql['CAMINHO_FOTO']) || !isset($sql['CAMINHO_FOTO']) || $sql['CAMINHO_FOTO'] == null) {
               $_SESSION['foto_perfil'] = "assets/images/default.png";
            } else {
               $_SESSION['foto_perfil'] = $sql['CAMINHO_FOTO'];
            }

            
            /* tenho que preencher essa session para poder derrubar o login duplicado */
            $_SESSION['PIN'] = $sql['PIN'];
            
            $verifica = $this->verificaLoginUnico($_SESSION['PIN']);

            if ($verifica == true) {
                $dados = array(
                    'pin' => $sql['PIN'],
                    'nome' => $sql['APELIDO'],
                    'usuarioAtivo' => $sql['ATIVO'],
                    'fotoPerfil' => $sql['CAMINHO_FOTO'],
                    'loginUnico' => 'ok'
                );

                
            } else {

                $dados = array(
                    'pin' => $sql['PIN'],
                    'nome' => $sql['APELIDO'],
                    'usuarioAtivo' => $sql['ATIVO'],
                    'fotoPerfil' => $sql['CAMINHO_FOTO'],
                    'loginUnico' => 'nok'
                );
            }

            return $dados;
        } else {
            return false;
        }
    }

    /* Método de Login do Usuário */

    public function login($login, $senha) {

        $sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, group_concat(UP.ID_PERFIL) AS ID_PERFIL,IMFUNDO.CAMINHO_IMAGEM, P.EMAIL, MIN(PA.DESLOGUE_AUTOMATICO) AS DESLOGUE_AUTOMATICO FROM TB_WFM_USUARIO U ";
        $sql.= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN  ";
        $sql.= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.PIN = UP.PIN ";
        $sql.= "LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO  ";
        $sql.= "LEFT JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN ";
        $sql.= "JOIN TB_WFM_PERFIL_ACESSO PA ON PA.ID_PERFIL = UP.ID_PERFIL ";
        $sql.= " WHERE U.CPF = :cpf AND USER.SENHA = md5(:senha) ";
        $sql .= "GROUP BY U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL ";
        $sql = $this->db->prepare($sql);

        $sql->bindValue(':cpf', $login);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
              
            $_SESSION['TOKEN'] = uniqid() . date("YmdHis");
            $_SESSION['CPF'] = $sql['CPF'];
            $_SESSION['perfil'][] = $sql['ID_PERFIL'];
            $_SESSION['foto_menu'] = $sql['CAMINHO_IMAGEM'];
            $_SESSION['apelido'] = $sql['APELIDO'];
            $_SESSION['email'] = $sql['EMAIL'];
            $_SESSION['tema'] = $sql['ID_TEMA_PREFERIDO'];
            $_SESSION['senha'] = $sql['SENHA'];
            $_SESSION['perfilDeslogueAutomatico'] = $sql['DESLOGUE_AUTOMATICO'];

            $criaLogin = $this->criaLoginUnico($_SESSION['PIN'],$_SESSION['TOKEN']);

            if ($criaLogin == true) {
                $dados = array(
                    'status' => BASE_URL
                );
            } else {
                return false;
            }

            return $dados;
        } else {
            return false;
        }
    }

   
    /* verifica se o usuario está logado em outra máquina */

    public function verificaLoginUnico($pin) {
       
        $sql = "SELECT * FROM TB_WFM_SESSAO WHERE PIN = :PIN AND ATIVO = 1";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if ($sql['TOKEN'] == $_SESSION['token']) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    // cria o login unico no banco

    private function criaLoginUnico($pin,$token) {


        $sql = "UPDATE TB_WFM_SESSAO SET TOKEN = :token, ATIVO = 1 WHERE PIN = :PIN";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->bindValue(':token', $token);

        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

    
   
    

}
