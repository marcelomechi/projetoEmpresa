<?php

class HomeController extends Controller {

    public function __construct() {
       Autenticacao::verificaLogin();        
    }

    public function index() {
        
        $classe = new Usuario();
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