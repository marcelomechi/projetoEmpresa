<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxAcessoController
 *
 * @author br03206
 */
class ajaxPermissaoController extends Controller {

    public function tabela() {
        $classe = new Permissao();
        $dados = $classe->tabelaFerramentas();

        echo json_encode($dados);
    }

    public function gravaAlteracao() {

        $classe = new Permissao();
        $retorno = $classe->gravaAlteracoes($_POST['idModulo'], $_POST['idPerfilSelecionado']);

        if ($retorno == true) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function gravaAlteracaoIndividual() {
        if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
            $classe = new Permissao();
            $retorno = $classe->gravaAcessoIndividual($_POST['cpf'], $_POST['idModulo']);
            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function removeAcessoIndividual() {
        if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
            $classe = new Permissao();
            $retorno = $classe->removeAcessoIndividual($_POST['cpf'], $_POST['idModulo']);
            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function consultaAcessosIndividual() {
        $classe = new Permissao();
        if (isset($_POST['cpfConsultaIndividual']) && !empty($_POST['cpfConsultaIndividual'])) {
            $retorno = $classe->consultaAcessoIndividual($_POST['cpfConsultaIndividual']);
            $dados = array(
                'acessosIndividuais' => $retorno,
                'tipo' => $_POST['tipo']
            );
            $this->loadViewAjax('permissao', 'ajaxPermissao', $dados);
        } else {
            return false;
        }
    }

    public function inativaPerfil() {
        $classe = new Permissao();
        if (isset($_POST['idPerfil']) && !empty($_POST['idPerfil'])) {
            $idPerfil = addslashes($_POST['idPerfil']);
            $retorno = $classe->inativaPerfil($idPerfil);
            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function ativaPerfil() {
        $classe = new Permissao();
        if (isset($_POST['idPerfil']) && !empty($_POST['idPerfil'])) {
            $idPerfil = addslashes($_POST['idPerfil']);
            $retorno = $classe->ativaPerfil($idPerfil);
            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function caregaTabelaPerfil() {
        $classe = new Permissao();

        $retorno = $classe->consultaPerfil();

        $dados = array(
            'tabelaPerfil' => $retorno,
            'tipo' => 2
        );

        $this->loadViewAjax('permissao', 'ajaxPermissao', $dados);
    }

    public function cadastraPerfil() {
        if (isset($_POST['nomePerfil']) && !empty($_POST['nomePerfil']) && isset($_POST['descricaoPerfil']) && !empty($_POST['descricaoPerfil']) && isset($_POST['nivelAcesso']) && !empty($_POST['nivelAcesso']) && isset($_POST['deslogue']) && !empty($_POST['deslogue'])) {
            $classe = new Permissao();

            $nomePerfil = strtoupper(addslashes($_POST['nomePerfil']));
            $descricaoPerfil = strtoupper(addslashes($_POST['descricaoPerfil']));
            $nivelAcesso = strtoupper(addslashes($_POST['nivelAcesso']));
            $deslogue = strtoupper(addslashes($_POST['deslogue']));

            $retorno = $classe->cadastraNovoPerfil($nomePerfil, $descricaoPerfil, $nivelAcesso, $deslogue);
            if ($retorno == true) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            return false;
        }
    }

    public function carregaTabelaConvidado() {
        $classe = new Permissao();
        $dadosConvidados = $classe->consultaConvidados();
        
            $dados = array(
                'tabelaConvidados' => $dadosConvidados === false ? array() : $dadosConvidados,
                'tipo' => 3
            );

            $this->loadViewAjax('permissao', 'ajaxPermissao', $dados);
    }

    public function visualizaDadoConvidado() {
        if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
            $classe = new Permissao();
            $retorno = $classe->consultaConvidadoIndividual($_POST['cpf']);

            if ($retorno != false) {
                $dados = array(
                    'dadosConvidado' => $retorno,
                    'tipo' => 4
                );

                $this->loadViewAjax('permissao', 'ajaxPermissao', $dados);
            }
        }
    }

    public function liberaConvidado() {
        if (isset($_POST['cpfConvidado']) && !empty($_POST['cpfConvidado'])) {
            $cpf = preg_replace("/[^0-9]/", "",$_POST['cpfConvidado']);

            $classe = new Permissao();
            $retorno = $classe->liberaUsuarioConvidado($cpf);
            if($retorno == true){
                echo "success";
            }else{
                echo "fail";
            }
        } else {
            return false;
        }
    }
    
    public function naoLiberaConvidado() {
        if (isset($_POST['cpfConvidado']) && !empty($_POST['cpfConvidado'])) {
            $cpf = preg_replace("/[^0-9]/", "",$_POST['cpfConvidado']);

            $classe = new Permissao();
            $retorno = $classe-> naoLiberaUsuarioConvidado($cpf);
            if($retorno == true){
                echo "success";
            }else{
                echo "fail";
            }
        } else {
            return false;
        }
    }

}
