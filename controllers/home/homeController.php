<?php

class HomeController extends Controller {

    public function __construct() {

        Validacoes::verificaLogin();
    }

    public function index() {
        
        if (!in_array(1, $_SESSION['perfil'])) {
            $classe = new Modulos();
            $retorno = $classe->verificaWorkforceManutencao();
            if ($retorno == true) {
                $this->loadView("503");
                exit;
            }
        }



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