<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);

if (isset($nome) && !empty($nome)){
    
    if(!isset($foto_perfil) || empty($foto_perfil)){
        $foto_perfil = "assets/images/default.png";
    }
    
    $primeiroNome = explode(' ', $nome);
    $dados = ucfirst(strtolower($primeiroNome[0])).'|'.$id_perfil_acesso.'|'.$foto_perfil;
    
    echo $dados;
}else{
    echo $logado.'|'.$statusLogin;

}





?>