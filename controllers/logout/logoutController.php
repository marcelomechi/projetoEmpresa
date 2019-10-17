<?php

class LogoutController extends Controller{
    public function __construct() {
        $classe = new Usuarios();
        $classe -> desloga($_SESSION['PIN']);
        session_destroy();
        
    }
    public function index(){
        header("Location: ".BASE_URL."login");
    }
}




?>