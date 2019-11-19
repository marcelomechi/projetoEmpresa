<?php

class Modulos extends Model {
    /*
     * Responsável pela parte de módulos, cria, edita, deleta, inativa 
     *  
     * */

    public $idMenu;
    public $nomeMenu;
    public $ordemMenu;
    public $descricaoMenu;
    public $imagemMenu;
    public $menuReferencia;
    public $link;
    public $idFerramenta;

    function getIdMenu() {
        return $this->idMenu;
    }

    function getNomeMenu() {
        return $this->nomeMenu;
    }

    function getOrdemMenu() {
        return $this->ordemMenu;
    }

    function getDescricaoMenu() {
        return $this->descricaoMenu;
    }

    function getImagemMenu() {
        return $this->imagemMenu;
    }

    function getMenuReferencia() {
        return $this->menuReferencia;
    }

    public function getLink() {
        return $this->link;
    }

    public function getIdFerramenta() {
        return $this->idFerramenta;
    }

    function setIdMenu($idMenu) {
        $this->idMenu = $idMenu;
    }

    function setNomeMenu($nomeMenu) {
        $this->nomeMenu = $nomeMenu;
    }

    function setOrdemMenu($ordemMenu) {
        $this->ordemMenu = $ordemMenu;
    }

    function setDescricaoMenu($descricaoMenu) {
        $this->descricaoMenu = $descricaoMenu;
    }

    function setImagemMenu($imagemMenu) {
        $this->imagemMenu = $imagemMenu;
    }

