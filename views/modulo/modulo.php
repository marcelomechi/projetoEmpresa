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
       // color: #424242;
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
            <div class="card">
                <div class="card-content">
                    <p class="center-align flow-text">Responsável por criar um Menu que irá agrupar novas ferramentas.</p> 
                    <div class="input-field">
                        <input id="nomeMenu" type="text" name="nomeMenu" class="validate" autocomplete="off" maxlength="96">
                        <label for="nomeMenu">Nome do Menu</label>
                        <span id="nomeMenuHelper" class="helper-text" data-error="" data-success=""></span>
                    </div>
                    <div class="input-field">
                        <input id="descricaoMenu" type="text" name="descricaoMenu" class="validate" autocomplete="off" maxlength="256">
                        <label for="descricaoMenu">Descrição do Menu</label>
                         <span id="descricaoMenuHelper" class="helper-text" data-error="" data-success=""></span>
                        
                    </div>
                    <div class="input-field">
                        <input id="ordemMenu" type="text" name="ordemMenu" class="validate" onkeypress="return SomenteNumero(event)" autocomplete="off">
                        <label for="ordemMenu">Ordenação</label>
                         <span id="ordemMenuMenuHelper" class="helper-text" data-error="" data-success=""></span>
                      
                    </div>
                    <div class="file-field input-field">									  
                        <div class="btn waves-effect">
                            <span>Ícone</span>
                            <input name="menuImg" type="file"  class="validate"><i class="fas fa-camera"></i>
                        </div>
                        <div class="file-path-wrapper">
                            <input id="menuImg" class="file-path validate" type="text">
                             <span id="menuImg" class="helper-text" data-error="" data-success=""></span>
                         
                        </div>
                        
                    </div>
                    <div class="input-field right-align">
                        <a id="gravaMenu" class="waves-effect waves-light btn">Gravar</a>
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
    function SomenteNumero(e){
      
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  
	//alert ( "Este campo aceita apenas números.");
	return false;
    }
}
	

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
                 $("#nomeMenu").addClass("invalid");
                 $(".helper-text").attr('data-error', 'Preencha este campo.');
                 return false;
           }else if($("#descricaoMenu").val() == ""){
                 $("#descricaoMenu").addClass("invalid");
                 $(".helper-text").attr('data-error', 'Preencha este campo.');
                 return false;
           }else if($("#ordemMenu").val() == ""){
                 $("#ordemMenu").addClass("invalid");
                 $(".helper-text").attr('data-error', 'Preencha este campo.');
                 return false;
           }else if($("#ordemMenu").val() == "0"){
                 $("#ordemMenu").addClass("invalid");
                 $(".helper-text").attr('data-error', 'Preencha um valor maior que 0');
                 return false;
           }else if($("#menuImg").val() == ""){
                 $("#menuImg").addClass("invalid");
                 $(".helper-text").attr('data-error', 'Preencha este campo.');
                 return false;
           }
            
       });
       

        
});
    </script>