<?php

class PerfilController extends Controller{

	public function index(){
		$_SESSION['relatorio'] = 'Editar Perfil';
		$this -> loadTemplate('perfil',$dados);
	}

}

?>