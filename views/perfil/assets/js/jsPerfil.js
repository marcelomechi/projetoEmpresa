$(document).ready(function () {

    // altera foto do perfil
    $(".btn").change(function () {
        $("#img-upload").attr('src', URL.createObjectURL(event.target.files[0]));
    });

    $('.modal').modal({
        dismissible: false
    });

    // altera fundo de tela

    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });


    // para telefones de sp
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

    $('.sp_celphones').mask(SPMaskBehavior, spOptions);
    $('.phone_with_ddd').mask('(00) 0000-0000');


    $('#enviaFotos').on('click', function () {

        var dadosImg = new FormData();
        var arquivos = $('input[name=profileImg]')[0].files;
        var backgroundMenu = $("div .active").attr("id");


        if (arquivos.length > 0) {
            dadosImg.append('backgroundMenu', backgroundMenu);
            dadosImg.append('foto', arquivos[0]);
            dadosImg.append('tipo', 1);
        } else {
            dadosImg.append('backgroundMenu', backgroundMenu);
            dadosImg.append('tipo', 1);
        }

        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxPerfil',
            data: dadosImg,
            contentType: false,
            processData: false,
            success: function (r) {

                if (r == "success") {
                    M.toast({html: 'Alterações efetuadas com sucesso!', classes: 'teal accent-4'});
                } else {
                    M.toast({html: 'Não foi possível importar, verfique o tamanho e o tipo do arquivo.', classes: 'red lighten-2'});
                }

                $('.progress').addClass('hide');
            }
        });

    });



    $('#gravaPreferencias').on('click', function () {
        if ($("input[name=apelido]").val() == "") {
            M.toast({html: 'Preencha o campo "Como gostaria de ser chamado?".', classes: 'red lighten-2'});
            return 0;
        }

        /*var data = new FormData(); PARA CRIAR UM FORMULARIO VIA JAVASCRIPT TENHO QUE CHAMAR ESSA CLASSE E USAR O data.append para mandar os valores*/

        if ($("input[name=tema]").is(':checked')) {
            var tema = 1;
        } else {
            var tema = 0;
        }

        if ($("input[name=exibeAniversario]").is(':checked')) {
            var aniversario = 1;
        } else {
            var aniversario = 0;
        }


        var apelido = $("input[name=apelido]").val();
        var email = $("input[name=email]").val() === "" ? null : $("input[name=email]").val();
        var telefoneFixo = $("input[name=telefoneFixo]").val() === "" ? null : $("input[name=telefoneFixo]").val().replace(/[^0-9]/g, '');
        var telefoneCelular = $("input[name=telefoneCelular]").val() === "" ? null : $("input[name=telefoneCelular]").val().replace(/[^0-9]/g, '');
        var telefoneRecado = $("input[name=telefoneRecado]").val() === "" ? null : $("input[name=telefoneRecado]").val().replace(/[^0-9]/g, '');

        /* data.append('tema', tema);
         data.append('apelido', apelido);
         data.append('email', email);
         data.append('telefoneFixo', telefoneFixo);
         data.append('telefoneCelular', telefoneCelular);
         data.append('telefoneRecado', telefoneRecado);
         data.append('aniversario', aniversario);
         data.append('tipo', 2);*/


        $.ajax({
            url: 'http://10.11.194.42/ajaxPerfil',
            type: 'POST',
            async: false,
            data: {tema: tema, apelido: apelido, email: email, telefoneFixo: telefoneFixo, telefoneCelular: telefoneCelular, telefoneRecado: telefoneRecado, aniversario: aniversario, tipo: 2},
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Preferências alteradas com sucesso!', classes: 'teal accent-4'});
                    $(".name").html(apelido);
                    $(".email").html(email);
                } else {
                    M.toast({html: 'Não foi possível gravar as alterações verifique as informações preenchidas.', classes: 'red lighten-2'});
                }
            }
        });
    });



    // tema switch

    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            // localStorage.setItem('theme', 'dark');

        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            // localStorage.setItem('theme', 'light');
        }
    }

    toggleSwitch.addEventListener('change', switchTheme, false);




});