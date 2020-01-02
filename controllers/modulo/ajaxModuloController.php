<?php

class AjaxModuloController extends Controller {

    public function index() {
        $classe = new Modulos();

        if (isset($_POST['nomeMenu']) && isset($_POST['descricaoMenu']) && isset($_FILES['icone'])) {

            $classe->setNomeMenu($_POST['nomeMenu']);
            $classe->setDescricaoMenu($_POST['descricaoMenu']);
            $classe->setImagemMenu($_FILES['icone']);

            $retorno = $classe->criaNovoMenu();

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function submenu() {

        $classe = new Modulos();

        $classe->setNomeMenu($_POST['nomeMenu']);
        $classe->setDescricaoMenu($_POST['descricaoMenu']);
        $classe->setMenuReferencia($_POST['menuReferencia']);

        $retorno = $classe->criaNovoSubmenu();

        if ($retorno == true) {
            echo "success";
        } else {
            echo "success";
        }
    }

    public function gravaOrdenacao() {
        $classe = new Modulos();

        $retorno = $classe->updateOrdenacao($_POST['ordenacao']);

        if ($retorno == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function novaFerramenta() {
        $classe = new Modulos();

        if (isset($_POST['nomeFerramenta']) && isset($_POST['linkFerramenta']) && isset($_POST['descricaoFerramenta']) && isset($_POST['moduloReferencia']) && !empty($_POST['nomeFerramenta']) && !empty($_POST['descricaoFerramenta']) && !empty($_POST['moduloReferencia'])) {
            $classe->setNomeMenu($_POST['nomeFerramenta']);
            $classe->setLink(strtolower($_POST['linkFerramenta']));
            $classe->setDescricaoMenu($_POST['descricaoFerramenta']);
            $classe->setMenuReferencia($_POST['moduloReferencia']);

            $retorno = $classe->criaNovaFerramenta();

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function inativarMenu() {
        $classe = new Modulos();
        if (isset($_POST['idMenu']) && !empty($_POST['idMenu']) && isset($_POST['tipoExclusao']) && !empty($_POST['tipoExclusao'])) {
            $classe->setIdMenu($_POST['idMenu']);
            $tipoExclusao = addslashes($_POST['tipoExclusao']);

            $retorno = $classe->inativaMenu($tipoExclusao);

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function ativarMenu() {
        $classe = new Modulos();
        if (isset($_POST['idMenu']) && !empty($_POST['idMenu']) && isset($_POST['ativa']) && !empty($_POST['ativa'])) {
            $classe->setIdMenu($_POST['idMenu']);
            $tipoAtivacao = addslashes($_POST['ativa']);

            $retorno = $classe->ativaMenu($tipoAtivacao);

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function inativarFerramenta() {
        $classe = new Modulos();
        if (isset($_POST['idFerramenta']) && !empty($_POST['idFerramenta'])) {
            $classe->setIdFerramenta($_POST['idFerramenta']);

            $retorno = $classe->inativaFerramenta();

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function ativarFerramenta() {
        $classe = new Modulos();
        if (isset($_POST['idFerramenta']) && !empty($_POST['idFerramenta'])) {
            $classe->setIdFerramenta($_POST['idFerramenta']);

            $retorno = $classe->ativaFerramenta();




            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    public function carregaMenu() {
        $classe = new Modulos();
        $retorno = $classe->consultaMenus();

        $dados = array(
            'menu' => $retorno,
            'tipo' => 1
        );

        $this->loadViewAjax('modulo', 'ajaxModulo', $dados);
    }

    public function carregaFerramenta() {
        $classe = new Modulos();
        $retorno = $classe->consultaFerramentas();

        $dados = array(
            'ferramenta' => $retorno,
            'tipo' => 2
        );

        $this->loadViewAjax('modulo', 'ajaxModulo', $dados);
    }

    public function ordenar() {

        $dados = array(
            'moduloReferencia' => addslashes($_POST['idFerramenta'])
        );

        $_SESSION['relatorio'] = 'Módulos';
        $this->loadTemplate('ordenar', $dados, 'modulo');
    }

    public function inativarWfm() {
        if (isset($_POST['dataPrevisaoRetorno']) && isset($_POST['previsaoRetorno']) && isset($_POST['descricaoManutencao']) && !empty($_POST['dataPrevisaoRetorno']) && !empty($_POST['previsaoRetorno']) && !empty($_POST['descricaoManutencao'])) {
            $dataRetorno = addslashes($_POST['dataPrevisaoRetorno']);
            $horaRetorno = addslashes($_POST['previsaoRetorno']);
            $descricao = addslashes($_POST['descricaoManutencao']);

            $classe = new Modulos();

            $retorno = $classe->inativaWfm($dataRetorno, $horaRetorno, $descricao);

            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function removeMensagem503() {
        $classe = new Modulos();

        $retorno = $classe->removeMensagemManutencao();

        if ($retorno == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function carragaWfmInativo() {
        $classe = new Modulos();
        $retorno = $classe->carregaInativaWfm();


        $dados = array(
            'tabelaFerramentaInativa' => $retorno,
            'tipo' => 3
        );
                
        $this->loadViewAjax('modulo', 'ajaxModulo', $dados);
    }

}

?>