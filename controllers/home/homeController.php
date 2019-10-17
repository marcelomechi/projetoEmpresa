<?php

class HomeController extends Controller{
	
        public function __construct() {
            Usuarios::verificaLogin();                        
            $classe = new Usuarios(); 
            //$verifica = $classe -> verificaLoginUnico($_SESSION['PIN'],$_SESSION['token']);
            $classe -> updateSession($_SESSION['PIN']);
            
        }
    
    
	public function index(){
		 $classe = new Usuarios();                       
            
                $_SESSION['relatorio'] = '';
                
                
                $dadosPessoais = $classe -> getPreferencias($_SESSION['PIN']);
                
     
	
		$dados = array(
			'nome' => $dadosPessoais['apelido'],
			'senha' => $_SESSION['senha'],
                        'tema' => $_SESSION['tema']
		);
		
		$this -> loadTemplate('home',$dados);
	}
        
   
}

?>