    function setMenuReferencia($menuReferencia) {
        $this->menuReferencia = $menuReferencia;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setIdFerramenta($idFerramenta) {
        $this->idFerramenta = $idFerramenta;
    }

    public function criaNovoMenu() {

        $envio = $this->enviaFoto();

        if ($envio != false) {

            $sqlOrdem = "SELECT MAX(ORDENACAO) + 1 AS ORDEM FROM TB_WFM_MODULO WHERE ATIVO = 1 AND ID_MODULO_REFERENCIA IS NULL ";
            $sqlOrdem = $this->db->prepare($sqlOrdem);
            $sqlOrdem->execute();
            if ($sqlOrdem->rowCount() > 0) {
                $sqlOrdem = $sqlOrdem->fetch();
                $ordem = $sqlOrdem['ORDEM'];

                $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ORDENACAO, CAMINHO_ICONE, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO) VALUES ( ";
                $sql .= ":nomeModulo, :ordenacao, :caminhoIcone, :descricao, now(), :responsavel, 1) ";
                $sql = $this->db->prepare($sql);

                $sql->bindValue(':nomeModulo', $this->getNomeMenu());
                $sql->bindValue(':ordenacao', $ordem);
                $sql->bindValue(':caminhoIcone', $envio[1]);
                $sql->bindValue(':descricao', $this->getDescricaoMenu());
                $sql->bindValue(':responsavel', $_SESSION['PIN']);

                $sql->execute();

                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function criaNovoSubmenu() {
        $sqlOrdem = "SELECT CASE WHEN MAX(ORDENACAO) + 1 IS NULL THEN 1 ELSE MAX(ORDENACAO) + 1 END ORDEM FROM TB_WFM_MODULO WHERE ATIVO = 1 AND ID_MODULO_REFERENCIA = :id_modulo_referencia ";
        $sqlOrdem = $this->db->prepare($sqlOrdem);
        $sqlOrdem->bindValue(':id_modulo_referencia', $this->getMenuReferencia());

        $sqlOrdem->execute();
        if ($sqlOrdem->rowCount() > 0) {
            $sqlOrdem = $sqlOrdem->fetch();
            $ordem = $sqlOrdem['ORDEM'];

            $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ID_MODULO_REFERENCIA, ORDENACAO, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO )";
            $sql .= "VALUES(:nomeModulo, :id_modulo_referencia, :ordenacao, :descricao, now(), :responsavel, 1)";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':nomeModulo', $this->getNomeMenu());
            $sql->bindValue(':id_modulo_referencia', $this->getMenuReferencia());
            $sql->bindValue(':ordenacao', $ordem);
            $sql->bindValue(':descricao', $this->getDescricaoMenu());
            $sql->bindValue(':responsavel', $_SESSION['PIN']);

            $sql->execute();

            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* cria nova Ferramenta */

    public function criaNovaFerramenta() {

        if ($this->getMenuReferencia() == "principal") {

            $sqlOrdem = "SELECT CASE WHEN MAX(ORDENACAO) + 1 IS NULL THEN 1 ELSE MAX(ORDENACAO) + 1 END ORDEM FROM TB_WFM_MODULO WHERE ATIVO = 1 AND ID_MODULO_REFERENCIA IS NULL ";
            $sqlOrdem = $this->db->prepare($sqlOrdem);
            $sqlOrdem->execute();

            if ($sqlOrdem->rowCount() > 0) {
                $sqlOrdem = $sqlOrdem->fetch();
                $ordem = $sqlOrdem['ORDEM'];
            } else {
                return false;
            }

            $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ORDENACAO, CAMINHO_LINK, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO) ";
            $sql .= "VALUES(:nomeModulo, :ordenacao, :caminhoLink, :descricao, now(), :pin, 1)";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':nomeModulo', $this->getNomeMenu());
            $sql->bindValue(':ordenacao', $ordem);
            $sql->bindValue(':caminhoLink', $this->getLink());
            $sql->bindValue(':descricao', $this->getDescricaoMenu());
            $sql->bindValue(':pin', $_SESSION['PIN']);
        } else {
            $sqlOrdem = "SELECT CASE WHEN MAX(ORDENACAO) + 1 IS NULL THEN 1 ELSE MAX(ORDENACAO) + 1 END ORDEM FROM TB_WFM_MODULO WHERE ATIVO = 1 AND ID_MODULO_REFERENCIA = :id_modulo_referencia ";
            $sqlOrdem = $this->db->prepare($sqlOrdem);
            $sqlOrdem->bindValue(':id_modulo_referencia', $this->getMenuReferencia());
            $sqlOrdem->execute();

            if ($sqlOrdem->rowCount() > 0) {
                $sqlOrdem = $sqlOrdem->fetch();
                $ordem = $sqlOrdem['ORDEM'];
            } else {
                return false;
            }

            $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ID_MODULO_REFERENCIA, ORDENACAO, CAMINHO_LINK, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO) ";
            $sql .= "VALUES(:nomeModulo, :moduloReferencia, :ordenacao, :caminhoLink, :descricao, now(), :pin, 1)";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':nomeModulo', $this->getNomeMenu());
            $sql->bindValue(':moduloReferencia', $this->getMenuReferencia());
            $sql->bindValue(':ordenacao', $ordem);
            $sql->bindValue(':caminhoLink', $this->getLink());
            $sql->bindValue(':descricao', $this->getDescricaoMenu());
            $sql->bindValue(':pin', $_SESSION['PIN']);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $this->geraArquivos();
        } else {
            return false;
        }
    }

