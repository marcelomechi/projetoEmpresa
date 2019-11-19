<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModuloController extends Controller{

    public function __construct() {
            $idTool = 2;
        
            $classe = new Autenticacao(); 
            $classe -> deslogaTokenInvalido($_SESSION['TOKEN']);                    
            $classe -> updateSession($_SESSION['PIN']);
            
            $verificaPermissao = $classe -> verificaPermissao($idTool);
            if($verificaPermissao == false){
                $this ->loadView('403');
                exit;
            }
    }    
    
    public function index(){
        
        $dados = array();
        $_SESSION['relatorio'] = 'Módulos';
        $this -> loadTemplate('modulo',$dados);
    }
    
    public function ordenar($moduloReferencia = null){
        
    
        $dados = array(
            'moduloReferencia' => $moduloReferencia
        );
        
        $_SESSION['relatorio'] = 'Módulos';
        $this ->loadTemplate('ordenar',$dados,'modulo');
    }
    
}


?>