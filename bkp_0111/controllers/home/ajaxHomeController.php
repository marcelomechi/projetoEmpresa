<?php

class ajaxHomeController extends Controller {
    
        public function __construct() {
            $classe = new Usuarios(); 
            $classe -> deslogaPinInvalido($_SESSION['token']);                    
            $classe -> updateSession($_SESSION['PIN']);
        }
    
    public function index(){
        $classe = new Usuarios();  
        
        if(isset($_POST['CPF']) && isset($_POST['novaSenha']) && isset($_POST['novaSenhaConfirma']) && !empty($_POST['CPF']) && !empty($_POST['novaSenha']) && !empty($_POST['novaSenhaConfirma']) ){
        
            $atualiza = $classe -> gravaAlteracaoSenhaPerfil($_SESSION['PIN'], $_POST['CPF'], $_POST['novaSenha']);

            if($atualiza === true){
                $dados = array(
                    'atualizado' => 'success'
                );
            }else{
                $dados = array(
                    'atualizado' => 'fail'
                );
            }
            
            


                    $this->loadViewAjax('home', 'ajaxHome', $dados);            
            
        }      
                 
    }
    
    
}


?>