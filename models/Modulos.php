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
    public $linkMenu;

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

    function getLinkMenu() {
        return $this->linkMenu;
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

    function setLinkMenu($linkMenu) {
        $this->linkMenu = $linkMenu;
    }

    public function criaNovoMenu() {

        $envio = $this->enviaFoto();

        if ($envio != false) {
            $sql = "INSERT INTO TB_WFM_MODULO (NOME_MODULO, ORDENACAO, TITULO_WEB, ID_WEB_MODULO, CAMINHO_ICONE, CAMINHO_LINK, DESCRICAO, CRIACAO, RESPONSAVEL, ATIVO) VALUES ( ";
            $sql .= ":nomeModulo, :ordenacao, :nomeMenu, 'null', :caminhoIcone, :caminhoLink, :descricao, now(), :responsavel, 1) ";
            $sql = $this->db->prepare($sql);

            $sql->bindValue(':nomeModulo', $this->getNomeMenu());
            $sql->bindValue(':ordenacao', $this->getOrdemMenu());
            $sql->bindValue(':nomeMenu', $this->getNomeMenu());
            $sql->bindValue(':caminhoIcone', $envio[1]);
            $sql->bindValue(':caminhoLink', $this->getLinkMenu());
            $sql->bindValue(':descricao', $this->getDescricaoMenu());
            $sql->bindValue(':responsavel', $_SESSION['PIN']);

            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this -> geraArquivos();
                return true;
            } else {
                return false;
            }
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
        mkdir('views/' . $this->getLinkMenu().'/'.'assets/js', 0755, true);
        mkdir('views/' . $this->getLinkMenu().'/'.'assets/css', 0755, true);
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
