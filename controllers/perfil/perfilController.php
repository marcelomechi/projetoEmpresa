<?php

class PerfilController extends Controller{

	public function index(){
		$dados = array();
		$_SESSION['relatorio'] = 'Perfil Pessoal';
		$this -> loadTemplate('perfil',$dados);
	}

}

?>