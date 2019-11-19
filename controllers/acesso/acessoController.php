<?php

class AcessoController extends Controller {

    public function __construct() {

        $idTool = 5;

        $classe = new Validacoes();
        $classe->deslogaTokenInvalido($_SESSION['TOKEN']);
        $classe->updateSession($_SESSION['PIN']);

        $verificaPermissao = $classe->verificaPermissao($idTool);
        if ($verificaPermissao == false) {
            $this->loadView('403');
            exit;
        }
    }

    public function index() {
        $dados = array();
        $_SESSION['relatorio'] = 'Perfis de Acesso';
        $this->loadTemplate('acesso', $dados);
    }

}

?>