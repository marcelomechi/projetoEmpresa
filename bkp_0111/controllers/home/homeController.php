<?php

class HomeController extends Controller {

    public function __construct() {

        $classe = new Usuarios();
        $classe->deslogaPinInvalido($_SESSION['token']);
        $classe->updateSession($_SESSION['PIN']);
    }

    public function index() {
        $classe = new Usuarios();

        $_SESSION['relatorio'] = '';


        $dadosPessoais = $classe->getPreferencias($_SESSION['PIN']);



        $dados = array(
            'nome' => $dadosPessoais['apelido'],
            'senha' => $_SESSION['senha'],
            'tema' => $_SESSION['tema']
        );

        $this->loadTemplate('home', $dados);
    }

}

?>