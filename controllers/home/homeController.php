<?php

class HomeController extends Controller{
	
        public function __construct() {
            Usuarios::verificaLogin();
            $updateSession = new Usuarios();                       
            $updateSession -> updateSession($_SESSION['PIN']);
        }
    
    
	public function index(){
		$_SESSION['relatorio'] = 'Home';
	
		$dados = array(
			'nome' => 'marcelo',
			'sobrenome' => 'Mechi'
		);
		
		$this -> loadTemplate('home',$dados);
	}
}

?>