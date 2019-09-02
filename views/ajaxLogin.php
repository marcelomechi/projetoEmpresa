<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);

if (isset($nome) && !empty($nome)){
    $primeiroNome = explode(' ', $nome);
    $dados = ucfirst(strtolower($primeiroNome[0])).'|'.$id_perfil_acesso;
    
    echo $dados;
}else{
    echo $logado;
}





?>