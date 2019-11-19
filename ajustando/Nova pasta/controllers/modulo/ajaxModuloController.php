<?php

class AjaxModuloController extends Controller {

    public function index() {
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
    
    public function gravaOrdenacao(){
        Usuarios::verificaLogin();
        $classe = new Modulos();       
       
        $retorno = $classe ->updateOrdenacao($_POST['ordenacao']);
        
        if($retorno == true){
            echo "success";
        }else{
            echo "fail";
        }
    }
    
    public function novaFerramenta(){
        $classe = new Modulos();  
        
        if(isset($_POST['nomeFerramenta']) && isset($_POST['descricaoFerramenta']) && isset($_POST['moduloReferencia']) && !empty($_POST['nomeFerramenta']) && !empty($_POST['descricaoFerramenta']) && !empty($_POST['moduloReferencia'])){
            $classe ->setNomeMenu($_POST['nomeFerramenta']);
            $classe ->setDescricaoMenu($_POST['descricaoFerramenta']);
            $classe ->setMenuReferencia($_POST['moduloReferencia']);
            $classe ->setLink(strtolower())           
            
        }else{
            
        }
    }

}

?>