<?php

class testeController extends Controller{
    public function __construct() {
        session_destroy();
        
    }
    public function index(){
        header("Location: ".BASE_URL."login");
    }
}




?>