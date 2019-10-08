<?php

echo $id_usuario;

?>

<script type="text/javascript">

/**
Nome: functions.js
Função: Toda codificação responsável pela manipulação dos dados no lado Cliente e funcionalidades AJAX é feita aqui.
*/
 
/** 
Aqui informamos ao navegador que, assim que o site for carregado, ele executará as instruções que estão neste bloco.
Igual o onload() que coloca-se na tag body do html 
*/
$(document).ready(function(){
 
  //abaixo usamos o seletor da jQuery para acessar o botão, e em seguida atribuir à ele um evento de click
  $("#btn_login").click(function(){
 
    //Aqui chamamos a função validaLogin(), e passamos à ela o ID dos campos que vamos manipular os valores
    validaLogin($("#login"), $("#senha"));
    /** Eu fazia isso aqui um pouco diferente, passando direto o valor do campo... Mas, com uma dica do
    William Moraes, adaptei dessa forma, que no final das contas, fica melhor, por estar trabalhando com 
    ponteiros no método, e não com o ID único dos input's  */
 
  });
 
});
 
/** Função responsável por validar os dados do formulário no lado Cliente, 
e enviar para a camada Controller (que está no Servidor) os dados informados pelo usuário para serem autenticados */
function validaLogin(login, senha){
 
  if(login.val() == ""){
    alert("Informe o login!"); //Exibe um alerta 
    login.focus(); //Adiciona foco ao campo login usando um ponteiro
    return; //retorna nulo
  }
  else if(senha.val() == ""){
    alert("Informe a senha!");
    senha.focus();
    return;
  }
  //Se o usuário informou login e senha, então é hora do Ajax entrar em ação
  else{
 
    //Adicionamos um texto na DIV #resultado para alertar o usuário que o sistema está autenticando os dados
    $("#resultado").html("Autenticando...");
 
    /**Função ajax nativa da jQuery, onde passamos como parâmetro o endereço do arquivo que queremos chamar, 
os dados que irá receber, e criamos de forma encadeada a função que irá armazenar o que foi retornado pelo servidor,
 para poder se trabalhar com o mesmo */
    $.post("controller/loginController.php?acao=autenticar", {login: login.val(), senha: senha.val()}, 
      function(retorno){
 
        //Insere na DIV #resultado o que foi retornado pelas classes de manipulação do Usuário (Se os dados estão corretos ou não)
        $("#resultado").html(retorno);
 
      } //function(retorno)
    ); //$.post()
 
  }
 
} //validaLogin()