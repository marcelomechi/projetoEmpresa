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

            if (md5($sql['CPF']) == $sql['SENHA']) {
                $senhaCpf = 1;
            } else {
                $senhaCpf = 2;
            }

            /* if(!empty($sql['EMAIL'])){
              $_SESSION['email'] = $sql['EMAIL'];
              } */

            /* tenho que preencher essa session para poder derrubar o login duplicado */
            $_SESSION['PIN'] = $sql['PIN'];

            $verifica = $this->verificaLoginUnico($_SESSION['PIN']);

            if ($verifica == true) {
                $dados = array(
                    'pin' => $sql['PIN'],
                    'nome' => $sql['APELIDO'],
                    'usuarioAtivo' => $sql['ATIVO'],
                    'fotoPerfil' => $sql['CAMINHO_FOTO'],
                    'loginUnico' => 'ok',
                    'validaSenhaCpf' => $senhaCpf
                );
            } else {

                $dados = array(
                    'pin' => $sql['PIN'],
                    'nome' => $sql['APELIDO'],
                    'usuarioAtivo' => $sql['ATIVO'],
                    'fotoPerfil' => $sql['CAMINHO_FOTO'],
                    'loginUnico' => 'nok',
                    'validaSenhaCpf' => $senhaCpf
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
        $sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN  ";
        $sql .= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.PIN = UP.PIN ";
        $sql .= "LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO  ";
        $sql .= "LEFT JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN ";
        $sql .= "JOIN TB_WFM_PERFIL_ACESSO PA ON PA.ID_PERFIL = UP.ID_PERFIL ";
        $sql .= " WHERE U.CPF = :cpf AND USER.SENHA = md5(:senha) ";
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

            $criaLogin = $this->criaLoginUnico($_SESSION['PIN'], $_SESSION['TOKEN']);

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

    // reset senha

    public function validaEmailCpf($cpfuSER) {
        $tokenAlteraSenha = uniqid() . date("YmdHis");

        $sql = "SELECT * FROM TB_WFM_PERFIL_PESSOAL P JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN WHERE P.PIN = :pin AND USER.CPF = :cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':pin', $_SESSION['PIN']);
        $sql->bindValue(':cpf', $cpfuSER);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            if (empty($sql['EMAIL'])) {
                return 'empty';
            } else {

                $emailAlteraSenha = $sql['EMAIL'];

                $email = new Email();
                $retorno = $email->enviaEmail(1, 1, $sql['APELIDO'], $tokenAlteraSenha, $emailAlteraSenha);

                if ($retorno == false) {
                    return false;
                } else {
                    return array(
                        'tokenSistema' => $tokenAlteraSenha,
                        'emailCadastrado' => $emailAlteraSenha
                    );
                }
            }
        } else {
            return false;
        }
    }

    public function criaNovaSenha($novaSenha, $token, $email) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $insert = "INSERT INTO LG_WFM_USUARIO (PIN, SENHA, TOKEN, EMAIL, CRIACAO, IP, ORIGEM) VALUES (:pin, :senha, :token, :email, now(), :ip, :origem) ";
        $insert = $this->db->prepare($insert);
        $insert->bindValue(':pin', $_SESSION['PIN']);
        $insert->bindValue(':senha', md5($novaSenha));
        $insert->bindValue(':token', $token);
        $insert->bindValue(':email', $email);
        $insert->bindValue(':ip', $ip);
        $insert->bindValue(':origem', "ESQUECI A SENHA");
        $insert->execute();
        if ($insert->rowCount() > 0) {

            $update = "UPDATE TB_WFM_USUARIO SET SENHA = :senha WHERE PIN = :pin";
            $update = $this->db->prepare($update);
            $update->bindValue(':senha', md5($novaSenha));
            $update->bindValue(':pin', $_SESSION['PIN']);
            $update->execute();
            if ($update->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // cadastra senha inicial

    public function cadastraSenhaInicial($senha, $email = null) {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $sql = "UPDATE TB_WFM_USUARIO SET SENHA = :senha WHERE PIN = :pin ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':senha', md5($senha));
        $sql->bindValue(':pin', $_SESSION['PIN']);

        $sql->execute();

        $logUsuario = "INSERT INTO LG_WFM_USUARIO (PIN, SENHA, CRIACAO, IP, ORIGEM) VALUES (:pin, :senha, now(), :ip, 'TELA DE LOGIN')";
        $logUsuario = $this->db->prepare($logUsuario);
        $logUsuario->bindValue(':pin', $_SESSION['PIN']);
        $logUsuario->bindValue(':senha', md5($senha));
        $logUsuario->bindValue(':ip', $ip);

        $logUsuario->execute();

        if (isset($email) && !empty($email)) {
            $sqlPerfil = "UPDATE TB_WFM_PERFIL_PESSOAL SET email = :email WHERE PIN = :pin";
            $sqlPerfil = $this->db->prepare($sqlPerfil);
            $sqlPerfil->bindValue(':email', $email);
            $sqlPerfil->bindValue(':pin', $_SESSION['PIN']);

            $sqlPerfil->execute();

            $logPerfil = "INSERT INTO LG_WFM_PERFIL_PESSOAL (PIN, EMAIL, CRIACAO, RESPONSAVEL) VALUES (:pin, :email, now(), :pinResponsavel)";
            $logPerfil = $this->db->prepare($logPerfil);
            $logPerfil->bindValue(':pin', $_SESSION['PIN']);
            $logPerfil->bindValue(':email', $email);
            $logPerfil->bindValue(':pinResponsavel', $_SESSION['PIN']);

            $logPerfil->execute();
        }

        if (isset($email) && !empty($email)) {
            if ($sql->rowCount() > 0 && $sqlPerfil->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    // cadastra Usuário Convidado

    public function gravaUsuarioConvidado($dados = array()) {
        
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $valida = $this -> validaCadastroConvidado($dados['cpf']);

        if ($valida === true) {

            $sql = "INSERT INTO TP_CHRONUS_CONVIDADO_APROVACAO (CPF, NOME, FUNCAO, CEP, RUA, NUMERO, BAIRRO, CIDADE, SEXO, EMAIL, ATIVO, DESCRICAO_LIBERACAO,IP) 
                VALUES (
                            :cpf,
                            :nome,
                            :funcao,
                            :cep,
                            :rua,
                            :numero,
                            :bairro,
                            :cidade,
                            :sexo,
                            :email,
                            0,
                            :descricaoLiberacao,
                            :ip
                        )";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':cpf', $dados['cpf']);
            $sql->bindValue(':nome', $dados['nome']);
            $sql->bindValue(':funcao', $dados['cargo']);
            $sql->bindValue(':cep', $dados['cep']);
            $sql->bindValue(':rua', $dados['rua']);
            $sql->bindValue(':numero', $dados['numero'] == null ? null : $dados['numero']);
            $sql->bindValue(':bairro', $dados['bairro']);
            $sql->bindValue(':cidade', $dados['cidade']);
            $sql->bindValue(':sexo', $dados['sexo']);
            $sql->bindValue(':email', $dados['email']);
            $sql->bindValue(':descricaoLiberacao', $dados['descricao']);
            $sql->bindValue(':ip', $ip);
            $retorno = $sql->execute();

            if ($retorno) {
                return true;
            } else {
                return false;
            }
        }else{
            return -1;
        }
    }

    // verifica se o usuário existe no acesso convidado.
    private function validaCadastroConvidado($cpf) {
        $sql = "SELECT * FROM TP_CHRONUS_CONVIDADO_APROVACAO WHERE CPF = :cpf ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':cpf', $cpf);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    // cria o login unico no banco

    private function criaLoginUnico($pin, $token) {


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
