<?php

// o parent só vai funcionar se a classe pai, nesse caso o Controller tiver um __construct, senão não funciona, pode deixar sem */


class LoginController extends Controller{
	
	public function __construct() {
		
	}

	public function index(){
		$dados = array();
		$this -> loadView('login',$dados);
	}

	public function entrar(){
		$usuario = new Usuarios();		
		
		$dados = array(
		 'id_usuario' => $usuario -> getUsuario()
		);

		//$this -> loadView('login',$dados);
	}
}



?>