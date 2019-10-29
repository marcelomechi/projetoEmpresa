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

    public function criaNovoMenu() {

        $envio = $this->enviaFoto();

        if ($envio != false) {
            $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ORDENACAO, TITULO_WEB, CAMINHO_ICONE, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO) VALUES ( ";
            $sql .= ":nomeModulo, :nomeMenu, :caminhoIcone, :descricao, now(), :responsavel, 1) ";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':nomeModulo', $this->getNomeMenu());
            $sql->bindValue(':nomeMenu', $this->getNomeMenu());
            $sql->bindValue(':caminhoIcone', $envio[1]);
            $sql->bindValue(':descricao', $this->getDescricaoMenu());
            $sql->bindValue(':responsavel', $_SESSION['PIN']);

            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->geraArquivos();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function criaNovoSubmenu() {
        $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ID_MODULO_REFERENCIA, ORDENACAO, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO )";
        $sql .= "VALUES(:nomeModulo, :id_modulo_referencia, :descricao, now(), :responsavel, 1)";
        $sql = $this->db->prepare($sql);

        $sql->bindValue(':nomeModulo', $this->getNomeMenu());
        $sql->bindValue(':id_modulo_referencia', $this->getMenuReferencia());
        $sql->bindValue(':descricao', $this->getDescricaoMenu());
        $sql->bindValue(':responsavel', $_SESSION['PIN']);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function carregaHeaderMenu() {
        $sql = "SELECT * FROM TB_WFM_MODULO WHERE CAMINHO_LINK IS NULL ";
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

    public function carregaMenuOrdenacao() {
        $sql = "SELECT SUB.ID_MODULO,
                       SUB.NOME_MODULO
                       FROM TB_WFM_MODULO SUB
                       LEFT JOIN TB_WFM_MODULO BASE ON BASE.ID_MODULO_REFERENCIA = SUB.ID_MODULO
                       WHERE SUB.ATIVO = 1
                       AND SUB.CAMINHO_LINK IS NULL
                       GROUP BY SUB.ID_MODULO ,
                                SUB.NOME_MODULO";
        
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetchAll();
            return $sql;
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

            $nomeClasse = ucfirst($this->getLinkMenu());
            $pastaController = $this->getLinkMenu();
            $codigoController = '<?php class ' . $nomeClasse . 'Controller extends Model { public function __construct(){ $idTool = ' . $id_modulo . '; $classe = new Usuarios(); $classe -> deslogaPinInvalido($_SESSION["token"]); $classe = updateSession($_SESSION["PIN"]); $verificaPermissao = $classe -> verificaPermissao($idTool);  if($verificaPermissao == false){ $this ->loadView("403"); exit; }    } public function index(){} } ?>';

            file_put_contents('controllers/' . $pastaController . '/' . $this->getLinkMenu() . 'php', $codigoController);
        } else {
            return false;
        }
    }

    private function criaPasta() {
        mkdir('controllers/' . $this->getLinkMenu(), 0755, true);
        mkdir('views/' . $this->getLinkMenu(), 0755, true);
        mkdir('views/' . $this->getLinkMenu() . '/' . 'assets/js', 0755, true);
        mkdir('views/' . $this->getLinkMenu() . '/' . 'assets/css', 0755, true);
        return true;
    }

    private function enviaFoto() {
        $foto = $this->getImagemMenu();
        $icone = $this->validaImagem();
        if ($icone != false) {
            $dadosImagem = explode("|", $icone);
            move_uploaded_file($foto['tmp_name'], 'assets/images/' . $dadosImagem[0]);
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

}
