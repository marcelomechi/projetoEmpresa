<?php

class Controller {

    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        require 'views/' . $viewName . '/' . $viewName . '.php';
    }

    public function loadViewAjax($viewName, $viewAjax, $viewData = array()) {
        extract($viewData);
        require 'views/' . $viewName . '/' . $viewAjax . '.php';
    }

    /* aqui puxa o template do site (tudo que é exibido em todas as páginas, no caso o menu) */

    public function loadTemplate($viewName, $viewData = array(), $folder = NULL) {
        require 'views/template/template.php';
    }

    /* aqui ele vai carregar os dados do view no template que eu selecionei */

    public function loadViewInTemplate($viewName, $viewData = array(), $folder = NULL) { // coloquei o folder como parametro para casos de mais de uma view dentro de uma pasta
        extract($viewData); // o extract serve para extrair os dados do array e transformar em variáveis
        if (empty($folder) || !isset($folder)) {
            require 'views/' . $viewName . '/' . $viewName . '.php';
        } else {
            require 'views/' . $folder . '/' . $viewName . '.php';
        }
    }

    
}

?>