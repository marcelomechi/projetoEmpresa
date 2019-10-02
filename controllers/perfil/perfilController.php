<?php

class PerfilController extends Controller{

	public function index(){
		$dados = array();
		
		$preferencias = new Usuarios();
		$dados = $preferencias -> getPreferencias($_SESSION['CPF']);

		$_SESSION['relatorio'] = 'Perfil Pessoal';
		$this -> loadTemplate('perfil',$dados);
	}

}

?>