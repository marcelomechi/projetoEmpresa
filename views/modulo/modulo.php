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
            <li class="tab col s2"><a href="#test2">Nova Ferramenta</a></li>
            <li class="tab col s2"><a href="#test3">Inativa Menu</a></li>
            <li class="tab col s2"><a href="#test4">Inativa Ferramenta</a></li>
            <li class="tab col s2"><a href="#test4">Ordenação</a></li>
            <li class="tab col s2"><a href="#test4">Página de Manutenção</a></li>
        </ul>
    </div>
</div>
<div class="row">
 <div class="col s12">
        <ul class="tabs">
            <li class="tab col s4"><a href="#novoMenu">Cadastrar</a></li>
            <li class="tab col s4 "><a href="<?php echo BASE_URL;?>modulo/ordenar" id="ordenar">Ordenar</a></li>
            <li class="tab col s4 disabled"><a id="finalizar">Finalizar</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div id="novoMenu" class="col s12">
        <div  class="col s12 m12 l6">        
            <div class="card">
                <div class="card-content">
                    <p class="center-align flow-text">Responsável por criar um Menu que irá agrupar novas ferramentas.</p> 
                   
                   
                    <div class="input-field">
                        <input id="nomeMenu" type="text" name="nomeMenu" class="validate" autocomplete="off" maxlength="96">
                        <label for="nomeMenu">Nome</label>
                        <span id="nomeMenuHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="descricaoMenu" type="text" name="descricaoMenu" class="validate" autocomplete="off" maxlength="256">
                        <label for="descricaoMenu">Descrição</label>
                        <span id="descricaoMenuHelper" class="helper-text" data-error="" data-success=""></span>

                    </div>
                    <div class="input-field">
                            <p>
                                <label>
                                  <input type="checkbox" class="ckMenu filled-in"/>
                                  <span>Submenu</span>
                                </label>
                            </p>
                    </div>
                     <div class="input-field selectSubmenu hide">
                        <select name="moduloReferencia" id="selectSubmenu">
                            <option value="" selected>Selecione</option> 
                            <?php $classe = new Modulos();
                                $dados = $classe -> carregaHeaderMenu();                                
                                foreach ($dados as $item): 
                            ?>
                            <option value ="<?php echo $item['ID_MODULO'];?>"><?php echo $item['NOME_MODULO'];?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        <label>Selecione o Menu Principal</label>
                         <span id="selectMenuMenuHelper" class="helper-text" data-error="" data-success=""></span>
                     </div>
                    <div class="file-field input-field fileMenu">									  
                        <div class="btn waves-effect">
                            <span>Ícone</span>
                            <input name="envioFoto" type="file"><i class="fas fa-camera"></i>
                        </div>
                        <div class="file-path-wrapper">
                            <input id="menuImg" class="file-path validate" type="text" class="validade">
                            <span class="helper-text" data-error="" data-success=""></span>

                        </div>
                    </div>
                    <div class="input-field right-align">
                       <a id="gravaMenu" class="waves-effect waves-light btn">Gravar</a>
                       <a  id="proximoOrdenar" class="waves-effect waves-light btn">Próximo</a>
                      <!--  <a href="<?php echo BASE_URL;?>modulo/ordenar" id="proximoNovoMenu" class="waves-effect waves-light btn">Próximo</a>-->
                    </div>
                  
                </div>
            </div>            
        </div>
        <div  class="col s12 m12 l6"> 
            <div class="card">
                <div class="card-content">
                    <p class="flow-text center-align">Preview</p>
                    <ul>
                        <li>
                            <a class="collapsible-header valign-wrapper"><i class="material icons"><img id="imgMenu" src="" class="circle valign-wrapper"></i><span id="previewNomeMenu"></span><i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>                          
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="test2" class="col s12"></div>
    <div id="test3" class="col s12"></div>
    <div id="test4" class="col s12"></div>
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
        
        $(".ckMenu").change(function(){
           if($(this).prop('checked')){
               $(".fileMenu").addClass("hide");
               $(".selectSubmenu").removeClass("hide");
           }else{
               $(".fileMenu").removeClass("hide");
               $(".selectSubmenu").addClass("hide");
           }; 
        });


        $(".btn").change(function () {
            $("#imgMenu").attr('src', URL.createObjectURL(event.target.files[0]));
            var nome = $('input:file').val().split("\\").pop();
        });
        $("#nomeMenu").change(function () {
            $("#previewNomeMenu").html($("#nomeMenu").val());
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
                      

        $("#proximoOrdenar").click(function () {
        
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
                $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxModulo/submenu',
                    data: {nomeMenu: $("#nomeMenu").val(), descricaoMenu: $("#descricaoMenu").val(), menuReferencia: $("#selectSubmenu").val()},
                    async:false,
                    success: function (r) {
                        dados = r.split("|");
                        if (dados[0] == "success") {
                            $("#proximoOrdenar").attr("href","<?php echo BASE_URL;?>modulo/ordenar/" + dados[1] == "" ? "<?php echo BASE_URL;?>modulo/ordenar" : "<?php echo BASE_URL;?>modulo/ordenar/" + dados[1]);
                            M.toast({html: 'Menu criado com sucesso!', classes: 'teal accent-4'});
                        } else {
                            M.toast({html: 'Não foi possível criar o menu, verifique as informações preenchidas e o tipo de arquivo enviado.', classes: 'red lighten-2'});

                        }
                    }
                });
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
                    async:false,
                    success: function (r) {                        
                    dados = r.split("|");
                    
                        if (dados[0] == "success") {
                            $("#proximoOrdenar").attr("href","<?php echo BASE_URL;?>modulo/ordenar");
                            M.toast({html: 'Menu criado com sucesso!', classes: 'teal accent-4'});

                            $("input").val("").removeClass("valid");
                            $("#previewNomeMenu").html("");
                            $("#imgMenu").removeAttr("src");

                        } else {
                            M.toast({html: 'Não foi possível criar o menu, verifique as informações preenchidas e o tipo de arquivo enviado.', classes: 'red lighten-2'});
                            $("input").val("").removeClass("valid");
                            $("#previewNomeMenu").html("");
                            $("#imgMenu").removeAttr("src");
                        }
                    }
                });


            }
            
            
        }
        
           

        });
        




    });
</script>