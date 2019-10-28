<?php

class AjaxModuloController extends Controller {
    public function index(){
         Usuarios::verificaLogin();         
         $classe = new Modulos();
                        
             if(isset($_POST['nomeMenu']) && isset($_POST['linkMenu'])&& isset($_POST['descricaoMenu']) && isset($_POST['ordem']) && isset($_FILES['icone'])){
                                  
                 $classe -> setNomeMenu($_POST['nomeMenu']);
                 $classe ->setLinkMenu(strtolower($_POST['linkMenu']));
                 $classe -> setDescricaoMenu($_POST['descricaoMenu']);
                 $classe -> setOrdemMenu($_POST['ordem']);
                 $classe -> setImagemMenu($_FILES['icone']);
                 
                 $retorno = $classe -> criaNovoMenu();
                 
                 if($retorno == true){
                     echo "success";
                 }else{
                     echo "fail";
                 }
             }
         }
      
    public function asdf(){
        echo "metodo correto";
    }
         
         
         
    }

?>