    public function carregaHeaderMenu() {
        $sql = "SELECT * FROM TB_WFM_MODULO WHERE CAMINHO_LINK IS NULL AND ID_MODULO NOT IN (0) ";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
            return $sql;
        } else {
            return false;
        }
    }

    /* carrega lista de menus para ordenaçao */

    public function carregaMenuOrdem($idModulo = null) {


        if (isset($idModulo) && !empty($idModulo)) {

            $sql = "SELECT * FROM TB_WFM_MODULO
                             WHERE ID_MODULO_REFERENCIA = :idModulo
                             AND ID_MODULO NOT IN (0)
                             AND ATIVO = 1
                             ORDER BY ORDENACAO";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $idModulo);
        } else {
            $sql = "SELECT * FROM TB_WFM_MODULO
                             WHERE CAMINHO_LINK IS NULL
                             AND ID_MODULO NOT IN (0)
                             AND ID_MODULO_REFERENCIA IS NULL
                             ORDER BY ORDENACAO";

            $sql = $this->db->prepare($sql);
        }
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
            return $sql;
        } else {
            return false;
        }
    }

    public function updateOrdenacao($dados) {
        foreach ($dados as $value) {
            if (empty($dados['idModuloReferencia']) || !isset($dados['idModuloReferencia'])) {
                $sql = "UPDATE TB_WFM_MODULO SET ORDENACAO = :ordem WHERE ID_MODULO = :idModulo";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':ordem', $value['ordemMenu']);
                $sql->bindValue(':idModulo', $value['idModulo']);
            } else {
                $sql = "UPDATE TB_WFM_MODULO SET ORDENACAO = :ordem WHERE ID_MODULO_REFERENCIA = :idModuloReferencia AND ID_MODULO = :idModulo";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(':ordem', $value['ordemMenu']);
                $sql->bindValue(':idModuloReferencia', $value['idModuloReferencia']);
                $sql->bindValue(':idModulo', $value['idModulo']);
            }
            $sql->execute();

            $this->gravaLog($value['idModulo'], 'ORDENACAO', $value['ordemMenu'], $_SESSION['PIN']);
        }
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    /* DEPOIS INCLUIR NA CRIAÇÃO DE FERRAMENTAS, ASSIM JÁ LIBERA ACESSO AO PERFIL ADM NA CRIAÇÃO */
    private function liberaPerfilAdm($id) {
        $sql = "INSERT INTO TB_WFM_MODULO_ACESSO_PERFIL VALUES (:id, 1 ) ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql -> execute();
        
        if($sql -> rowCount > 0 ){
            return true;
        }else{
            return false;
        }
        
    }

    /* logs */

    private function gravaLog($id, $coluna, $valor, $responsavel) {
        $log = "INSERT INTO LG_WFM_MODULO VALUES (:idModulo, :coluna, :valor, now(), :pin )";
        $log = $this->db->prepare($log);
        $log->bindValue(':idModulo', $id);
        $log->bindValue(':coluna', $coluna);
        $log->bindValue(':valor', $valor);
        $log->bindValue(':pin', $responsavel);
        $log->execute();

        if ($log->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* estrutura para gerar os arquivos quando for criar uma ferramenta (dar a opção de usar ou não ajax para criar ou não um controller e ajax pra ele. */

    private function geraArquivos() {
        $verifica = $this->criaPasta();

        if ($verifica == true) {
            $sql = "SELECT MAX(ID_MODULO) ID_MODULO FROM TB_WFM_MODULO WHERE RESPONSAVEL = :PIN ";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':PIN', $_SESSION['PIN']);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $id_modulo = $sql['ID_MODULO'];
            }

            $nomeClasse = ucfirst($this->getLink());
            $pastaController = $this->getLink();
            $codigoController = '<?php class ' . $nomeClasse . 'Controller extends Model { public function __construct(){ $idTool = ' . $id_modulo . '; $classe = new Validacoes(); $classe -> deslogaTokenInvalido($_SESSION["token"]); $verificaPermissao = $classe -> verificaPermissao($idTool);  if($verificaPermissao == false){ $this ->loadView("403"); exit; }    } public function index(){} } ?>';

            $arquivoJs = 'js' . ucfirst($this->getLink()) . '.js';
            $arquivoCss = 'custom' . ucfirst($this->getLink()) . '.css';

            file_put_contents('controllers/' . $pastaController . '/' . $this->getLink() . '.php', $codigoController);
            file_put_contents('views/' . $this->getLink() . '/assets/js/' . $arquivoJs, '');
            file_put_contents('views/' . $this->getLink() . '/assets/css/' . $arquivoCss, '');
            return true;
        } else {
            return false;
        }
    }

    private function criaPasta() {
        mkdir('controllers/' . $this->getLink(), 0755, true);
        mkdir('views/' . $this->getLink(), 0755, true);
        mkdir('views/' . $this->getLink() . '/' . 'assets/js', 0755, true);
        mkdir('views/' . $this->getLink() . '/' . 'assets/css', 0755, true);
        return true;
    }

    private function enviaFoto() {
        $foto = $this->getImagemMenu();
        $icone = $this->validaImagem();
        if ($icone != false) {
            $dadosImagem = explode("|", $icone);
            move_uploaded_file($foto['tmp_name'], $dadosImagem[1]);
            return $dadosImagem;
        } else {
            return false;
        }
    }

    private function validaImagem() {
        $imagem = $this->getImagemMenu();
        $nome = preg_replace('/\s+/', '', $this->getNomeMenu());

        if ($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png') {
            $tamanhoImagem = intval($imagem['size'] / 1024);
            if ($tamanhoImagem <= 800) {
                $extImagem = pathinfo($imagem['name'], PATHINFO_EXTENSION);
                $nomeImagem = $nome . '.' . strtolower($extImagem);
                $caminhoImagem = 'assets/images/iconesMenu/' . $nomeImagem;
                return $nomeImagem . '|' . $caminhoImagem;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* inativa menu */

    public function consultaMenus() {

        $sql = "SELECT *,CASE WHEN ID_MODULO_REFERENCIA IS NULL THEN 'PRINCIPAL' ELSE 'SUBMENU' END TIPO_MENU FROM TB_WFM_MODULO WHERE CAMINHO_LINK IS NULL AND ID_MODULO NOT IN (0) ";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
            return $sql;
        } else {
            return false;
        }
    }

    public function inativaMenu($tipo) {

        if ($tipo = 1) { // inativa menu e seus submenus
            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 0 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $this->getIdMenu());

            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->InativaSubmenu($this->getIdMenu());
                $this->gravaLog($this->getIdMenu(), 'ATIVO', 0, $_SESSION['PIN']);
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 0 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $this->getIdMenu());
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->gravaLog($this->getIdMenu(), 'ATIVO', 0, $_SESSION['PIN']);
                return true;
            } else {
                return false;
            }
        }
    }

    public function ativaMenu($tipo) {

        if ($tipo = 1) { // inativa menu e seus submenus
            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 1 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $this->getIdMenu());

            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->ativaSubMenu($this->getIdMenu());
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 1 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $this->getIdMenu());

            $sql->execute();

            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /* meteodo para inativar menus e submenus de forma infinita */

    public function InativaSubmenu($idModuloReferencia) {
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
                                                AND ID_MODULO   NOT IN (0)
						/* --PARA SUBMENU-- */
						AND             M.ID_MODULO_REFERENCIA = ? /*VARIAVEL DO APP*/
						ORDER BY        M.ORDENACAO;
						";
        $rsSubMenu = $this->db->prepare($querySubMenu);
        $rsSubMenu->bindValue(1, $idModuloReferencia);
        $rsSubMenu->execute();


        /*  var_dump($rsSubMenu -> rowCount());
          exit;
         */



        $contagemLinhas = $rsSubMenu->rowCount();
        $dadosSubMenu = $rsSubMenu->fetchAll();
        //$statusForeach = 1;

        foreach ($dadosSubMenu as $linhaSubMenu) {
            $contagemLinhas = $contagemLinhas - 1;


            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 0 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $linhaSubMenu['ID_MODULO']);

            $sql->execute();
            $this->gravaLog($linhaSubMenu['ID_MODULO'], 'ATIVO', 0, $_SESSION['PIN']);


            $this->InativaSubmenu($linhaSubMenu['ID_MODULO']);

            //$statusForeach = $statusForeach + 1;;
        }
    }

    function ativaSubMenu($idModuloReferencia) {
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
						WHERE           M.ATIVO = 0
                                                AND ID_MODULO NOT IN (0)
						/* --PARA SUBMENU-- */
						AND             M.ID_MODULO_REFERENCIA = ? /*VARIAVEL DO APP*/
						ORDER BY        M.ORDENACAO;
						";
        $rsSubMenu = $this->db->prepare($querySubMenu);
        $rsSubMenu->bindValue(1, $idModuloReferencia);
        $rsSubMenu->execute();


        /*  var_dump($rsSubMenu -> rowCount());
          exit;
         */



        $contagemLinhas = $rsSubMenu->rowCount();
        $dadosSubMenu = $rsSubMenu->fetchAll();
        //$statusForeach = 1;

        foreach ($dadosSubMenu as $linhaSubMenu) {
            $contagemLinhas = $contagemLinhas - 1;


            $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 1 WHERE ID_MODULO = :idModulo ";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(':idModulo', $linhaSubMenu['ID_MODULO']);

            $sql->execute();
            $this->gravaLog($linhaSubMenu['ID_MODULO'], 'ATIVO', 1, $_SESSION['PIN']);


            $this->ativaSubMenu($linhaSubMenu['ID_MODULO']);

            //$statusForeach = $statusForeach + 1;;
        }
    }

    /* ferramentas ativa e inativa */

    public function consultaFerramentas() {
        $sql = "SELECT * FROM TB_WFM_MODULO WHERE CAMINHO_LINK IS NOT NULL AND ID_MODULO NOT IN (0) ";
        $sql = $this->db->prepare($sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function inativaFerramenta() {
        $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 0 WHERE ID_MODULO = :idModulo ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idModulo', $this->getIdFerramenta());
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $this->gravaLog($this->getIdFerramenta(), 'ATIVO', 0, $_SESSION['PIN']);
            return true;
        } else {
            return false;
        }
    }

    public function ativaFerramenta() {
        $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 1 WHERE ID_MODULO = :idModulo ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idModulo', $this->getIdFerramenta());
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $this->gravaLog($this->getIdFerramenta(), 'ATIVO', 1, $_SESSION['PIN']);
            return true;
        } else {
            return false;
        }
    }

    public function carregaInativaWfm() {
        $sql = "select * from TB_WFM_MODULO where ID_MODULO = 0 and ATIVO = 0 AND ID_MODULO NOT IN (0) ";
        $sql = $this->db->prepare($sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql;
        } else {
            return false;
        }
    }

    public function inativaWfm($dataRetorno, $horaRetorno, $descricao) {
        $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 0, CRIACAO = NOW(), RESPONSAVEL = :pin WHERE ID_MODULO = 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':pin', $_SESSION['PIN']);
        $sql->execute();

        $codigoManutencao = '<?php $motivoManutencao = "' . $descricao . '"' . '; $horaPrevisaoRetorno = "' . $horaRetorno . '"' . '; $dataPrevisaoRetorno = "' . $dataRetorno . '" ?>';
        $nomeArquivo = 'dadosManutencao.php';
        $arquivoSemExtensao = 'dadosManutencao';


        if (file_exists('views/503/' . $nomeArquivo)) {
            $move = $this->moveArquivoParaLog($arquivoSemExtensao);

            if ($move == true) {
                file_put_contents('views/503/' . $nomeArquivo, $codigoManutencao);
                return true;
            } else {
                return false;
            }
        } else {
            file_put_contents('views/503/' . $nomeArquivo, $codigoManutencao);
        }
    }

    private function moveArquivoParaLog($arquivo) {

        $origem = 'views/503/' . $arquivo . '.php';
        // $renomeiaArquivo = rename($arquivo, $arquivo . date("Y-m-d H:i:s"));
        $dataLog = date("YmdHis");


        $destino = 'views/503/log/' . $arquivo . $dataLog . '.php';
        rename($origem, $destino);


        return true;
    }

    public function removeMensagemManutencao() {
        $sql = "UPDATE TB_WFM_MODULO SET ATIVO = 1, CRIACAO = NOW(), RESPONSAVEL = :pin WHERE ID_MODULO = 0 ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':pin', $_SESSION['PIN']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $arquivoSemExtensao = 'dadosManutencao';
            $retorno = $this->moveArquivoParaLog($arquivoSemExtensao);
            if ($retorno == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function verificaWorkforceManutencao() {
        $sql = "SELECT * FROM TB_WFM_MODULO WHERE ID_MODULO = 0 AND ATIVO = 0 ";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
