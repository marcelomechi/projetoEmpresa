<?php

class HomeController extends Controller{
	

	public function __construct(){
		
		$login = new Usuarios();
		$login -> verificaLogin();

		//parent::__construct();
	}


	public function index(){
		
		$login = new Usuarios();
		$login -> verificaLogin();

		$dados = array(
			'nome' => 'marcelo',
			'sobrenome' => 'Mechi'
		);


		
		$this -> loadTemplate('home',$dados);
	}
}

?>