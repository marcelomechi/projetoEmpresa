<?php

header("Content-Type: text/html;  charset=ISO-8859-1", true);

if ($tipoRequisicao == 1) {
    if (isset($nome) && !empty($nome)) {

        if (!isset($fotoPerfil) || empty($fotoPerfil)) {
            $fotoPerfil = "assets/images/default.png";
        }

        $primeiroNome = explode(' ', $nome);
        $dados = ucfirst(strtolower($primeiroNome[0])) . '|' . $usuarioAtivo . '|' . $fotoPerfil . '|' . $loginUnico . '|' . $validaSenhaCpf;

        echo $dados;
    } else {
        echo $logado;
    }
} elseif ($tipoRequisicao == 2) {
    echo $dados =  $tokenSistema . '|' . $emailSistema;
}
?>