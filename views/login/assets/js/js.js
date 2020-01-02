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

    $(document).on("click", "#proximo", function () {
        if ($("#usuarioLogin").val() == "") {
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
                    $(".helper-text").attr('data-error', 'Usuário não localizado.');
                    $("#loadUsuario").attr("hidden", "hidden");
                    return false;
                } else if (dados[1] == 0) {
                    $("#usuarioLogin").addClass("invalid");
                    $(".helper-text").attr('data-error', 'Usuário inativo.');
                    return false;
                } else if (dados[3] == 'nok') {
                    $("#modalSessaoAberta").modal("open");
                    $("#loadUsuario").attr("hidden", "hidden");
                    return false;
                }else if(dados[4] == 1){
                    $("#loadUsuario").attr("hidden", "hidden");                    
                    $("#nomeUsuarioAlteraSenhaInicial").html(dados[0]);
                    $("#cardUsuario").hide("slide", {direction: "left"}, 200, function () {
                        $("#cardAlteraSenhaInicial").show("slide", {direction: "right"}, 200);
                    });
                }else {
                    $("#loadUsuario").attr("hidden", "hidden");
                    $("#nomeUsuario").html(dados[0]);
                    $("#imagemUser").attr("src", dados[2]);
                    $("#cardUsuario").hide("slide", {direction: "left"}, 200, function () {
                        $("#cardSenha").show("slide", {direction: "right"}, 200);
                    });
                }
            }
        });
    });

    // grava a senha inicial e o email

    $(document).on("change","#ckEmail", function(){
        if($(this).is(':checked') == true){
            $("#emailCadastroInicial").removeAttr("disabled");
        }else{
            $("#emailCadastroInicial").attr("disabled","disabled");
            $("#emailCadastroInicial").val("");
            $("#emailCadastroInicial").removeClass("invalid");
        }
    });


    // cadastra senha inicial

    $(document).on("click", "#gravaCadastroInicial", function () {
        if($("#ckEmail").is(':checked') == true && $("#emailCadastroInicial").val() == ""){
                $("#emailCadastroInicial").addClass("invalid");
                $(".helper-text").attr('data-error', 'preencha este campo.');
        } else if ($("#senhaInicialCadastro").val() == "") {
            $("#senhaInicialCadastro").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else if ($("#senhaInicialCadastroConfirma").val() == "") {
            $("#senhaInicialCadastroConfirma").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        }else if($("#senhaInicialCadastro").val() != $("#senhaInicialCadastroConfirma").val()){
            $("#senhaInicialCadastroConfirma").addClass("invalid");
            $(".helper-text").attr('data-error', 'as senhas não conferem, preencha novamente.');
        }else {
            var senhaInicial = $("#senhaInicialCadastro").val();
            var emailCadastroInicial = $("#ckEmail").is(':checked') == false ? "n_enviou" : $("#emailCadastroInicial").val();
            $("#loadEnviaDadosAlteraSenhaInicial").removeAttr("hidden");           

                $.ajax({
                    url: '/ajaxLogin/cadastraSenhaInicial',
                    type: 'POST',
                    async: false,
                    data: {emailInicial: emailCadastroInicial, senhaIncial: senhaInicial},
                    success: function (r) {
                        if(r == "success"){
                            $("#loadEnviaDadosAlteraSenhaInicial").attr("hidden","hidden");  
                            $("#nomeUsuario").html(dados[0]);
                            $("#imagemUser").attr("src", dados[2]);
                            $("#cardAlteraSenhaInicial").hide("slide", {direction: "left"}, 200, function () {
                                $("#cardSenha").show("slide", {direction: "right"}, 200);
                            });
                        }else{
                            $("#loadEnviaDadosAlteraSenhaInicial").attr("hidden","hidden");  
                            M.toast({html: 'Não foi possível atender sua solicitação, verifique as informações preenchidas e tente novamente.', classes: 'red lighten-2'});
                            setTimeout(function(){                                
                                $("#cardAlteraSenhaInicial").hide("slide", {direction: "right"}, 200, function () {
                                    $("#cardUsuario").show("slide", {direction: "left"}, 200);
                                });
                            }, 4000);
                        }
                    }
                });           
        }
    });




    // autentica a senha do usuario e loga na aplicação //

    $("#logar").click(function () {

        if ($("#passwordLogin").val() == "") {
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
                //return false;
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

    $(document).on("click", "#recuperaSenha", function () {
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


    // fecha o modal de senha alterada com sucesso //

    $("#fechaModalSenha").click(function () {
        $("#imagemUser").hide(200, function () {
            window.location.reload();
        });
    });

    /* FIM AUTENTICAÇÃO USUARIO */

    /* VALIDA CPF E EMAIL E DISPARA EMAIL PARA VALIDAR SENHA */
    $(document).on("click", "#proximoRedefinirSenha", function () {
        if ($("#cpfResetSenha").val() == "") {
            $("#cpfResetSenha").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else {
            $("#loadRecuperaAcesso").removeAttr("hidden");
            $.ajax({
                url: '/ajaxLogin/validaDadosEmail',
                type: 'POST',
                async: false,
                data: {cpfValidaRedefinir: $("#cpfResetSenha").val().replace(/[^0-9]/g, '')},
                success: function (r) {
                    if (r == "fail") {
                        $("#loadRecuperaAcesso").attr("hidden", "hidden");
                        M.toast({html: 'Não foi possível concluir as alterações, verifique as informações preenchidas e tente novamente.', classes: 'red lighten-2'});
                    } else {
                        dados = r.split("|");
                        var tokenSistema = dados[0];
                        var email = dados[1];
                        $("#loadRecuperaAcesso").attr("hidden", "hidden");
                        $("#cardEsqueciSenha").hide("slide", {direction: "left"}, 200, function () {
                            $("#cardNovaSenha").show("slide", {direction: "right"}, 200);
                        });

                    }

                }

            });

        }




    });
    /* RESETA A SENHA */
    $(document).on("click", "#gravaAlteracaoSenha", function () {
        if ($("#novaSenha").val() == "") {
            $("#novaSenha").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else if ($("#novaSenhaValidacao").val() == "") {
            $("#novaSenhaValidacao").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else if ($("#novaSenhaValidacao").val() == "") {
            $("#novaSenhaValidacao").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else if ($("#tokenValidaNovaSenha").val() == "") {
            $("#tokenValidaNovaSenha").addClass("invalid");
            $(".helper-text").attr('data-error', 'preencha este campo.');
        } else {
            $("#loadEnviaDadosReset").removeAttr("hidden");

            if ($("#novaSenha").val() == $("#novaSenhaValidacao").val()) {
                $.ajax({
                    url: '/ajaxLogin/resetSenha',
                    type: 'POST',
                    async: false,
                    data: {novaSenha: $("#novaSenha").val(), token: $("#tokenValidaNovaSenha").val()},
                    success: function (r) {
                        if (r == "success") {
                            $("#loadEnviaDadosReset").attr("hidden", "hidden");
                            M.toast({html: 'Senha alterada com sucesso!', classes: 'teal accent-4'});
                            setTimeout(function(){
                                $("#cardNovaSenha").hide(200, function () {
                                    $("#cardUsuario").show(200);
                                });
                            }, 4000);
                            
                            
                            //$('#modalSenhaAlteradaSucesso').modal('open');
                        } else if (r == "failToken") {
                            $("#loadEnviaDadosReset").attr("hidden", "hidden");
                            $("#tokenValidaNovaSenha").addClass("invalid");
                            $(".helper-text").attr('data-error', 'Token inválido, verifique as informações e tente novamente.');
                        } else {
                            $("#loadEnviaDadosReset").attr("hidden", "hidden");
                            M.toast({html: 'Não foi possível concluir as alterações, verifique as informações preenchidas e tente novamente.', classes: 'red lighten-2'});
                        }

                    }

                });
            } else {
                $("#loadEnviaDadosReset").attr("hidden", "hidden");
                $("#novaSenhaValidacao").addClass("invalid");
                $(".helper-text").attr('data-error', 'As senhas não conferem, preencha novamente.');
            }
        }
    });

});