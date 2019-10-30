<style>
    /* equivalente ao container-fluid*/
    .container{
        width: 100%;
        max-width:initial;
        > .row{
            margin: 0;
            > .col{
                padding: 0;
            }
        }
    }


    .tabs .tab a {
        /* color: inherit; */
        /*estou herdando do sistema a cor da fonte*/
    }
    /*
    .tabs .tab a:hover {
      color:#9e9e9e;
      /*Custom Color On Hover*/
    /*}*/

    .tabs .tab a:focus.active {
        /* color:#26a69a;
         background-color: #b2dfdb;*/
        /*cor de fundo e de texto no hover do tab ativo*/

    }

    .tabs .tab a:hover, .tabs .tab a.active{
        /* color: #424242;*/
        /* cor da fonte do tab */
    }

    .tabs .indicator {
        background-color:#26a69a;
        /*Custom Color Of Indicator*/
    }

    #imgMenu{
        max-width: 100%;
        height: auto;
    }

    .collapsible-header{
        font-size: 16px;
        color:#6A6A6A;
        font-weight: 500;
        margin-left: auto;
        margin-right: auto;
    }

</style> 

<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s2"><a href="#novoMenu">Novo menu</a></li>
            <li class="tab col s2 disabled"><a href="#test2">Nova Ferramenta</a></li>
            <li class="tab col s2 disabled"><a href="#test3">Inativa Menu</a></li>
            <li class="tab col s2 disabled"><a href="#test4">Inativa Ferramenta</a></li>
            <li class="tab col s2 disabled"><a href="#test4">Ordenação</a></li>
            <li class="tab col s2 disabled"><a href="#test4">Página de Manutenção</a></li>
        </ul>
    </div>
</div>
<div class="row">
 <div class="col s12">
        <ul class="tabs">
            <li class="tab col s4 disabled"><a>Cadastrar</a></li>
            <li class="tab col s4"><a class="active" id="ordenar">Ordenar</a></li>
            <li class="tab col s4 disabled"><a id="finalizar">Permissões</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div id="novoMenu" class="col s12">
        <div  class="col s12">        
            <div class="card">
                <div class="card-content">
                    <p class="center-align flow-text">Agora você precisa definir a ordem de exibição do menu, para isso arraste a opção destacada na ordem de sua preferência.</p> 
                    <table id="sort" class="highlight">
                        <thead>
                            <tr>
                                <th class="hide">Id Modulo</th>
                                <th>Ordem Módulo</th>
                                <th>Nome Módulo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $classe = new Modulos();
                  
                                $tabela = $classe -> carregaMenuOrdenacao($moduloReferencia);
                    
                                                     
                                foreach ($tabela as $item):
                            ?>
                            <tr>
                                <td class="hide"><?php echo $item['ID_MODULO']; ?></td><td class="hide"><?php echo $item['ID_MODULO_REFERENCIA']; ?></td><td class="index"><?php echo $item['ORDENACAO']; ?></td><td><?php echo $item['NOME_MODULO']; ?></td>                                                                
                            </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                <div class="input-field right-align">
                    <a id="proximoOrdenar" class="waves-effect waves-light btn red">Cancelar</a>
                    <a id="gravaOrdenacao" class="waves-effect waves-light btn">Próximo</a>
                </div>
                    </div>
                   
                </div>
            </div>            
        </div>        
</div>
<script>
    /*function SomenteNumero(e) {
        
        // colocar dentro da tag  onkeypress="return SomenteNumero(event)"

        var tecla = (window.event) ? event.keyCode : e.which;
        if ((tecla > 47 && tecla < 58))
            return true;
        else {
            if (tecla == 8 || tecla == 0)
                return true;
            else
                //alert ( "Este campo aceita apenas números.");
                return false;
        }
    }*/


    $(document).ready(function () {
        $('.tabs').tabs();
        $('.tooltipped').tooltip();
        $('select').formSelect();
        
        
        var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

$("#sort tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();




$("#gravaOrdenacao").click(function(){
    var ordenacao = new Array();
    var table = $("table tbody");

    table.find('tr').each(function (i) {
        var $tds = $(this).find('td'),
            idModulo = $tds.eq(0).text(),
            referencia = $tds.eq(1).text(),
            ordem = $tds.eq(2).text(),
            nome = $tds.eq(3).text()
        
               ordenacao.push({idModulo: idModulo,
                        ordemMenu: ordem});
    
            console.log(ordenacao);                
        /*alert('LINHA ' + (i + 1) + ':\ID: ' + idModulo
              + '\REFERENCIA: ' + referencia + '\ORDEM:' + ordenacao + '\NOME' + nome)*/
        
        
    });
    
     $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxModulo/gravaOrdenacao',
                    data:{ordenacao},
                    async:false,
                    success: function (r) {                        
                    
                                            
                    }
                });
        
        

});




    });
</script>