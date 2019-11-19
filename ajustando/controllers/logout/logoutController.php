<?php

class LogoutController extends Controller {

    public function index() {
        $classe = new Autenticacao();

        $verifica = $classe->desloga($_SESSION['PIN'], 2);
           
        if ($verifica == true) {
            header("Location: " . BASE_URL . "login");
        } else {
            return false;
        }
    }

    public function closeSession() {
        $classe = new Autenticacao();

        $classe->desloga($_SESSION['PIN'], 1);
        header("Location: " . BASE_URL . "login");
    }

}

?>