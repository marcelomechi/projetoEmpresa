<?php

class LogoutController extends Controller {

    public function __construct() {
        $classe = new Usuarios();
        $classe->desloga($_SESSION['PIN']);
        session_destroy();
    }

    public function index() {
        header("Location: " . BASE_URL . "login");
    }

    public function closeSession() {
        // $classe = new Usuarios();
        //$classe -> desloga($_SESSION['PIN']);
        // $classe -> criaLoginUnico($_SESSION['PIN'],$_SESSION['token']);
        header("Location: " . BASE_URL . "login");
    }

}

?>