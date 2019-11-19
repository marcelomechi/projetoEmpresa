<?php

class NotFoundController extends Controller{
    
    public function __construct(){
       /* $classe = new Validacoes(); 
        $classe -> deslogaPinInvalido($_SESSION['token']);*/
    }
    
    
    public function index(){
        $this ->loadView("404");
    }
}




?>