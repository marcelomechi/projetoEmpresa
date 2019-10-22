<?php

/*
 * Classe que cuida dos acessos de usuários e dos menus
 * Funcao verificaLogin faz a verificação no banco se existe o login a partir do ajax
 * Funcao primeiroLogin faz a verificacao no banco se a senha e o login conferem a partir  do ajax assim carregando a index
 * Funcao menu carrega o menu de acordo com as informações de permissão do usuário, o menu pode ter até 10 níveis de submenus
 */

class Usuarios extends Model {

    public function verificaLogin() {

        /* se não tiver setado ou se tiver setado e tiver vazio */

        if (empty($_SESSION['PIN'])) {
            header("Location: " . BASE_URL . "login");
            session_destroy();
            exit;
        }
    }

    public function verificaPermissao($idTool) {
        /* verifica se o usuário tem permissão para acessar o módulo */
        if (in_array($idTool, $_SESSION['ferramentasLiberadas'])) {
            return true;
        } else {
            return false;
        }
    }

    public function deslogaPinInvalido($token) {
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

    private function criaLoginUnico($pin, $token) {

        $sql = "UPDATE TB_WFM_SESSAO SET TOKEN = :token, ATIVO = 1 WHERE PIN = :PIN";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->bindValue(':token', $token);

        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

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

            if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
                session_destroy();
                return true;
            } else {
                return false;
            }
        } else {
            /*
             * tipo 2 desloga na tela de login e derruba a sessao atual        * 
             */
            $sql = "UPDATE TB_WFM_SESSAO SET ATIVO = 0 WHERE PIN = :PIN AND TOKEN = :TOKEN";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':PIN', $pin);
            $sql->bindValue(':TOKEN', $_SESSION['token']);
            $sql->execute();

            $linhasAfetadas = $sql->rowCount();

