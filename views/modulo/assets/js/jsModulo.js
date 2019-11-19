$('#tblMenus').DataTable({
    columnDefs: [
        {
            targets: [0, 1, 2]

        }
    ],
    "order": [[0, "asc"]]
});

$('#tblFerramenta').DataTable({
    columnDefs: [
        {
            targets: [0, 1, 2]

        }
    ],
    "order": [[0, "asc"]]
});
$('select').formSelect();






$(document).ready(function () {
    $('.tabs').tabs();
    $('.tooltipped').tooltip();


    $('.timepicker').timepicker({
        twelveHour: false,
        i18n: {cancel: 'Cancelar', done: 'Confirmar'}
    });
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        i18n: {months: [
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            ], monthsShort: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ], weekdays: [
                'Domingo',
                'Segunda-feira',
                'Terça-feira',
                'Quarta-feira',
                'Quinta-feira',
                'Sexta-feira',
                'Sábado'
            ], weekdaysShort: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sab'
            ], weekdaysAbbrev: ['S', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            cancel: 'Cancelar',
            done: 'Confirmar'},
        events: ["Fri Nov 15 2019"],
        onSelect: function () {
            ;
            if ($(".is-selected").hasClass("has-event")) {
                $("#evento").remove();
                $(".datepicker-date-display").append("<span id='evento' class='flow-text'>Proclamação da República</span>");
            } else {
                $("#evento").remove();
            }
        }
    });


    /*  var dataAtual = new Date();
     var data = dataAtual.getFullYear() + ',' + (dataAtual.getMonth()+1) + ',' + dataAtual.getDate()
     */

    $(".ckMenu").change(function () {
        if ($(this).prop('checked')) {
            $(".fileMenu").addClass("hide");
            $(".selectSubmenu").removeClass("hide");

        } else {
            $(".fileMenu").removeClass("hide");
            $(".selectSubmenu").addClass("hide");
            $('select').val("");
        }
        ;
    });





    $(".btn").change(function () {
        $("#imgMenu").attr('src', URL.createObjectURL(event.target.files[0]));
        $("#imgMenuEscuro").attr('src', URL.createObjectURL(event.target.files[0]));


        var nome = $('input:file').val().split("\\").pop();
    });
    $("#nomeMenu").change(function () {
        $("#previewNomeMenu").html($("#nomeMenu").val());
        $("#previewNomeMenuEscuro").html($("#nomeMenu").val());
    });


    /*    $("#proximoOrdenar").click(function(){
     
     if($(".ckMenu").prop('checked')){
     if ($("#nomeMenu").val() == "") {
     $("#nomeMenu").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     return false;
     }else if ($("#descricaoMenu").val() == "") {
     $("#descricaoMenu").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     return false;
     }else if($("#selectSubmenu").val() == ""){
     $("#selectSubmenu").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     }else{
     $("#formDados").submit();
     }
     
     
     }else{
     
     if ($("#nomeMenu").val() == "") {
     $("#nomeMenu").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     return false;
     }else if ($("#descricaoMenu").val() == "") {
     $("#descricaoMenu").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     return false;
     }else if ($("#menuImg").val() == "") {
     alert("asdf")
     $("#menuImg").addClass("invalid");
     $(".helper-text").attr('data-error', 'Preencha este campo.');
     return false;
     }else{
     $("#formDados").submit();
     }
     
     }
     
     });*/


    $("#gravarNovoMenu").click(function () {

        if ($(".ckMenu").prop('checked')) {
            if ($("#nomeMenu").val() == "") {
                $("#nomeMenu").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
                return false;
            } else if ($("#descricaoMenu").val() == "") {
                $("#descricaoMenu").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
                return false;
            } else if ($("#selectSubmenu").val() == "") {
                $("#selectSubmenu").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxModulo/submenu',
                    data: {nomeMenu: $("#nomeMenu").val(), descricaoMenu: $("#descricaoMenu").val(), menuReferencia: $("#selectSubmenu").val()},
                    async: false,
                    success: function (r) {
                        if (r == "success") {
                            limpaCampos(1);
                            M.toast({html: 'Menu criado com sucesso!', classes: 'teal accent-4'});
                            $("#divToReload").load(location.href + " #divToReload>*", "");
                        } else {
                            limpaCampos(1);
                            M.toast({html: 'Não foi possível criar o menu, verifique as informações preenchidas e o tipo de arquivo enviado.', classes: 'red lighten-2'});

                        }
                    }
                });
            }


        } else {

            if ($("#nomeMenu").val() == "") {
                $("#nomeMenu").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
                return false;
            } else if ($("#descricaoMenu").val() == "") {
                $("#descricaoMenu").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
                return false;
            } else if ($("#menuImg").val() == "") {
                $("#menuImg").addClass("invalid");
                $(".helper-text").attr('data-error', 'Preencha este campo.');
                return false;
            } else {

                var dadosMenu = new FormData();

                var arquivos = $('input[name=envioFoto]')[0].files;


                dadosMenu.append('icone', arquivos[0]);
                dadosMenu.append('nomeMenu', $("#nomeMenu").val());
                // dadosMenu.append('linkMenu', $("#linkMenu").val());
                dadosMenu.append('descricaoMenu', $("#descricaoMenu").val());
                // dadosMenu.append('ordem', $("#ordemMenu").val());

                $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxModulo',
                    data: dadosMenu,
                    contentType: false,
                    processData: false,
                    async: false,
                    success: function (r) {
                        if (r == "success") {
                            M.toast({html: 'Menu criado com sucesso!', classes: 'teal accent-4'});
                            limpaCampos(2);
                        } else {
                            M.toast({html: 'Não foi possível criar o menu, verifique as informações preenchidas e o tipo de arquivo enviado.', classes: 'red lighten-2'});
                            limpaCampos(2);
                        }
                    }
                });


            }


        }



    });




    /* grava nova ferramenta */

    /* tratamento do select */
    $("#menuReferenciaFerramenta").change(function () {
        if ($(this).val == "") {
            $('#containerSelectFerramenta .select-dropdown').addClass("invalid");
            $('#containerSelectFerramenta .select-dropdown').removeClass("valid");
            $("#menuReferenciaFerramentaHelper").removeClass('hide');
        } else {
            $('#containerSelectFerramenta .select-dropdown').addClass("valid");
            $('#containerSelectFerramenta .select-dropdown').removeClass("invalid");
            $("#menuReferenciaFerramentaHelper").addClass('hide');
        }
    });


    $("#nomeFerramenta").change(function () {
        $("#previewNomeFerramenta").html($("#nomeFerramenta").val());
        $("#previewNomeFerramentaEscuro").html($("#nomeFerramenta").val());
    });

    $("#gravaNovaFerramenta").click(function () {

        if ($("#nomeFerramenta").val() == "") {
            $("#nomeFerramenta").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else if ($("#linkFerramenta").val() == "") {
            $("#linkFerramenta").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else if ($("#descricaoFerramenta").val() == "") {
            $("#descricaoFerramenta").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else if ($("#menuReferenciaFerramenta").val() == "") {
            $('#containerSelectFerramenta .select-dropdown').removeClass("valid");
            $('#containerSelectFerramenta .select-dropdown').addClass("invalid");
            $("#menuReferenciaFerramentaHelper").removeClass('hide');
        } else {
            $.ajax({
                type: 'POST',
                url: 'http://10.11.194.42/ajaxModulo/novaFerramenta',
                data: {nomeFerramenta: $("#nomeFerramenta").val(), linkFerramenta: $("#linkFerramenta").val(), descricaoFerramenta: $("#descricaoFerramenta").val(), moduloReferencia: $("#menuReferenciaFerramenta").val()},
                async: false,
                success: function (r) {
                    if (r == "success") {
                        limpaCampos(3);
                        M.toast({html: 'Ferramenta criada com sucesso!', classes: 'teal accent-4'});
                    } else {
                        limpaCampos(3);
                        M.toast({html: 'Não foi possível criar a ferramenta, verifique as informações preenchidas.', classes: 'red lighten-2'});
                    }
                }
            });
        }

    });

    /* inativa menu */

    $('#tblMenus tbody').on('click', '.inativaMenu', function () {
        idMenu = $(this).parent().parent().find('.idMenu').html();
        tipoExclusao = $(this).parent().parent().find('.tipoMenu').html();

        if (tipoExclusao == "PRINCIPAL") {
            tipo = 1;
        } else {
            tipo = 2;
        }

        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxModulo/inativarMenu',
            data: {idMenu: idMenu, tipoExclusao: tipo},
            //  contentType: false,
            // processData: false,
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Menu inativado com sucesso, a página será atualizada, aguarde.', classes: 'teal accent-4'});
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);

                } else {
                    M.toast({html: 'Não foi possível inativar o menu, tente novamente.', classes: 'red lighten-2'});
                }
            }
        });

    });


    /* ativa menu */

    $('#tblMenus tbody').on('click', '.ativaMenu', function () {
        idMenu = $(this).parent().parent().find('.idMenu').html();
        tipoAtiva = $(this).parent().parent().find('.tipoMenu').html();

        if (tipoAtiva == "PRINCIPAL") {
            tipo = 1;
        } else {
            tipo = 2;
        }

        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxModulo/ativarMenu',
            data: {idMenu: idMenu, ativa: tipo},
            //  contentType: false,
            // processData: false,
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Menu ativado com sucesso, a página será atualizada, aguarde.', classes: 'teal accent-4'});
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);

                } else {
                    M.toast({html: 'Não foi possível ativar o menu, tente novamente.', classes: 'red lighten-2'});
                }
            }
        });

    });


    /* inativa ferramenta */

    $('#tblFerramenta tbody').on('click', '.removeFerramenta', function () {
        idFerramenta = $(this).parent().parent().find('.idFerramenta').html();

        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxModulo/inativarFerramenta',
            data: {idFerramenta: idFerramenta},
            //  contentType: false,
            // processData: false,
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Ferramenta inativada com sucesso, a página será atualizada, aguarde.', classes: 'teal accent-4'});
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);

                } else {
                    M.toast({html: 'Não foi possível inativar a ferramenta, tente novamente.', classes: 'red lighten-2'});
                }
            }
        });

    });


    /* ativa ferramenta */

    $('#tblFerramenta tbody').on('click', '.ativaFerramenta', function () {
        idFerramenta = $(this).parent().parent().find('.idFerramenta').html();

        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxModulo/ativarFerramenta',
            data: {idFerramenta: idFerramenta},
            //  contentType: false,
            // processData: false,
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Ferramenta ativada com sucesso, a página será atualizada, aguarde.', classes: 'teal accent-4'});
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);

                } else {
                    M.toast({html: 'Não foi possível ativar a ferramenta, tente novamente.', classes: 'red lighten-2'});
                }
            }
        });

    });

    /* gera pagina de manutenção */
    $("#inativaWfm").click(function () {

        if ($("#dataPrevisaoRetorno").val() == "") {
            $("#dataPrevisaoRetorno").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else if ($("#previsaoRetorno").val() == "") {
            $("#previsaoRetorno").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else if ($("#descricaoManutencao").val() == "") {
            $("#descricaoManutencao").addClass("invalid");
            $(".helper-text").attr('data-error', 'Preencha este campo.');
            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: 'http://10.11.194.42/ajaxModulo/inativarWfm',
                data: {dataPrevisaoRetorno: $("#dataPrevisaoRetorno").val(), previsaoRetorno: $("#previsaoRetorno").val(), descricaoManutencao: $("#descricaoManutencao").val()},
                //  contentType: false,
                // processData: false,
                async: false,
                success: function (r) {
                    if (r == "success") {
                        M.toast({html: 'O sistema em modo manutenção com sucesso, somente administradores continuarão com acesso.', classes: 'teal accent-4'});
                    } else {
                        M.toast({html: 'Não foi possível ativar a ferramenta, tente novamente.', classes: 'red lighten-2'});
                    }
                }
            });
        }

    });

    /* remove mensagem de sistema indisponível e joga o arquivo para o log */

    $('#tblWfmInativa tbody').on('click', '.removeMensagem503', function () {
        $.ajax({
            type: 'POST',
            url: 'http://10.11.194.42/ajaxModulo/removeMensagem503',
            //  contentType: false,
            // processData: false,
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Mensagem removida com sucesso, a página será atualizada, aguarde.', classes: 'teal accent-4'});
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);

                } else {
                    M.toast({html: 'Não foi possível remover a mensagem, tente novamente.', classes: 'red lighten-2'});
                }
            }
        });

    });


    function limpaCampos(tipo) {
        if (tipo == 1) { // limpa campos novo menu sem imagem
            $("input").removeClass("valid");
            $("#nomeMenu").val("");
            $("#descricaoMenu").val("");
            $('.ckMenu').prop('checked', false);
            $(".fileMenu").removeClass("hide");
            $(".selectSubmenu").addClass("hide");
            $('#selectSubmenu').val("");
            $("select").formSelect();
            $("#previewNomeMenu").html("");
            $("#previewNomeMenuEscuro").html("");

        } else if (tipo == 2) { // limpa campos novo menu com imagem
            $("input").val("").removeClass("valid");
            $('#imgMenu').removeAttr("src");
            $('#imgMenuEscuro').removeAttr("src");
            $("#previewNomeMenu").html("");
            $("#previewNomeMenuEscuro").html("");
        } else if (tipo == 3) { // limpa campos nova Feramenta
            $("input").val("").removeClass("valid");
            $("#nomeFerramenta").val("");
            $("#linkFerramenta").val("");
            $("#descricaoFerramenta").val("");
            $("#previewNomeFerramenta").html("");
            $("#previewNomeFerramentaEscuro").html("");
            $("#menuReferenciaFerramenta").val("");
            $("select").formSelect();
        }
    }
});