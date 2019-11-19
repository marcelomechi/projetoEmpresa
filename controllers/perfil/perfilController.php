<?php

class PerfilController extends Controller{

        public function __construct() {
            $idTool = 3;
            
            $classe = new Validacoes(); 
            $classe ->deslogaTokenInvalido($_SESSION['TOKEN']);                    
            
            $verificaPermissao = $classe -> verificaPermissao($idTool);
            if($verificaPermissao == false){
                $this ->loadView('403');
                exit;
            }
        }
    
	public function index(){
		$dados = array();
		
		$preferencias = new Usuario();
		$dados = $preferencias -> getPreferencias($_SESSION['PIN']);

		$_SESSION['relatorio'] = 'Perfil Pessoal';
		$this -> loadTemplate('perfil',$dados);
	}    

}

?>