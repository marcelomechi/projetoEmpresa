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

    .tabs{
        background-color: #e0e0e0;
        /*cor de fundo da ul do tab*/
    }

    .tabs .tab a {
        color: inherit;
        /*estou herdando do sistema a cor da fonte*/
    }
    /*
    .tabs .tab a:hover {
      color:#9e9e9e;
      /*Custom Color On Hover*/
    /*}*/

    .tabs .tab a:focus.active {
        color:#26a69a;
        background-color: #b2dfdb;
        /*cor de fundo e de texto no hover do tab ativo*/
    }

    .tabs .tab a:hover, .tabs .tab a.active{
        color: #424242;
        /* cor da linha do tab */
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



    }
    
</style> 

<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a href="#novoMenu">Novo menu</a></li>
            <li class="tab col s3"><a href="#test2">Nova Ferramenta</a></li>
            <li class="tab col s3"><a href="#test3">Inativa Menu</a></li>
            <li class="tab col s3"><a href="#test4">Inativa Ferramenta</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div id="novoMenu" class="col s12">
        <div  class="col s12 m12 l6">        
            <div class="card grey lighten-3">
                <div class="card-content">
                    <p class="center-align flow-text">Responsável por criar um Menu para que irá agupar novas ferramentas.</p> 
                    <div class="input-field">
                        <input id="nomeMenu" type="text" name="nomeMenu" class="validate">
                        <label for="nomeMenu">Nome do Menu</label>
                        <span id="nomeMenuHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="descricaoMenu" type="text" name="descricaoMenu" class="validate">
                        <label for="descricaoMenu">Descrição do Menu</label>
                        <span id="loginHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="ordemMenu" type="number" name="ordemMenu" class="validate" min="1">
                        <label for="ordemMenu">Ordenação</label>
                        <span id="loginHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="file-field input-field">									  
                        <div class="btn waves-effect">
                            <span>Ícone</span>
                            <input name="profileImg" type="file" id="imgInp"><i class="fas fa-camera"></i>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                            <span id="loginHelper" class="helper-text" data-error="" data-success=""></span>
                        </div>
                    </div>
                    <div class="input-field right-align">
                        <a id="previewMenu" class="waves-effect waves-light btn  light-blue accent-4">Preview</a>
                        <a id="gravaMenu" class="waves-effect waves-light btn">Gravar</a>
                    </div>
                </div>
            </div>            
        </div>
        <div  class="col s12 m12 l6"> 
            <div class="card grey lighten-3">
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

    <script>

        $(document).ready(function () {
            $('.tabs').tabs();
             $('.tooltipped').tooltip();
          
        
        $(".btn").change(function () {
            $("#imgMenu").attr('src', URL.createObjectURL(event.target.files[0]));
            var nome = $('input:file').val().split("\\").pop();
            alert( nome );
        });
       $("#nomeMenu").change(function () {
            $("#previewNomeMenu").html($("#nomeMenu").val());
            
       });
       
       $("#gravaMenu").click(function () {
           if($("#nomeMenu").val() == ""){
              $("#nomeMenuHelper").attr('data-error', 'Preencha este campo.'); 
           }
            
            
       });
        
});
    </script>