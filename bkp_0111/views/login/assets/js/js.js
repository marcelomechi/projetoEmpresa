$(document).ready(function () {
    // inicia os modal
    $('.modal').modal({
        dismissible: false // Modal can be dismissed by clicking outside of the modal
    });

    $('.cpf').mask('000.000.000-00', {reverse: true});

    /*
     Autenticação de usuarios na aplicação
     1- Pega o nome de usuario e a foto de Perfil
     2- Valida a senha de acesso a ferramenta
     3- Valida os botões de voltar e acesso ao esqueci senha
     
     */

    // Autentica Nome de Usuario e foto de Perfil //

    var dados = "";

    $("#proximo").click(function () {
        
        if($("#usuarioLogin").val() == ""){
            $("#usuarioLogin").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        }
        
        $("#loadUsuario").removeAttr("hidden");
        $.ajax({
            url: 'http://10.11.194.42/ajaxLogin',
            type: 'POST',
            async: false,
            data: {id_usuario: $("#usuarioLogin").val().replace(/[^0-9]/g, ''), tipo: 1},
            success: function (r) {
                dados = r.split("|");
                //alert(dados);
                //return 0;

                if (r == false) {
                    $("#usuarioLogin").addClass("invalid");
                    $(".helper-text").attr('data-error', 'CPF não localizado.');
                    $("#loadUsuario").attr("hidden", "hidden");
                    return false;
                } else if (dados[1] == 0) {
                    $("#usuarioLogin").addClass("invalid");
                    $(".helper-text").attr('data-error', 'CPF inativo.');
                    return false;
                } else if (dados[3] == 'nok') {
                    $("#modalSessaoAberta").modal("open");
                    $("#loadUsuario").attr("hidden","hidden");
                    return false;
                } else {
                    $("#nomeUsuario").html(dados[0]);
                    $("#imagemUser").attr("src", dados[2]);
                    $("#cardUsuario").hide("slide", {direction: "left"}, 200, function () {
                        $("#cardSenha").show("slide", {direction: "right"}, 200);
                    });
                }
            }
        });
    });

    // autentica a senha do usuario e loga na aplicação //

    $("#logar").click(function () {
        
        if($("#passwordLogin").val() == ""){
            $("#passwordLogin").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        }
        
        
        $.ajax({
            url: 'http://10.11.194.42/ajaxLogin',
            type: 'POST',
            async: false,
            data: {senha: $("#passwordLogin").val(), tipo: 2, id_usuario: $("#usuarioLogin").val().replace(/[^0-9]/g, '')},
            success: function (r) {
                if (r == 'senhaIncorreta') {
                        $("#passwordLogin").addClass("invalid");
                        $(".helper-text").attr('data-error', 'Senha inválida.');
                } else {
                    window.location.href = r + 'home';
                }

            }

        });

    });

    // Valida o Botão Voltar, utilizando o click function dessa maneira ele não irá chamar os dois slides no mesmo instante e sim a cada clique //

    $("#voltar").click(function () {
        $("#loadUsuario").attr("hidden", "hidden");
        $("#cardSenha").hide("slide", {direction: "right"}, 200, function () {
            $("#cardUsuario").show("slide", {direction: "left"}, 200);
        });
    });

    // Exibe e oculta a recuperação de senha //

    $("#recuperaSenha").click(function () {
        $("#cardSenha").hide(200, function () {
            $("#cardEsqueciSenha").show(200);
        });
    });

    // Clique do botão cancelar e exibe a primeira parte do login //

    $("#cancelaEsqueciSenha").click(function () {
        $("#cardEsqueciSenha").hide(200, function () {
            $("#cardSenha").show(200);
        });
    });

    // clique do botão para exibir a redefinição de senha, parte 2 //

    $("#proximoRedefinirSenha").click(function () {
        $("#cardEsqueciSenha").hide("slide", {direction: "left"}, 200, function () {
            $("#cardNovaSenha").show("slide", {direction: "right"}, 200);
        });
    });

    // fecha o modal de senha alterada com sucesso //

    $("#fechaModalSenha").click(function () {
        $("#imagemUser").hide(200, function () {
            window.location.reload();
        });
    });

    /* FIM AUTENTICAÇÃO USUARIO */

});