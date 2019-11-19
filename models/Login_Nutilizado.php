<?php

/**
 * Description of Login
 *
 * @author br03206
 */
class Login extends Usuario{
    
    protected $token;
    
    public function __construct(){
        
    }
    
    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    
    /* Método de Login do Usuário */
    
    public function login() {
        
        $login = $this ->getCpf();
        $senha = $this ->getSenha();
                
        $sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL, MIN(PA.DESLOGUE_AUTOMATICO) AS DESLOGUE_AUTOMATICO FROM TB_WFM_USUARIO U ";
        $sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN ";
        $sql .= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.PIN = UP.PIN ";
        $sql .= "LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO ";
        $sql .= "LEFT JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN ";
        $sql .= "JOIN TB_WFM_PERFIL_ACESSO PA ON PA.ID_PERFIL = UP.ID_PERFIL ";
        $sql .= "WHERE U.CPF = :CPF ";
        $sql .= "AND USER.SENHA = md5(:senha) ";
        $sql .= "GROUP BY U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':CPF', $login);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['CPF'] = $sql['CPF'];
            $_SESSION['permissao'] = $sql['ID_PERFIL'];
            $_SESSION['foto_menu'] = $sql['CAMINHO_IMAGEM'];
            $_SESSION['apelido'] = $sql['APELIDO'];
            $_SESSION['email'] = $sql['EMAIL'];
            $_SESSION['tema'] = $sql['ID_TEMA_PREFERIDO'];
            $_SESSION['senha'] = $sql['SENHA'];
            $_SESSION['perfilTipo'] = $sql['DESLOGUE_AUTOMATICO'];

            $criaLogin = $this->criaLoginUnico($_SESSION['PIN'], $_SESSION['token']);

            if ($criaLogin == true) {
                $dados = array(
                    'status' => BASE_URL
                );
            } else {
                return false;
            }

            return $dados;
        } else {

            $dados = array(
                'status' => 'senhaIncorreta'
            );

            return $dados;
        }
    }
    
    /* metodo que verifica se o usuario tem o $_SESSION['pin'] preenchido */
    
    public static function verificaLogin() {

        if (empty($_SESSION['PIN']) && !isset($_SESSION['PIN'])) {
            
            header("Location: " . BASE_URL . "login");
            session_destroy();
            exit;
        }
    }
    
    public function dadosUsuario() {
        
        $usuario = $this ->getCpf();
        
        
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
        $sql->bindValue(':cpf', $usuario);
        $sql->execute();



        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $nome = $sql['APELIDO'];
            $id_perfil_acesso = $sql['ATIVO'];
            $foto_perfil = $sql['CAMINHO_FOTO'];

            /*$_SESSION['token'] = uniqid() . date("YmdHis");
            $_SESSION['PIN'] = $sql['PIN'];

            $verifica = $this->verificaLoginUnico($_SESSION['PIN'], $_SESSION['token']);*/

            if ($verifica == true) {
                $dados = array(
                    'pin' => $_SESSION['PIN'],
                    'nome' => $nome,
                    'id_perfil_acesso' => $id_perfil_acesso,
                    'foto_perfil' => $foto_perfil,
                    'loginUnico' => 'ok'
                );
            } else {

                $dados = array(
                    'pin' => $_SESSION['PIN'],
                    'nome' => $nome,
                    'id_perfil_acesso' => $id_perfil_acesso,
                    'foto_perfil' => $foto_perfil,
                    'loginUnico' => 'nok'
                );
            }


            if (empty($sql['CAMINHO_FOTO']) || !isset($sql['CAMINHO_FOTO'])) {
                $_SESSION['foto_perfil'] = "assets/images/default.png";
            } else {
                $_SESSION['foto_perfil'] = $sql['CAMINHO_FOTO'];
            }





            return $dados;
        } else {
            return false;
        }
    }
    
    /* verifica se o usuario está logado em outra máquina */
    
     public function verificaLoginUnico($pin, $token) {


        $sql = "SELECT * FROM TB_WFM_SESSAO WHERE PIN = :PIN AND ATIVO = 1";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if ($sql['TOKEN'] == $token) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    
    
    
    
}
