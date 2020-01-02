/* iniciar o range 
 window.onload = function () {
 var elems = document.querySelectorAll("input[type=range]");
 M.Range.init(elems);
 };
 */
$(document).ready(function () {
    $('select').formSelect();
    $('.tabs').tabs();
    $('.modal').modal({
        dismissible: false
    });
    //$('input#nomePerifl,textarea#descricaoPerfil').characterCounter();

    $('.gravaLiberacao').click(function () {

        idModulo = $(this).parent().parent().find('.idModulo').html();

        /* alert(idModulo);
         return false;
         */
        var selecionado = [];
        var naoSelecionado = [];

        idEach = '#' + idModulo + '';

        $.each($('' + idEach + ' option'), function (chave, valor) {

            if (!$(this).prop('selected')) {
                naoSelecionado[chave] = $(this).val();
                //   alert($(this).val() + ' nao selecionado');
            } else {
                selecionado[chave] = $(this).val();
                //alert($(this).val() + ' selecionado');
            }

        });

        if (selecionado.length === 0) {
            selecionado[0] = 'vazio';
        }

        $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/gravaAlteracao',
            data: {idPerfilSelecionado: selecionado, idModulo: idModulo},
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Alterações efetuadas com sucesso!', classes: 'teal accent-4'});
                    //   $("#divToReload").load(location.href + " #divToReload>*", "");
                } else {
                    // limpaCampos(1);
                    M.toast({html: 'Não foi possível concluir as alterações, tente novamente.', classes: 'red lighten-2'});

                }
            }
        });


    });


    $('.gravaLiberacaoIndividual').click(function () {
        idModuloIndividual = $(this).parent().parent().find('.idModuloIndividual').html();
        idInput = '#' + idModuloIndividual + '';
        if ($('' + idInput + '_individual').val() == "") {
            M.toast({html: 'Nenhum dado foi preenchido.', classes: 'red lighten-2'});
        } else {
            $.ajax({
                type: 'POST',
                url: '/ajaxPermissao/gravaAlteracaoIndividual',
                data: {cpf: $('' + idInput + '_individual').val(), idModulo: idModuloIndividual},
                async: false,
                success: function (r) {
                    if (r == "success") {
                        M.toast({html: 'Alterações efetuadas com sucesso!', classes: 'teal accent-4'});
                        //   $("#divToReload").load(location.href + " #divToReload>*", "");
                    } else {
                        // limpaCampos(1);
                        M.toast({html: 'Não foi possível concluir as alterações, tente novamente.', classes: 'red lighten-2'});

                    }
                }
            });
        }
    });


    $('.removeLiberacaoIndividual').click(function () {
        removeIdModuloIndividual = $(this).parent().parent().find('.idModuloIndividual').html();
        idInputDelete = '#' + removeIdModuloIndividual + '';
        if ($('' + idInputDelete + '_individual').val() == "") {
            M.toast({html: 'Nenhum dado foi preenchido.', classes: 'red lighten-2'});
        } else {
            $.ajax({
                type: 'POST',
                url: '/ajaxPermissao/removeAcessoIndividual',
                data: {cpf: $('' + idInputDelete + '_individual').val(), idModulo: removeIdModuloIndividual},
                async: false,
                success: function (r) {
                    if (r == "success") {
                        M.toast({html: 'Alterações efetuadas com sucesso!', classes: 'teal accent-4'});
                        //   $("#divToReload").load(location.href + " #divToReload>*", "");
                    } else {
                        // limpaCampos(1);
                        M.toast({html: 'Não foi possível concluir as alterações, tente novamente.', classes: 'red lighten-2'});

                    }
                }
            });
        }
    });

    $('#btnConsultaAcessoIndividualCpf').click(function () {
        if ($("#cpfConsultaIndividual").val() == "") {
            $("#cpfConsultaIndividual").addClass("invalid");
            $("#cpfConsultaIndividual").prop("data-error", "true");
            return false;
        } else {
            $("#cpfConsultaIndividual").removeClass("invalid", "invalid");
            $("#cpfConsultaIndividual").addClass("valid");
            $("#cpfConsultaIndividual").prop("data-error", "false");

            $.ajax({
                type: 'POST',
                url: '/ajaxPermissao/consultaAcessosIndividual',
                data: {cpfConsultaIndividual: $("#cpfConsultaIndividual").val(), tipo: 1},
                async: false,
                success: function (r) {
                    $("#retornoConsultaIndividual").html(r);
                    $('#modalAcessoConsultaIndividual').modal('open');
                    $("#cpfConsultaIndividual").val("")
                }
            });


        }
    });

    /* como estou usando ajax, preciso de colocar com on click document */
    $(document).on("click", ".inativaPerfil", function () {
        idPerfil = $(this).parent().parent().find('.idPerfil').html();
        $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/inativaPerfil',
            data: {idPerfil: idPerfil, tipo: 2},
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Perfil inativado com sucesso!', classes: 'teal accent-4'});
                    carregaTabelaPerfis();
                    // $("#tabelaPerfis").load("#tabelaPerfis > *");
                    //window.location.reload();
                    //document.getElementsByTagName("body").addEventListener("load", tabAtiva());
                    //$('.tabs').tabs('select', 'liberarAcessoIndividual');
                } else {
                    M.toast({html: 'Não foi possível atender a solicitação, tente novamente.', classes: 'red lighten-2'});
                }

            }
        });
    });

    $(document).on("click", ".ativaPerfil", function () {
        idPerfil = $(this).parent().parent().find('.idPerfil').html();
        $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/ativaPerfil',
            data: {idPerfil: idPerfil, tipo: 2},
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Perfil ativado com sucesso!', classes: 'teal accent-4'});
                    //$('#administraPerfis').load(document.URL + ' #administraPerfis');
                    carregaTabelaPerfis();
                    // $("#tabelaPerfis").load(" #tabelaPerfis > *");
                    //           $('#tabelaPerfis').DataTable().ajax.reload();
                } else {
                    M.toast({html: 'Não foi possível atender a solicitação, tente novamente.', classes: 'red lighten-2'});
                }

            }
        });
    });

    $(document).on("click", ".gravaNovoPerfil", function () {
        if ($("#nomePerifl").val() == "") {
            $("#nomePerifl").addClass("invalid");
            $("#nomePerifl").prop("data-error", "true");

        } else if ($("#descricaoPerfil").val() == "") {
            $("#descricaoPerfil").addClass("invalid");
            $("#descricaoPerfil").prop("data-error", "true");

        } else if ($("#nivelAcesso").val() == "") {
            $("#nivelAcesso").addClass("invalid");
            $("#nivelAcesso").prop("data-error", "true");

        } else if ($('input:radio[name=radioDeslogue]').val() == "") {
            $("'input:radio[name=radioDeslogue]'").addClass("invalid");
            $("'input:radio[name=radioDeslogue]'").prop("data-error", "true");
        } else {
            $.ajax({
                type: 'POST',
                url: '/ajaxPermissao/cadastraPerfil',
                data: {nomePerfil: $("#nomePerifl").val(), descricaoPerfil: $("#descricaoPerfil").val(), nivelAcesso: $("#nivelAcesso").val(), deslogue: $('input:radio[name=radioDeslogue]').val()},
                async: false,
                success: function (r) {
                    if (r == "success") {
                        $("#nomePerifl").val("")
                        $("#descricaoPerfil").val("")
                        $("#nivelAcesso").val("")
                        $("#input:radio[name=radioDeslogue]").val("")

                        M.toast({html: 'Perfil cadastrado com sucesso!', classes: 'teal accent-4'});

                    } else {
                        M.toast({html: 'Não foi possível atender a solicitação, tente novamente.', classes: 'red lighten-2'});
                    }

                }
            });
        }
    });

    $(document).on("click", ".fechaModalNovoPerfil", function () {
        $("#nomePerifl").val("")
        $("#descricaoPerfil").val("")
        $("#nivelAcesso").val("")
        $("#input:radio[name=radioDeslogue]").val("")

    });
    
    
     $(document).on("click", ".liberaAcessoConvidado", function () {
        cpfConvidado = $(this).parent().parent().find('.cpfConvidado').html();
        
        alert(cpfConvidado)
       /* $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/ativaPerfil',
            data: {idPerfil: idPerfil, tipo: 3},
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Perfil ativado com sucesso!', classes: 'teal accent-4'});
                    //$('#administraPerfis').load(document.URL + ' #administraPerfis');
                    carregaTabelaPerfis();
                    // $("#tabelaPerfis").load(" #tabelaPerfis > *");
                    //           $('#tabelaPerfis').DataTable().ajax.reload();
                } else {
                    M.toast({html: 'Não foi possível atender a solicitação, tente novamente.', classes: 'red lighten-2'});
                }

            }
        });*/
    });
    
      $(document).on("click", ".bloqueiaAcessoConvidado", function () {
        cpfConvidado = $(this).parent().parent().find('.cpfConvidado').html();
        
        alert(cpfConvidado)
       /* $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/ativaPerfil',
            data: {idPerfil: idPerfil, tipo: 3},
            async: false,
            success: function (r) {
                if (r == "success") {
                    M.toast({html: 'Perfil ativado com sucesso!', classes: 'teal accent-4'});
                    //$('#administraPerfis').load(document.URL + ' #administraPerfis');
                    carregaTabelaPerfis();
                    // $("#tabelaPerfis").load(" #tabelaPerfis > *");
                    //           $('#tabelaPerfis').DataTable().ajax.reload();
                } else {
                    M.toast({html: 'Não foi possível atender a solicitação, tente novamente.', classes: 'red lighten-2'});
                }

            }
        });*/
    });
    
    $(document).on("click", ".visualizaDadosConvidado", function () {
        cpfConvidado = $(this).parent().parent().find('.cpfConvidado').html();
        
       
         $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/visualizaDadoConvidado',
            data: {cpf: cpfConvidado},
            async: false,
            success: function (r) {
                alert(r)

            }
        });
    });
    
    


    function carregaTabelaPerfis() {

        $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/caregaTabelaPerfil',
            async: false,
            success: function (r) {
                $("#dadosTabelaPerfil").html(r);

            }
        });

    }

    function carregaTabelaConvidado() {
        $.ajax({
            type: 'POST',
            url: '/ajaxPermissao/carregaTabelaConvidado',
            async: false,
            success: function (r) {
                $("#dadosConvidados").html(r);
            }
        });
    }





    /* $('#my-table').DataTable({
     ajax: 'http://10.11.194.42/ajaxAcesso/tabela',
     // aqui preciso definir quais dados eu quero da tabela, os th... eles tem que bater com o que vem do banco de dados, ex name ele vai procurar os dados de name, caso eu queira outra coluna da consulta, só colocar aqui o nome do campo
     rowId: 'ID',
     columns: [
     // {data: 'ID_MODULO', title: 'ID_MODULO', className: 'hide', set:'ID_MODULO' },
     {data: 'NOME_MODULO', title: 'Ferramenta'},
     {data: 'STATUS_FERRAMENTA', title: 'Status'},
     {data: null, title: ''}
     
     //caso eu tenha mais de um nível no json, no exemplo vou pegar o valor do produto, então é nível superior e o valor....
     //{data:'tipo',title:'Tipo Produto'}
     ],
     columnDefs: [
     {
     searchable: false,
     orderable: false,
     targets: 0
     },
     {
     width: '50%',
     targets: 0  //la primer columna tendra una anchura del  20% de la tabla
     },
     {
     targets: -1, //-1 es la ultima columna y 0 la primera
     data: null,
     defaultContent: 'asdf'
     },
     {orderable: false, searchable: false, targets: -1} //Ultima columna no ordenable para botones
     ],
     
     // Set rows IDs
     rowId: function(a) {
     return {data:'ID_MODULO'};
     }
     }) */

})