<?php

class AjaxLoginController extends Controller {

    protected $tokenSistema;
    protected $email;

    public function __construct() {
        
    }

    public function index() {
        $dados = array(
            'pin' => '',
            'senha' => '',
            'nome' => '',
            'tipoRequisicao' => ''
        );

        /* verificar uma forma de comparar os dados recebidos do ajax com o que puxei do banco para saber se o login e a senha conferem. */

        $usuario = new Autenticacao();

        if ($_POST['tipo'] == 1) {

            if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

                $cpf = addslashes($_POST['id_usuario']);

                $retorno = $usuario->dadosUsuario($cpf);


                if ($retorno == false) {
                    $dados = array(
                        'logado' => false,
                        'tipoRequisicao' => 1
                    );

                    $this->loadViewAjax('login', 'ajaxLogin', $dados);
                } else {
                    $dados = array(
                        'pin' => $retorno['pin'],
                        'nome' => $retorno['nome'],
                        'usuarioAtivo' => $retorno['usuarioAtivo'],
                        'fotoPerfil' => $retorno['fotoPerfil'],
                        'tipo' => '1',
                        'loginUnico' => $retorno['loginUnico'],
                        'tipoRequisicao' => 1,
                        'validaSenhaCpf' => $retorno['validaSenhaCpf']
                    );

                    $this->loadViewAjax('login', 'ajaxLogin', $dados);
                }
            }
        } else if ($_POST['tipo'] == 2) {

            if (isset($_POST['senha']) && !empty($_POST['senha']) && isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {

                $login = addslashes($_POST['id_usuario']);
                $senha = addslashes($_POST['senha']);

                $retorno = $usuario->login($login, $senha);

                if ($retorno == false) {
                    $dados = array(
                        'logado' => 'senhaIncorreta',
                        'tipoRequisicao' => 1
                    );
                } else {
                    $dados = array(
                        'logado' => $retorno['status'],
                        'tipoRequisicao' => 1
                    );
                }



                $this->loadViewAjax('login', 'ajaxLogin', $dados);
            }
        }
    }

    public function validaDadosEmail() {
        if (!isset($_POST['cpfValidaRedefinir']) || empty($_POST['cpfValidaRedefinir'])) {
            echo "fail";
        } else {
            $cpfValidaRedefinir = $_POST['cpfValidaRedefinir'];

            $classe = new Autenticacao();

            $retorno = $classe->validaEmailCpf($cpfValidaRedefinir);

            if ($retorno == false) {
                echo "fail";
            } else {
                $_SESSION['tokenSistema'] = $retorno['tokenSistema'];
                $_SESSION['emailCadastrado'] = $retorno['emailCadastrado'];
            }
        }
    }

    public function resetSenha() {
        if (isset($_POST['novaSenha']) && !empty($_POST['novaSenha']) && isset($_POST['token']) && !empty($_POST['token'])) {
            if ($_POST['token'] == $_SESSION['tokenSistema']) {
                $classe = new Autenticacao();
                $novaSenha = addslashes($_POST['novaSenha']);
                $retorno = $classe->criaNovaSenha($novaSenha, $_SESSION['tokenSistema'], $_SESSION['emailCadastrado']);
                if ($retorno == true) {
                    unset($_SESSION['tokenSistema']);
                    unset($_SESSION['emailCadastrado']);
                    echo "success";
                } else {
                    unset($_SESSION['tokenSistema']);
                    unset($_SESSION['emailCadastrado']);
                    echo "fail";
                }
            } else {
                echo "failToken";
            }
        } else {
            unset($_SESSION['tokenSistema']);
            unset($_SESSION['emailCadastrado']);
            echo "fail";
        }
    }

    public function cadastraSenhaInicial(){
        if(isset($_POST['emailInicial']) && !empty($_POST['emailInicial']) && isset($_POST['senhaIncial']) && !empty($_POST['senhaIncial']) ){
               
            $emailInicial = addslashes($_POST['emailInicial']);
            $senhaInicial = addslashes($_POST['senhaIncial']);
    
            $classe = new Autenticacao();

            if($emailInicial == 'n_enviou'){
                $retorno = $classe -> cadastraSenhaInicial($senhaInicial);
            }else{
                $retorno = $classe -> cadastraSenhaInicial($senhaInicial,$emailInicial);
            }            

            if($retorno == true){
                echo "success";
            }else{
                echo "fail";
            }

        }
    }

}

?>