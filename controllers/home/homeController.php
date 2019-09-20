<?php

class HomeController extends Controller{
	



	public function index(){

		$_SESSION['relatorio'] = '';
		
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