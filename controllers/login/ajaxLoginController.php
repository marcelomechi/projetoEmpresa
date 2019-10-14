<?php

class AjaxLoginController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        $dados = array(
            'pin' => '',
            'senha' => '',
            'nome' => ''
        );

        /* verificar uma forma de comparar os dados recebidos do ajax com o que puxei do banco para saber se o login e a senha conferem. */

        if ($_POST['tipo'] == 1) {

            if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

                $usuario = new Usuarios();
                $retorno = $usuario->dadosUsuario(addslashes($_POST['id_usuario']));

                if ($retorno == false) {
                    $dados = array(
                        'logado' => false
                    );

                    $this->loadViewAjax('login', 'ajaxLogin', $dados);
                } else {
                    $dados = array(
                        'pin' => $retorno['pin'],
                        'nome' => $retorno['nome'],
                        'id_perfil_acesso' => $retorno['id_perfil_acesso'],
                        'foto_perfil' => $retorno['foto_perfil'],
                        'tipo' => '1'
                    );

                    $this->loadViewAjax('login', 'ajaxLogin', $dados);
                }
            }
        } else if ($_POST['tipo'] == 2) {

            if (isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

                $login = addslashes($_POST['id_usuario']);
                $senha = addslashes($_POST['senha']);

                $usuario = new Usuarios();
                $retorno = $usuario->login($login, $senha);

                $dados = array(
                    'logado' => $retorno['status']
                );


                $this->loadViewAjax('login', 'ajaxLogin', $dados);
            }
        }
    }

}

?>