            if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
                session_destroy();
                return true;
            } else {
                return false;
            }
        }
    }

    public function dadosUsuario($login) {

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
        $sql->bindValue(':cpf', $login);
        $sql->execute();



        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $nome = $sql['APELIDO'];
            $id_perfil_acesso = $sql['ATIVO'];
            $foto_perfil = $sql['CAMINHO_FOTO'];

            $_SESSION['token'] = uniqid() . date("YmdHis");
            $_SESSION['PIN'] = $sql['PIN'];

            $verifica = $this->verificaLoginUnico($_SESSION['PIN'], $_SESSION['token']);

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

    public function login($login, $senha) {
        $dados = array(
            'status' => ''
        );

        $sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL, IMFUNDO.CAMINHO_IMAGEM, P.EMAIL FROM TB_WFM_USUARIO U ";
        $sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.PIN = U.PIN ";
        $sql .= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.PIN = UP.PIN ";
        $sql .= "LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO ";
        $sql .= "LEFT JOIN TB_WFM_USUARIO USER ON USER.PIN = P.PIN ";
        $sql .= "WHERE U.CPF = :CPF ";
        $sql .= "AND USER.SENHA = md5(:senha) ";

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

    public function getPreferencias($pin) {

        $sql = "SELECT * FROM TB_WFM_PERFIL_PESSOAL P LEFT JOIN TB_WFM_IMAGEM_FUNDO IMFUNDO ON IMFUNDO.ID_IMAGEM_FUNDO = P.ID_IMAGEM_FUNDO ";
        $sql .= "WHERE P.PIN = :PIN ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $pin);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();


            if (empty($sql['CAMINHO_FOTO']) || !isset($sql['CAMINHO_FOTO'])) {
                $fotoPerfil = "assets/images/default.png";
            } else {
                $fotoPerfil = $sql['CAMINHO_FOTO'];
            }

            $_SESSION['foto_perfil'] = $fotoPerfil;
            $_SESSION['foto_menu'] = $sql['CAMINHO_IMAGEM'];

            $dados = array(
                'cpf' => $sql['PIN'],
                'telefone1' => $sql['TEL1'],
                'telefone2' => $sql['TEL2'],
                'telefone3' => $sql['TEL3'],
                'email' => $sql['EMAIL'],
                'id_tema_preferido' => $sql['ID_TEMA_PREFERIDO'],
                'exibir_aniversario' => $sql['EXIBIR_ANIVERSARIO'],
                'apelido' => $sql['APELIDO'],
                'caminhoFoto' => $fotoPerfil,
                'caminhoFundo' => $sql['CAMINHO_IMAGEM']
            );



            return $dados;
        } else {
            return false;
        }
    }

    /*
     * 	Upload Foto de Perfil
     *
     */

    public function gravaBackground($idBackground) {
        $sql = "UPDATE TB_WFM_PERFIL_PESSOAL ";
        $sql .= "SET ID_IMAGEM_FUNDO = :background ";
        $sql .= "WHERE PIN = :PIN ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':background', $idBackground);
        $sql->bindValue(':PIN', $_SESSION['PIN']);

        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function enviaFotoPerfil($imagem, $imagemFundo) {
        $nomeArquivo = $this->validaImagem($imagem);

        if ($nomeArquivo === false) {
            return false;
        } else {
            $this->validaDiretorio($_SESSION['CPF']);
            $caminho = 'assets/images/' . $_SESSION['CPF'] . '/' . $nomeArquivo;

            move_uploaded_file($imagem['tmp_name'], 'assets/images/' . $_SESSION['CPF'] . '/' . $nomeArquivo);
            $gravaImagem = $this->gravaFotoPerfilBackground($caminho, $imagemFundo);
            if ($gravaImagem === true) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function validaImagem($imagem) {
        if ($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png') {
            $tamanhoImagem = intval($imagem['size'] / 1024);
            if ($tamanhoImagem <= 400) {
                $extImagem = pathinfo($imagem['name'], PATHINFO_EXTENSION);
                $nomeImagem = $_SESSION['CPF'] . '.' . strtolower($extImagem);

                return $nomeImagem;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function validaDiretorio($diretorio) {
        if (is_dir('assets/images/' . $diretorio)):
            return true;
        else:
            mkdir('assets/images/' . $_SESSION['CPF'], 0755, true);
        endif;
    }

    private function gravaFotoPerfilBackground($caminhoFotoPerfil, $idImagemFundo) {
        $sql = "UPDATE TB_WFM_PERFIL_PESSOAL SET CAMINHO_FOTO = :caminhoPerfil, ID_IMAGEM_FUNDO = :idImagemFundo WHERE PIN = :PIN ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $_SESSION['PIN']);
        $sql->bindValue(':caminhoPerfil', $caminhoFotoPerfil);
        $sql->bindValue(':idImagemFundo', $idImagemFundo);
        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function gravaPreferenciasPessoais($dados) {

        $sql = "UPDATE TB_WFM_PERFIL_PESSOAL ";
        $sql .= "SET TEL1 = :telefoneFixo, ";
        $sql .= "TEL2 = :telefoneCelular, ";
        $sql .= "TEL3 = :telefoneRecado, ";
        $sql .= "EMAIL = :email, ";
        $sql .= "ID_TEMA_PREFERIDO = :id_tema, ";
        $sql .= "EXIBIR_ANIVERSARIO = :id_aniversario, ";
        $sql .= "APELIDO = :apelido ";
        $sql .= "WHERE PIN = :PIN ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':telefoneFixo', empty($dados['telefoneFixo']) ? NULL : $dados['telefoneFixo']);
        $sql->bindValue(':telefoneCelular', empty($dados['telefoneCelular']) ? NULL : $dados['telefoneCelular']);
        $sql->bindValue(':telefoneRecado', empty($dados['telefoneRecado']) ? NULL : $dados['telefoneRecado']);
        $sql->bindValue(':email', empty($dados['email']) ? NULL : $dados['email']);
        $sql->bindValue(':id_tema', $dados['tema']);
        $sql->bindValue(':id_aniversario', (int) $dados['aniversario'], PDO::PARAM_INT); // para campos BIT tenho que fazer isso.
        $sql->bindValue(':apelido', $dados['apelido']);
        $sql->bindValue(':PIN', $_SESSION['PIN']);

        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function gravaTema($tema) {

        $sql = "UPDATE TB_WFM_PERFIL_PESSOAL ";
        $sql .= "SET ID_TEMA_PREFERIDO = :idTema ";
        $sql .= "WHERE PIN = :PIN ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idTema', $tema);
        $sql->bindValue(':PIN', $_SESSION['PIN']);

        $sql->execute();

        $linhasAfetadas = $sql->rowCount();

        if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function gravaAlteracaoSenhaPerfil($PIN, $senhaAntiga, $senhaNova) {
        if (isset($senhaAntiga) && !empty($senhaAntiga) && isset($senhaNova) && !empty($senhaNova)) {
            if ($senhaNova == $_SESSION['CPF']) {
                return false;
            } else {
                $autentica = $this->verificaSenhaAtual($PIN, $senhaAntiga);

                if ($autentica === false) {
                    return false;
                } else {
                    $sql = "UPDATE TB_WFM_USUARIO ";
                    $sql .= "SET SENHA = md5(:senha) ";
                    $sql .= "WHERE PIN = :PIN ";

                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(':senha', $senhaNova);
                    $sql->bindValue(':PIN', $PIN);

                    $sql->execute();

                    $linhasAfetadas = $sql->rowCount();

                    if ($linhasAfetadas === 0 || $linhasAfetadas > 0) {
                        $_SESSION['senha'] = $senhaNova;
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }

    private function verificaSenhaAtual($PIN, $senhaAtual) {
        $sql = "SELECT * FROM TB_WFM_USUARIO ";
        $sql .= "WHERE PIN = :PIN ";
        $sql .= "AND SENHA = md5(:senha)";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $PIN);
        $sql->bindValue(':senha', $senhaAtual);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql;
        } else {
            return false;
        }
    }

    public function carregaCarousel() {
        $sql = "SELECT PIN, ";
        $sql .= "      FUNDO.ID_IMAGEM_FUNDO, ";
        $sql .= "      FUNDO.CAMINHO_IMAGEM, ";
        $sql .= "      FUNDO.ATIVO, ";
        $sql .= "      TPFUNDO.TIPO   ";
        $sql .= "FROM  TB_WFM_PERFIL_PESSOAL PERF ";
        $sql .= "RIGHT JOIN TB_WFM_IMAGEM_FUNDO FUNDO ON FUNDO.ID_IMAGEM_FUNDO = PERF.ID_IMAGEM_FUNDO ";
        $sql .= "JOIN  TB_WFM_IMAGEM_FUNDO_TIPO TPFUNDO ON TPFUNDO.ID_TIPO_FUNDO = FUNDO.ID_TIPO_FUNDO ";
        $sql .= "WHERE (PIN = :PIN OR PIN IS NULL) ";
        $sql .= "AND (FUNDO.ID_TIPO_FUNDO = 2 OR FUNDO.ID_TIPO_FUNDO IS NULL) ";
        $sql .= "ORDER BY PIN DESC, FUNDO.ID_IMAGEM_FUNDO ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $_SESSION['PIN']);
        $sql->execute();

        foreach ($sql as $img) {
            echo '<div id= "' . $img['ID_IMAGEM_FUNDO'] . '" class="carousel-item" href="#one!"><img src="' . BASE_URL . $img['CAMINHO_IMAGEM'] . '" class="backgroundImgPerfil"></div>';
        }
    }

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

    public function menu() {

        $sql = "SELECT DISTINCT M.ID_MODULO,
                M.ID_MODULO_REFERENCIA,
                M.TITULO_WEB,
                M.ID_WEB_MODULO,
                M.CAMINHO_ICONE,
                M.CAMINHO_LINK,
                COUNT(MSUB.ID_MODULO) AS QTDESUB,
                M.ORDENACAO
FROM TB_WFM_MODULO M
LEFT JOIN 	( 
			SELECT	*
            FROM	TB_WFM_MODULO
            WHERE 	ID_MODULO IN 	(
									SELECT ID_MODULO
									FROM TB_WFM_MODULO_ACESSO_PERFIL
									WHERE ID_PERFIL IN
										(
										SELECT ID_PERFIL
										FROM TB_WFM_USUARIO_PERFIL
										WHERE PIN = :PIN 
										)
									)
			)MSUB ON MSUB.ID_MODULO_REFERENCIA = M.ID_MODULO
WHERE M.ATIVO = 1
  AND (M.ID_MODULO IN
         (SELECT ID_MODULO
          FROM TB_WFM_MODULO_ACESSO_PERFIL
          WHERE ID_PERFIL IN
              (SELECT ID_PERFIL
               FROM TB_WFM_USUARIO_PERFIL
               WHERE PIN = :PIN ) )
       OR M.ID_MODULO IN
         (SELECT ID_MODULO
          FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL
          WHERE PIN = :PIN
            AND LIBERADO = 1 ))
  AND M.ID_MODULO NOT IN
    (SELECT ID_MODULO
     FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL
     WHERE PIN = :PIN
       AND BLOQUEADO = 1 )
GROUP BY M.ID_MODULO,
         M.TITULO_WEB,
         M.ID_WEB_MODULO,
         M.CAMINHO_ICONE,
         M.CAMINHO_LINK,
         M.ORDENACAO
ORDER BY M.ORDENACAO;";


        $sql = $this->db->prepare($sql);
        $sql->bindValue(':PIN', $_SESSION['PIN']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();

            $_SESSION['ferramentasLiberadas'] = array();
            
            /* guarda em uma session as ferramentas liberadas para o usuário */
            foreach ($sql as $dados) {
                $_SESSION['ferramentasLiberadas'][] = $dados['ID_MODULO'];
            }

            foreach ($sql as $menuPrincipal):
                if ($menuPrincipal['QTDESUB'] == 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
                    if ($menuPrincipal['ID_MODULO'] == 1):
                        echo '<li><a href="' . BASE_URL . $menuPrincipal['CAMINHO_LINK'] . '" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['TITULO_WEB'] . '</a></li>';
                        echo '<li><div class="divider"></div></li>';
                    else:
                        echo '<li><a href="' . BASE_URL . $menuPrincipal['CAMINHO_LINK'] . '" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['TITULO_WEB'] . '</a></li>';
                    endif;

                elseif ($menuPrincipal['QTDESUB'] > 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
                    echo '<li>';
                    echo '<a class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['TITULO_WEB'] . '<i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>';
                    echo '<div class="collapsible-body">';
                    echo '<ul>';
                    foreach ($sql as $submenu):
                        if ($submenu['QTDESUB'] == 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO']):
                            echo '<li><a href="' . BASE_URL . $submenu['CAMINHO_LINK'] . '">' . $submenu['TITULO_WEB'] . '</a></li>';
                        elseif ($submenu['QTDESUB'] > 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO']):
                            echo '<ul class="collapsible">';
                            echo '<li>';
                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenu['TITULO_WEB'] . '</a>';
                            echo '<div class="collapsible-body">';
                            echo '<ul>';
                            foreach ($sql as $submenuNivel1):
                                if ($submenuNivel1['QTDESUB'] == 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO']):
                                    echo '<li><a href="' . BASE_URL . $submenuNivel1['CAMINHO_LINK'] . '">' . $submenuNivel1['TITULO_WEB'] . '</a></li>';
                                elseif ($submenuNivel1['QTDESUB'] > 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO']):
                                    echo '<ul class="collapsible">';
                                    echo '<li>';
                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel1['TITULO_WEB'] . '</a>';
                                    echo '<div class="collapsible-body">';
                                    echo '<ul>';
                                    foreach ($sql as $submenuNivel2):
                                        if ($submenuNivel2['QTDESUB'] == 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO']):
                                            echo '<li><a href="' . BASE_URL . $submenuNivel2['CAMINHO_LINK'] . '">' . $submenuNivel2['TITULO_WEB'] . '</a></li>';
                                        elseif ($submenuNivel2['QTDESUB'] > 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO']):
                                            echo '<ul class="collapsible">';
                                            echo '<li>';
                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel2['TITULO_WEB'] . '</a>';
                                            echo '<div class="collapsible-body">';
                                            echo '<ul>';
                                            foreach ($sql as $submenuNivel3):
                                                if ($submenuNivel3['QTDESUB'] == 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO']):
                                                    echo '<li><a href="' . BASE_URL . $submenuNivel3['CAMINHO_LINK'] . '">' . $submenuNivel3['TITULO_WEB'] . '</a></li>';
                                                elseif ($submenuNivel3['QTDESUB'] > 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO']):
                                                    echo '<ul class="collapsible">';
                                                    echo '<li>';
                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel3['TITULO_WEB'] . '</a>';
                                                    echo '<div class="collapsible-body">';
                                                    echo '<ul>';
                                                    foreach ($sql as $submenuNivel4):
                                                        if ($submenuNivel4['QTDESUB'] == 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO']):
                                                            echo '<li><a href="' . BASE_URL . $submenuNivel4['CAMINHO_LINK'] . '">' . $submenuNivel4['TITULO_WEB'] . '</a></li>';
                                                        elseif ($submenuNivel4['QTDESUB'] > 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO']):
                                                            echo '<ul class="collapsible">';
                                                            echo '<li>';
                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel4['TITULO_WEB'] . '</a>';
                                                            echo '<div class="collapsible-body">';
                                                            echo '<ul>';
                                                            foreach ($sql as $submenuNivel5):
                                                                if ($submenuNivel5['QTDESUB'] == 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO']):
                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel5['CAMINHO_LINK'] . '">' . $submenuNivel5['TITULO_WEB'] . '</a></li>';
                                                                elseif ($submenuNivel5['QTDESUB'] > 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO']):
                                                                    echo '<ul class="collapsible">';
                                                                    echo '<li>';
                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel5['TITULO_WEB'] . '</a>';
                                                                    echo '<div class="collapsible-body">';
                                                                    echo '<ul>';
                                                                    foreach ($sql as $submenuNivel6):
                                                                        if ($submenuNivel6['QTDESUB'] == 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO']):
                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel6['CAMINHO_LINK'] . '">' . $submenuNivel6['TITULO_WEB'] . '</a></li>';
                                                                        elseif ($submenuNivel6['QTDESUB'] > 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO']):
                                                                            echo '<ul class="collapsible">';
                                                                            echo '<li>';
                                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel6['TITULO_WEB'] . '</a>';
                                                                            echo '<div class="collapsible-body">';
                                                                            echo '<ul>';
                                                                            foreach ($sql as $submenuNivel7):
                                                                                if ($submenuNivel7['QTDESUB'] == 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO']):
                                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel7['CAMINHO_LINK'] . '">' . $submenuNivel7['TITULO_WEB'] . '</a></li>';
                                                                                elseif ($submenuNivel7['QTDESUB'] > 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO']):
                                                                                    echo '<ul class="collapsible">';
                                                                                    echo '<li>';
                                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel7['TITULO_WEB'] . '</a>';
                                                                                    echo '<div class="collapsible-body">';
                                                                                    echo '<ul>';
                                                                                    foreach ($sql as $submenuNivel8):
                                                                                        if ($submenuNivel8['QTDESUB'] == 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO']):
                                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel8['CAMINHO_LINK'] . '">' . $submenuNivel8['TITULO_WEB'] . '</a></li>';
                                                                                        elseif ($submenuNivel8['QTDESUB'] > 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO']):
                                                                                            echo '<ul class="collapsible">';
                                                                                            echo '<li>';
                                                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel8['TITULO_WEB'] . '</a>';
                                                                                            echo '<div class="collapsible-body">';
                                                                                            echo '<ul>';
                                                                                            foreach ($sql as $submenuNivel9):
                                                                                                if ($submenuNivel9['QTDESUB'] == 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO']):
                                                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel9['CAMINHO_LINK'] . '">' . $submenuNivel9['TITULO_WEB'] . '</a></li>';
                                                                                                elseif ($submenuNivel9['QTDESUB'] > 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO']):
                                                                                                    echo '<ul class="collapsible">';
                                                                                                    echo '<li>';
                                                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel9['TITULO_WEB'] . '</a>';
                                                                                                    echo '<div class="collapsible-body">';
                                                                                                    echo '<ul>';
                                                                                                    foreach ($sql as $submenuNivel10):
                                                                                                        if ($submenuNivel10['ID_MODULO_REFERENCIA'] == $submenuNivel9['ID_MODULO']):
                                                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel10['CAMINHO_LINK'] . '">' . $submenuNivel10['TITULO_WEB'] . '</a></li>';
                                                                                                        endif;
                                                                                                    endforeach;
                                                                                                    echo '</ul>';
                                                                                                    echo '</div>';
                                                                                                    echo '</li>';
                                                                                                    echo '</ul>';
                                                                                                endif;
                                                                                            endforeach;
                                                                                            echo '</ul>';
                                                                                            echo '</div>';
                                                                                            echo '</li>';
                                                                                            echo '</ul>';
                                                                                        endif;
                                                                                    endforeach;
                                                                                    echo '</ul>';
                                                                                    echo '</div>';
                                                                                    echo '</li>';
                                                                                    echo '</ul>';
                                                                                endif;
                                                                            endforeach;
                                                                            echo '</ul>';
                                                                            echo '</div>';
                                                                            echo '</li>';
                                                                            echo '</ul>';
                                                                        endif;
                                                                    endforeach;
                                                                    echo '</ul>';
                                                                    echo '</div>';
                                                                    echo '</li>';
                                                                    echo '</ul>';
                                                                endif;
                                                            endforeach;
                                                            echo '</ul>';
                                                            echo '</div>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                        endif;
                                                    endforeach;
                                                    echo '</ul>';
                                                    echo '</div>';
                                                    echo '</li>';
                                                    echo '</ul>';
                                                endif;
                                            endforeach;
                                            echo '</ul>';
                                            echo '</div>';
                                            echo '</li>';
                                            echo '</ul>';
                                        endif;
                                    endforeach;
                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</li>';
                                    echo '</ul>';
                                endif;
                            endforeach;
                            echo '</ul>';
                            echo '</div>';
                            echo '</li>';
                            echo '</ul>';
                        endif;
                    endforeach;
                    echo '</ul>';
                    echo '</div>';
                    echo ('</li>');
                endif;
            endforeach;
        } else {
            return false;
        }
    }

}

?>