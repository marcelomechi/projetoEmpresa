<?php

class HomeController extends Controller{
	

	public function __construct(){
		
		$login = new Usuarios();
		$login -> verificaLogin();

		//parent::__construct();
	}


	public function index(){
		
		$usuarios = new Usuarios();

		$dados = array(
			'nome' => $usuarios -> getUsuario(),
			'sobrenome' => 'Mechi'
		);


		
		$this -> loadTemplate('home',$dados);
	}
}

?>