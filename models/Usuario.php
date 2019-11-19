<?php

/**
 * Description of Usuario
 *
 * @author br03206
 */
class Usuario extends Model {
    
    /* metodo para atualizar as sessions */
    
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
    
    
    /* desloga por token invalido */
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
    
    
    

    /* metodo para pegar as preferencias pessoais */

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
    
    
    /* exibe fotos para seleção de capa do menu */
    
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
            $this -> updateSession($_SESSION['PIN']);
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




    
    
    
    
    

    /* carrega o menu de acordo com o perfil do Usuario */

    public function menu() {

        $pin = $_SESSION['PIN'];


        $sql = "SELECT DISTINCT M.ID_MODULO,
                M.ID_MODULO_REFERENCIA,
                M.NOME_MODULO,
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
        $sql->bindValue(':PIN', $pin);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
          
        /* guardo em uma session as ferramentas liberadas para o usuario */
            $_SESSION['ferramentasLiberadas'] = array();

            foreach ($sql as $dados) {
                $_SESSION['ferramentasLiberadas'][] = $dados['ID_MODULO'];
            }

            foreach ($sql as $menuPrincipal):
                if ($menuPrincipal['QTDESUB'] == 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
                        echo '<li style="float:left; width:100%;"><a href="' . BASE_URL . $menuPrincipal['CAMINHO_LINK'] . '" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['NOME_MODULO'] . '</a></li>';
                elseif ($menuPrincipal['QTDESUB'] > 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
                    echo '<li>';
                    echo '<a class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['NOME_MODULO'] . '<i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>';
                    echo '<div class="collapsible-body">';
                    echo '<ul>';
                    foreach ($sql as $submenu):
                        if ($submenu['QTDESUB'] == 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO']):
                            echo '<li><a href="' . BASE_URL . $submenu['CAMINHO_LINK'] . '">' . $submenu['NOME_MODULO'] . '</a></li>';
                        elseif ($submenu['QTDESUB'] > 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO']):
                            echo '<ul class="collapsible">';
                            echo '<li>';
                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenu['NOME_MODULO'] . '</a>';
                            echo '<div class="collapsible-body">';
                            echo '<ul>';
                            foreach ($sql as $submenuNivel1):
                                if ($submenuNivel1['QTDESUB'] == 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO']):
                                    echo '<li><a href="' . BASE_URL . $submenuNivel1['CAMINHO_LINK'] . '">' . $submenuNivel1['NOME_MODULO'] . '</a></li>';
                                elseif ($submenuNivel1['QTDESUB'] > 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO']):
                                    echo '<ul class="collapsible">';
                                    echo '<li>';
                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel1['NOME_MODULO'] . '</a>';
                                    echo '<div class="collapsible-body">';
                                    echo '<ul>';
                                    foreach ($sql as $submenuNivel2):
                                        if ($submenuNivel2['QTDESUB'] == 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO']):
                                            echo '<li><a href="' . BASE_URL . $submenuNivel2['CAMINHO_LINK'] . '">' . $submenuNivel2['NOME_MODULO'] . '</a></li>';
                                        elseif ($submenuNivel2['QTDESUB'] > 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO']):
                                            echo '<ul class="collapsible">';
                                            echo '<li>';
                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel2['NOME_MODULO'] . '</a>';
                                            echo '<div class="collapsible-body">';
                                            echo '<ul>';
                                            foreach ($sql as $submenuNivel3):
                                                if ($submenuNivel3['QTDESUB'] == 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO']):
                                                    echo '<li><a href="' . BASE_URL . $submenuNivel3['CAMINHO_LINK'] . '">' . $submenuNivel3['NOME_MODULO'] . '</a></li>';
                                                elseif ($submenuNivel3['QTDESUB'] > 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO']):
                                                    echo '<ul class="collapsible">';
                                                    echo '<li>';
                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel3['NOME_MODULO'] . '</a>';
                                                    echo '<div class="collapsible-body">';
                                                    echo '<ul>';
                                                    foreach ($sql as $submenuNivel4):
                                                        if ($submenuNivel4['QTDESUB'] == 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO']):
                                                            echo '<li><a href="' . BASE_URL . $submenuNivel4['CAMINHO_LINK'] . '">' . $submenuNivel4['NOME_MODULO'] . '</a></li>';
                                                        elseif ($submenuNivel4['QTDESUB'] > 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO']):
                                                            echo '<ul class="collapsible">';
                                                            echo '<li>';
                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel4['NOME_MODULO'] . '</a>';
                                                            echo '<div class="collapsible-body">';
                                                            echo '<ul>';
                                                            foreach ($sql as $submenuNivel5):
                                                                if ($submenuNivel5['QTDESUB'] == 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO']):
                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel5['CAMINHO_LINK'] . '">' . $submenuNivel5['NOME_MODULO'] . '</a></li>';
                                                                elseif ($submenuNivel5['QTDESUB'] > 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO']):
                                                                    echo '<ul class="collapsible">';
                                                                    echo '<li>';
                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel5['NOME_MODULO'] . '</a>';
                                                                    echo '<div class="collapsible-body">';
                                                                    echo '<ul>';
                                                                    foreach ($sql as $submenuNivel6):
                                                                        if ($submenuNivel6['QTDESUB'] == 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO']):
                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel6['CAMINHO_LINK'] . '">' . $submenuNivel6['NOME_MODULO'] . '</a></li>';
                                                                        elseif ($submenuNivel6['QTDESUB'] > 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO']):
                                                                            echo '<ul class="collapsible">';
                                                                            echo '<li>';
                                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel6['NOME_MODULO'] . '</a>';
                                                                            echo '<div class="collapsible-body">';
                                                                            echo '<ul>';
                                                                            foreach ($sql as $submenuNivel7):
                                                                                if ($submenuNivel7['QTDESUB'] == 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO']):
                                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel7['CAMINHO_LINK'] . '">' . $submenuNivel7['NOME_MODULO'] . '</a></li>';
                                                                                elseif ($submenuNivel7['QTDESUB'] > 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO']):
                                                                                    echo '<ul class="collapsible">';
                                                                                    echo '<li>';
                                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel7['NOME_MODULO'] . '</a>';
                                                                                    echo '<div class="collapsible-body">';
                                                                                    echo '<ul>';
                                                                                    foreach ($sql as $submenuNivel8):
                                                                                        if ($submenuNivel8['QTDESUB'] == 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO']):
                                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel8['CAMINHO_LINK'] . '">' . $submenuNivel8['NOME_MODULO'] . '</a></li>';
                                                                                        elseif ($submenuNivel8['QTDESUB'] > 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO']):
                                                                                            echo '<ul class="collapsible">';
                                                                                            echo '<li>';
                                                                                            echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel8['NOME_MODULO'] . '</a>';
                                                                                            echo '<div class="collapsible-body">';
                                                                                            echo '<ul>';
                                                                                            foreach ($sql as $submenuNivel9):
                                                                                                if ($submenuNivel9['QTDESUB'] == 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO']):
                                                                                                    echo '<li><a href="' . BASE_URL . $submenuNivel9['CAMINHO_LINK'] . '">' . $submenuNivel9['NOME_MODULO'] . '</a></li>';
                                                                                                elseif ($submenuNivel9['QTDESUB'] > 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO']):
                                                                                                    echo '<ul class="collapsible">';
                                                                                                    echo '<li>';
                                                                                                    echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>' . $submenuNivel9['NOME_MODULO'] . '</a>';
                                                                                                    echo '<div class="collapsible-body">';
                                                                                                    echo '<ul>';
                                                                                                    foreach ($sql as $submenuNivel10):
                                                                                                        if ($submenuNivel10['ID_MODULO_REFERENCIA'] == $submenuNivel9['ID_MODULO']):
                                                                                                            echo '<li><a href="' . BASE_URL . $submenuNivel10['CAMINHO_LINK'] . '">' . $submenuNivel10['NOME_MODULO'] . '</a></li>';
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
    
    
    
    /* teste menu */
    
    public function carregaMenu(){
    
         $queryMenuPrincipal =   "
                                SELECT DISTINCT M.ID_MODULO
                                                , M.NOME_MODULO
                                                , M.ID_MODULO_REFERENCIA
                                                , M.TITULO_WEB
                                                , M.ID_WEB_MODULO
                                                , M.CAMINHO_ICONE
                                                , M.CAMINHO_LINK
                                                , M.ORDENACAO
                                FROM            TB_WFM_MODULO M
                                LEFT JOIN       TB_WFM_MODULO MSUB ON MSUB.ID_MODULO_REFERENCIA = M.ID_MODULO
                                WHERE           M.ATIVO = 1                     
                                AND             (
                                                M.ID_MODULO IN  (
                                                                SELECT      ID_MODULO 
                                                                FROM        TB_WFM_MODULO_ACESSO_PERFIL
                                                                WHERE       ID_PERFIL IN    (
                                                                                            SELECT      ID_PERFIL
                                                                                            FROM        TB_WFM_USUARIO_PERFIL
                                                                                            WHERE       PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                                                            )
                                                                )
                                                OR                                                               
                                                M.ID_MODULO IN  (
                                                                SELECT      ID_MODULO 
                                                                FROM        TB_WFM_MODULO_ACESSO_INDIVIDUAL
                                                                WHERE       PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                                AND         LIBERADO = 1 /* LIBERADO INDIVIDUAL */
                                                                )
                                                )
                                AND             M.ID_MODULO NOT IN  (
                                                                    SELECT  ID_MODULO 
                                                                    FROM    TB_WFM_MODULO_ACESSO_INDIVIDUAL
                                                                    WHERE   PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                                    AND     BLOQUEADO = 1 /* BLOQUEADO INDIVIDUAL */
                                                                    )
                                /* --PARA MENU PRINCIPAL-- */
                                AND                           M.ID_MODULO_REFERENCIA IS NULL                                
                                ORDER BY        M.ORDENACAO;
                                ";                                      

        $rsMenuPrincipal = $conexao -> prepare($queryMenuPrincipal);
        $rsMenuPrincipal -> execute();
        
        if (!$rsMenuPrincipal || $rsMenuPrincipal -> rowCount() == 0)
        {
            $menuCompleto = $menuCompleto.
                            "
                            <li>
                                <a href='#'>Sem permissões ...</a>
                            </li>
                            ";  
        }
        else
        {
            $dadosMenu = $rsMenuPrincipal->fetchAll();
 
            foreach($dadosMenu as $linhaMenu)
            {                               
                if(is_Null($linhaMenu['CAMINHO_LINK']))
                {
                    $link = '#';
                }
                else
                {
                    $link = $linhaMenu['CAMINHO_LINK'];
                };
                
                if(is_Null($linhaMenu['CAMINHO_ICONE']))
                {
                    $imgIcon = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                }
                else
                {
                    $imgIcon = "<img src='".$linhaMenu['CAMINHO_ICONE']."' style='width:20px; float:left; padding:3px; margin-top:-4px;'>";
                };
                
                $menuCompleto = $menuCompleto.  "
                                                <li>
                                                    <a href='$link'>$imgIcon".$linhaMenu['NOME_MODULO']."</a>
                                                ";
                carregaSubMenu($conexao, $linhaMenu['ID_MODULO']);  
                $menuCompleto = $menuCompleto.  "
                                                </li>
                                                ";
            }
        }           
        
        echo $menuCompleto;     
    }
    
    function carregaSubMenu($conexao, $idModuloReferencia)
    {
        global $menuCompleto;
        $querySubMenu = "
                        SELECT DISTINCT M.ID_MODULO
                                        , M.NOME_MODULO
                                        , M.ID_MODULO_REFERENCIA
                                        , M.TITULO_WEB
                                        , M.ID_WEB_MODULO
                                        , M.CAMINHO_ICONE
                                        , M.CAMINHO_LINK
                                        , M.ORDENACAO
                        FROM            TB_WFM_MODULO M
                        LEFT JOIN       TB_WFM_MODULO MSUB ON MSUB.ID_MODULO_REFERENCIA = M.ID_MODULO
                        WHERE           M.ATIVO = 1                     
                        AND             (
                                        M.ID_MODULO IN  (
                                                        SELECT      ID_MODULO 
                                                        FROM        TB_WFM_MODULO_ACESSO_PERFIL
                                                        WHERE       ID_PERFIL IN    (
                                                                                    SELECT      ID_PERFIL
                                                                                    FROM        TB_WFM_USUARIO_PERFIL
                                                                                    WHERE       PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                                                    )
                                                        )
                                        OR                                                               
                                        M.ID_MODULO IN  (
                                                        SELECT      ID_MODULO 
                                                        FROM        TB_WFM_MODULO_ACESSO_INDIVIDUAL
                                                        WHERE       PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                        AND         LIBERADO = 1 /* LIBERADO INDIVIDUAL */
                                                        )
                                        )
                        AND             M.ID_MODULO NOT IN  (
                                                            SELECT  ID_MODULO 
                                                            FROM    TB_WFM_MODULO_ACESSO_INDIVIDUAL
                                                            WHERE   PIN = ".$_SESSION['PIN']." /* PIN USUARIO LOGADO */
                                                            AND     BLOQUEADO = 1 /* BLOQUEADO INDIVIDUAL */
                                                            )
                        /* --PARA SUBMENU-- */
                        AND             M.ID_MODULO_REFERENCIA = ? /*VARIAVEL DO APP*/
                        ORDER BY        M.ORDENACAO;
                        ";      
        $rsSubMenu = $conexao -> prepare($querySubMenu);
        $rsSubMenu->bindValue(1, $idModuloReferencia);
        $rsSubMenu -> execute();    
        
        $contagemLinhas = $rsSubMenu -> rowCount();
        $dadosSubMenu = $rsSubMenu->fetchAll();         
        $statusForeach = 1;
        
        foreach($dadosSubMenu as $linhaSubMenu)
        {                                       
            $contagemLinhas = $contagemLinhas - 1;
            if(is_Null($linhaSubMenu['CAMINHO_LINK']))
            {
                $link = '#';
            }
            else
            {
                $link = $linhaSubMenu['CAMINHO_LINK'];
            };
            
            if($statusForeach == 1)
            {
                $menuCompleto = $menuCompleto.  "
                                                <ul class='dl-submenu'>
                                                    <li>
                                                        <a href='$link'>".$linhaSubMenu['NOME_MODULO']."</a>                                                                                                                
                                            ";
            }
            else
            {
                $menuCompleto = $menuCompleto.  "
                                                    <li>
                                                        <a href='$link'>".$linhaSubMenu['NOME_MODULO']."</a>                                                                                                                
                                            ";
            }

            carregaSubMenu($conexao, $linhaSubMenu['ID_MODULO'], $linhaSubMenu['NOME_MODULO']); 
            if($contagemLinhas == 0)
            {
                $menuCompleto = $menuCompleto.  "
                                                        </li>
                                                    </ul>
                                                ";
            }
            else
            {
                $menuCompleto = $menuCompleto.  "
                                                        </li>
                                                ";
            }
            $statusForeach = $statusForeach + 1;
        }       
    }

}
