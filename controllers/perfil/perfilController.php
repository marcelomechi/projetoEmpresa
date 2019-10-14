<?php

class PerfilController extends Controller{

        public function __construct() {
           Usuarios::verificaLogin();
            $updateSession = new Usuarios();                       
            $updateSession -> updateSession($_SESSION['PIN']);
        }
    
	public function index(){
		$dados = array();
		
		$preferencias = new Usuarios();
		$dados = $preferencias -> getPreferencias($_SESSION['PIN']);

		$_SESSION['relatorio'] = 'Perfil Pessoal';
		$this -> loadTemplate('perfil',$dados);
	}    

}

?>