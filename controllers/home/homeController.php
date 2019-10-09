<?php

class HomeController extends Controller{
	
        public function __construct() {
            Usuarios::verificaLogin();
            $classe = new Usuarios();                       
            $classe -> updateSession($_SESSION['PIN']);
            
        }
    
    
	public function index(){
		$_SESSION['relatorio'] = '';
                
                
	
		$dados = array(
			'nome' => 'marcelo',
			'sobrenome' => 'Mechi',
                        'tema' => $_SESSION['tema']
		);
		
		$this -> loadTemplate('home',$dados);
	}
}

?>