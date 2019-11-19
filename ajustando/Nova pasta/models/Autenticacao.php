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

        $sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL, MIN(PA.DESLOGUE_AUTOMATICO) AS DESLOGUE_AUTOMATICO FROM TB_WFM_USUARIO U ";
        $sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN ";
        $sql .= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.PIN = UP.PIN ";
        $sql .= "LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO ";
        $sql .= "LEFT JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN ";
        $sql .= "JOIN TB_WFM_PERFIL_ACESSO PA ON PA.ID_PERFIL = UP.ID_PERFIL ";
        $sql .= "WHERE U.CPF = :cpf ";
        $sql .= "AND USER.SENHA = md5(:senha) ";
        $sql .= "GROUP BY U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL ";
        $sql .= "LIMIT 1";
        $sql = $this->db->prepare($sql);

        $sql->bindValue(':cpf', $login);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            
            $_SESSION['TOKEN'] = uniqid() . date("YmdHis");
            $_SESSION['CPF'] = $sql['CPF'];
            $_SESSION['perfil'] = $sql['ID_PERFIL'];
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
    
     /* metodo que verifica se o usuario tem o $_SESSION['pin'] preenchido */

    public static function verificaLogin() {

        if (empty($_SESSION['PIN'])) {
            header("Location: " . BASE_URL . "login");
            session_destroy();
            exit;
        }
    }

    public function desloga($pin, $tipo) {
        /*
         * tipo 1 desloga na tela de login e derruba a sessao atual        * 
         */
        if ($tipo == 1) {

            $sql = "UPDATE TB_WFM_SESSAO SET ATIVO = 0 WHERE PIN = :PIN";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':PIN', $pin);
            $sql->execute();

            $linhasAfetadas = $sql->rowCount();

            if ($linhasAfetadas > 0) {
                session_destroy();
                return true;
            } else {
                return false;
            }
        } else {
            /*
             * tipo 2 desloga a sessao atual utilizando com o token como parametro   * 
             */
            $sql = "UPDATE TB_WFM_SESSAO SET ATIVO = 0 WHERE PIN = :PIN AND TOKEN = :TOKEN";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':PIN', $pin);
            $sql->bindValue(':TOKEN', $_SESSION['TOKEN']);
            $sql->execute();

            $linhasAfetadas = $sql->rowCount();
           
            if ($linhasAfetadas > 0) {
                session_destroy();
                return true;
            } else {
                return false;
            }
        }
    }
    
    
    /* Desloga Token inválido */
    
     public function deslogaTokenInvalido($token) {
        $sql = "SELECT * FROM TB_WFM_SESSAO WHERE ATIVO = 1 AND PIN = :PIN";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $_SESSION['PIN']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if ($sql['TOKEN'] == $token) {
                return true;
            } else {
                $_SESSION['PIN'] = "";
                $this->verificaLogin();
            }
        } else {
            $_SESSION['PIN'] = "";
            $this->verificaLogin();
        }
    }
    
    /* verifica se o usuário tem permissão de acesso a ferramenta */
    
     public function verificaPermissao($idTool) {
        if (in_array($idTool, $_SESSION['ferramentasLiberadas'])) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /* atualiza as sessions */
    
        public function updateSession($pin) {
        $sql = "SELECT * FROM TB_WFM_PERFIL_PESSOAL P LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO ";
        $sql .= "WHERE P.PIN = :PIN ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['apelido'] = $sql['APELIDO'];
            $_SESSION['email'] = $sql['EMAIL'];
            $_SESSION['foto_menu'] = $sql['CAMINHO_IMAGEM'];
            $_SESSION['foto_perfil'] = empty($sql['CAMINHO_FOTO']) ? "assets/images/default.png" : $sql['CAMINHO_FOTO'];
            $_SESSION['tema'] = $sql['ID_TEMA_PREFERIDO'];
            return true;
        } else {
            return false;
        }
    }
    

}
