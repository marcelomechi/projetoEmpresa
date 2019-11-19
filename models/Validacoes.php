<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validacao
 *
 * @author br03206
 */
class Validacoes extends Model {

    public function desloga($pin, $tipo) {
        /*
         * tipo 1 desloga na tela de login e derruba a sessao atual        * 
         */
        if ($tipo == 1) {
                         $sql = "UPDATE TB_WFM_SESSAO SET ATIVO = 0 WHERE PIN = :PIN ";

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
                $this->desloga($_SESSION['PIN'], 1);
                $_SESSION['PIN'] = '';
                $this->verificaLogin();
            }
        } else {
            $this->desloga($_SESSION['PIN'], 1);
            $_SESSION['PIN'] = '';
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

    /* metodo que verifica se o usuario tem o $_SESSION['pin'] preenchido */

    public static function verificaLogin() {
        if (empty($_SESSION['PIN'])) {
            header("Location: " . BASE_URL . "login");
            session_destroy();
            exit;
        }
        }




}
