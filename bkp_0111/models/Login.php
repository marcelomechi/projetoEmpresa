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
    
    
}
