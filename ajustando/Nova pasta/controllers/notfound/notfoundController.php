<?php

class NotFoundController extends Controller{
    
    public function __construct(){
        $classe = new Usuarios(); 
        $classe -> deslogaPinInvalido($_SESSION['token']);
    }
    
    
    public function index(){
        $this ->loadView("404");
    }
}




?>