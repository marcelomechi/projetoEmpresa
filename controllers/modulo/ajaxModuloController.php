<?php

class AjaxModuloController extends Controller {

    public function index() {
        Usuarios::verificaLogin();
        $classe = new Modulos();

        if (isset($_POST['nomeMenu']) && isset($_POST['descricaoMenu']) && isset($_FILES['icone'])) {

            $classe->setNomeMenu($_POST['nomeMenu']);
            $classe->setDescricaoMenu($_POST['descricaoMenu']);
            $classe->setImagemMenu($_FILES['icone']);

            $retorno = $classe->criaNovoMenu();

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function submenu() {
        
        Usuarios::verificaLogin();
        $classe = new Modulos();
        
        $classe->setNomeMenu($_POST['nomeMenu']);
        $classe->setDescricaoMenu($_POST['descricaoMenu']);
        $classe->setMenuReferencia($_POST['menuReferencia']);

        $retorno = $classe->criaNovoSubmenu();

        if ($retorno == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }

}

?>