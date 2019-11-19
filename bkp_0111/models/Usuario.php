<?php

/**
 * Description of Usuario
 *
 * @author br03206
 */
class Usuario extends Pessoa {
    
    protected $pin;
    protected $apelido;
    protected $senha;
    protected $ativo;
    protected $perfilFerramenta;
    protected $telefone;
    protected $telefone2;
    protected $telefone3;
    protected $email;
    protected $idTemaPreferido;
    protected $exibirAniversario;
    protected $caminhoFoto;
    protected $idImagemFundo;
    protected $ferramentasLiberadas = array();
    protected $token;
    protected $deslogueAutomatico;
    
    public function __construct(){
        
    }
    
    public function getPin() {
        return $this->pin;
    }

    public function getApelido() {
        return $this->apelido;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getPerfilFerramenta() {
        return $this->perfilFerramenta;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getTelefone2() {
        return $this->telefone2;
    }

    public function getTelefone3() {
        return $this->telefone3;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdTemaPreferido() {
        return $this->idTemaPreferido;
    }

    public function getExibirAniversario() {
        return $this->exibirAniversario;
    }

    public function getCaminhoFoto() {
        return $this->caminhoFoto;
    }

    public function getIdImagemFundo() {
        return $this->idImagemFundo;
    }

    public function getFerramentasLiberadas() {
        return $this->ferramentasLiberadas;
    }

    public function getToken() {
        return $this->token;
    }

    public function getDeslogueAutomatico() {
        return $this->deslogueAutomatico;
    }

    public function setPin($pin) {
        $this->pin = $pin;
    }

    public function setApelido($apelido) {
        $this->apelido = $apelido;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function setPerfilFerramenta($perfilFerramenta) {
        $this->perfilFerramenta = $perfilFerramenta;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setTelefone2($telefone2) {
        $this->telefone2 = $telefone2;
    }

    public function setTelefone3($telefone3) {
        $this->telefone3 = $telefone3;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setIdTemaPreferido($idTemaPreferido) {
        $this->idTemaPreferido = $idTemaPreferido;
    }

    public function setExibirAniversario($exibirAniversario) {
        $this->exibirAniversario = $exibirAniversario;
    }

    public function setCaminhoFoto($caminhoFoto) {
        $this->caminhoFoto = $caminhoFoto;
    }

    public function setIdImagemFundo($idImagemFundo) {
        $this->idImagemFundo = $idImagemFundo;
    }

    public function setFerramentasLiberadas($ferramentasLiberadas) {
        $this->ferramentasLiberadas = $ferramentasLiberadas;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setDeslogueAutomatico($deslogueAutomatico) {
        $this->deslogueAutomatico = $deslogueAutomatico;
    }

        
     /* metodo para pegar as preferencias pessoais */

    public function getPreferencias() {
        
        $pin = $this ->getPin();
        
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
    
    
    /* carrega o menu de acordo com o perfil do Usuario */
    
    
    public function menu() {
        
        $pin = $this ->getPin();
        

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

            $_SESSION['ferramentasLiberadas'] = array();
            
            /* guarda em uma session as ferramentas liberadas para o usuário */
            foreach ($sql as $dados) {
                $_SESSION['ferramentasLiberadas'][] = $dados['ID_MODULO'];
            }

            foreach ($sql as $menuPrincipal):
                if ($menuPrincipal['QTDESUB'] == 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
                    if ($menuPrincipal['ID_MODULO'] == 1):
                        echo '<li><a href="' . BASE_URL . $menuPrincipal['CAMINHO_LINK'] . '" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['NOME_MODULO'] . '</a></li>';
                        echo '<li><div class="divider"></div></li>';
                    else:
                        echo '<li><a href="' . BASE_URL . $menuPrincipal['CAMINHO_LINK'] . '" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="' . BASE_URL . $menuPrincipal['CAMINHO_ICONE'] . '"></i>' . $menuPrincipal['NOME_MODULO'] . '</a></li>';
                    endif;

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
    
    
    
    
}
