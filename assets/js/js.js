$(document).ready(function(){
    // inicia os modal
    $('.modal').modal({
      dismissible: false, // Modal can be dismissed by clicking outside of the modal
    });


    // validacao de campos somente numericos (não está funcionando no onkeypress tenho que deixar a função na view)
    function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
        else  return false;
        }
    }


    /*
    Autenticação de usuarios na aplicação
    1- Pega o nome de usuario e a foto de Perfil
    2- Valida a senha de acesso a ferramenta
    3- Valida os botões de voltar e acesso ao esqueci senha

    */

    // Autentica Nome de Usuario e foto de Perfil //

    var dados = "";

    $("#proximo").click(function(){
        $("#loadUsuario").removeAttr("hidden");                
        $.ajax({
            url:'http://10.11.194.42/ajaxLogin',
            type:'POST',
            async: false,
            data:{id_usuario: $("#usuario").val(), tipo: 1},
            success: function(r) {
                dados = r.split("|")

                if(r == false){
		            $("#nLocalizado").removeAttr("hidden","hidden");
                    $("#loadUsuario").attr("hidden","hidden");
                    $("#inativo").attr("hidden","hidden");
                    return false;
                }else if(dados[1] == 0){
                    $("#inativo").removeAttr("hidden");
                    $("#loadUsuario").attr("hidden","hidden");
                    $("#nLocalizado").attr("hidden","hidden");
                    return false;
                }else{
                    $("#loadUsuario").attr("hidden","hidden");
                    $("#nLocalizado").attr("hidden","hidden");
                    $("#inativo").attr("hidden","hidden");
                    $("#nomeUsuario").html(dados[0]);
                    $("#cardUsuario").hide("slide", { direction: "left" }, 200, function(){
                    $("#cardSenha").show("slide", {direction: "right"}, 200);
                    });
                }
            }
        });
    });

    // autentica a senha do usuario e loga na aplicação //

    $("#logar").click(function(){
        $.ajax({
            url:'http://10.11.194.42/ajaxLogin',
            type:'POST',
            async: false,
            data:{senha: $("#password").val(), tipo: 2, id_usuario: $("#usuario").val()},
            success: function(r) {
                if(r == false){
                    $("#senhaInvalida").removeAttr("hidden")               
                }else{
                    window.location.href = r;
                }       
            }
        });

    });

    // Valida o Botão Voltar, utilizando o click function dessa maneira ele não irá chamar os dois slides no mesmo instante e sim a cada clique //

    $("#voltar").click(function(){
        $("#cardSenha").hide("slide", { direction: "right" }, 200, function(){
            $("#cardUsuario").show("slide", {direction: "left"}, 200);
        });
    });

    // Exibe e oculta a recuperação de senha //
    
    $("#recuperaSenha").click(function(){
        $("#cardSenha").hide(200, function(){
            $("#cardEsqueciSenha").show(200);
        });
    });

    // Clique do botão cancelar e exibe a primeira parte do login //
    
    $("#cancelaEsqueciSenha").click(function(){
        $("#cardEsqueciSenha").hide(200, function(){
            $("#cardSenha").show(200);
        });
    });

    // clique do botão para exibir a redefinição de senha, parte 2 //

        $("#proximoRedefinirSenha").click(function(){
        $("#cardEsqueciSenha").hide("slide", {direction: "left"}, 200, function(){
            $("#cardNovaSenha").show("slide", {direction: "right"}, 200);
        });
    });

    // fecha o modal de senha alterada com sucesso //

    $("#fechaModalSenha").click(function(){
            $("#teste").hide(200, function(){
            window.location.reload();
        });
    });

  /* FIM AUTENTICAÇÃO USUARIO */

});