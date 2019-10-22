$(document).ready(function () {
    $('.modal').modal({
        //'onOpenEnd': iniciaCarousel,
        dismissible: false
    });

    $('.modal').modal('open');


    $('.cpf').mask('000.000.000-00', {reverse: true});



    $('#gravaAlteracaoSenha').on('click', function () {
        if ($("#cpf").val() == "" || $("#novaSenha").val() == "" || $("#confirmaNovaSenha").val() == "") {
            M.toast({html: 'Preencha todas as informações.', classes: 'red lighten-2'});
            return 0;
        } else {
            if ($("#novaSenha").val() != $("#confirmaNovaSenha").val()) {
                M.toast({html: 'As senhas não conferem, preencha novamente.', classes: 'red lighten-2'});
                $("#cpf").val("");
                $("#novaSenha").val("");
                $("#confirmaNovaSenha").val("");
                return 0;
            } else if ($("#novaSenha").val() == $("#confirmaNovaSenha").val() && $("#novaSenha").val() == $("#cpf").val() && $("#confirmaNovaSenha").val() == $("#cpf").val()) {
                M.toast({html: 'Por favor preencha uma senha diferente do seu CPF.', classes: 'red lighten-2'});
                $("#cpf").val("");
                $("#novaSenha").val("");
                $("#confirmaNovaSenha").val("");
                return 0;
            }
        }

        var cpf = $("#cpf").val().replace(/[^0-9]/g, '');
        var novaSenha = $("#novaSenha").val();
        var novaSenhaConfirma = $("#confirmaNovaSenha").val();

        $.ajax({
            url: 'http://10.11.194.42/ajaxHome',
            type: 'POST',
            async: false,
            data: {CPF: cpf, novaSenha: novaSenha, novaSenhaConfirma: novaSenhaConfirma},
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Senha alterada com sucesso!', classes: 'teal accent-4', completeCallback: function () {
                            $('.modal').modal('close');
                        }});
                    $("#cpf").val("");
                    $("#novaSenha").val("");
                    $("#confirmaNovaSenha").val("");
                } else {
                    M.toast({html: 'Não foi possível atender sua solicitação, verifique as informações preenchidas.', classes: 'red lighten-2'});
                    $("#cpf").val("");
                    $("#novaSenha").val("");
                    $("#confirmaNovaSenha").val("");
                }
            }
        });

    });

});