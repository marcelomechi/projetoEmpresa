<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModuloController extends Controller{
    
    public $nomeMenu;
    public $descricao;
    public $fotoMenu;
    public $menuReferencia;
    
    
    public function getNomeMenu() {
        return $this->nomeMenu;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getFotoMenu() {
        return $this->fotoMenu;
    }

    public function getMenuReferencia() {
        return $this->menuReferencia;
    }

    public function setNomeMenu($nomeMenu) {
        $this->nomeMenu = $nomeMenu;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setFotoMenu($fotoMenu) {
        $this->fotoMenu = $fotoMenu;
    }

    public function setMenuReferencia($menuReferencia) {
        $this->menuReferencia = $menuReferencia;
    }

        
    
    
    public function __construct() {
            $idTool = 2;
        
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