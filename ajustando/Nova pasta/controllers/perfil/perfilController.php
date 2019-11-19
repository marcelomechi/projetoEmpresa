<?php

class PerfilController extends Controller{

        public function __construct() {
            $idTool = 1;
            
            $classe = new Usuarios(); 
            $classe -> deslogaPinInvalido($_SESSION['token']);                    
            $classe -> updateSession($_SESSION['PIN']);
            
            $verificaPermissao = $classe -> verificaPermissao($idTool);
            if($verificaPermissao == false){
                $this ->loadView('403');
                exit;
            }
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