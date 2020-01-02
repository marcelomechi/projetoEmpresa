<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Workforce Management</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cssFramework/css/style.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/fontawesome.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/brands.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>/assets/css/fontA/css/solid.css" rel="stylesheet">
        <?php if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
            ?>   
            <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/login/assets/css/customIE.css">
            <?php
        } else {
            ?>
            <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/login/assets/css/custom.css">  
            <?php
        }
        ?>

        
        <?php
        $dir = 'views/login/assets/images/';
        $files1 = scandir($dir);

        /* $minVal = array_keys( $files1, min( $files1));
          $maxVal = array_keys( $files1, max( $files1)); */
        $arrBackground = $files1;

        $arquivos1 = array_shift($arrBackground);
        $arquivos2 = array_shift($arrBackground);
        $randomWallpaper = array_rand($arrBackground, 1);

        $wallpaper = BASE_URL . "views/login/assets/images/" . $arrBackground[$randomWallpaper];

        // print_r(rand($files1));
        // print_r($dados);
        // var_dump($arrBackground);
        ?>


<style>
             html{
                background-image: url("<?php echo $wallpaper; ?>");
                background-repeat: no-repeat; 
                -moz-background-size: contain; 
                -webkit-background-size: contain; 
                background-size: contain;
                background-position: center center;
                background-size: cover;
            }

            
            
            .card{
               background-color: #eeeeee;
            }
            .flex{
                display: flex;
                align-items: center;
                height: 100%;
                width: 100%;
            }
        </style> 
</head>

<body>
 <div class="flex">
    <div class="row">
        <div class="col s12">
        <div class="card">
            <div class="card-content">
            <span class="card-title center-align">Cadastro de Usuário Convidado</span>
            <p class="center-align">Preencha suas informações e aguarde a liberação de seu acesso.</p>
            <form method="POST" action="cadastraConvidado" class="form">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nomeConvidado" type="text" name="nomeConvidado" class="validate" required autocomplete="off">
                        <label for="nomeConvidado">Nome Completo</label>
                        <span class="helper-text" data-error="Preecha corretamente este campo" data-success=""></span>
                    </div>
                    <div class="input-field col s4">
                        <input id="cpfConvidado" type="text" name="cpfConvidado" class="validate cpf" required onblur="validaCpf(this)" autocomplete="off">
                        <label for="cpfConvidado">CPF</label>
                        <span class="helper-text helper-cpf" data-error="" data-success=""></span>
                    </div>
                             
                    <div class="input-field col s2">
                        <select id="sexoConvidado" name="sexoConvidado" class="validate" required>
                            <option value="f" selected>Feminino</option>
                            <option value="m">Masculino</option>
                        </select>
                        <label>Sexo</label>
                        <span class="helper-text" data-error="Preecha corretamente este campo" data-success=""></span>
                    </div>
                    
                </div>

                
                <div class="row">
                <div class="input-field col s4">
                        <input id="emailConvidado" type="email" name="emailConvidado"  title="" class="validate" required autocomplete="off">
                        <label for="emailConvidado">E-mail</label>
                        <span class="helper-text" data-error="Preecha corretamente este campo" data-success=""></span>
                    </div>    
                
                <div class="input-field col s4">
                        <input id="cargoConvidado" type="text" name="cargoConvidado"  class="validate" required autocomplete="off">
                        <label for="cargoConvidado">Cargo</label>
                        <span class="helper-text" data-error="Preecha corretamente este campo" data-success=""></span>
                    </div>
                    <div class="input-field col s2">
                        <input id="cepConvidado" type="text" name="cepConvidado" class="validate cep" required onchange="localizaCep()" autocomplete="off">
                        <label for="cepConvidado">CEP</label>
                        <span class="helper-text helper-cep" data-error="Preecha corretamente este campo" data-success=""></span>
                    </div>
                    <div class="input-field col s2">
                        <input id="numeroConvidado" type="text" name="numeroConvidado" autocomplete="off" >
                        <label for="numeroConvidado">Número</label>
                    </div>
                  <!--  <div class="input-field col s3">
                        <input id="complementoConvidado" type="text" name="complementoConvidado">
                        <label for="complementoConvidado">Complemento</label>
                    </div> -->
                   
                </div>
                <div class="row">
                <div class="input-field col s5">
                        <input id="ruaConvidado" type="text" name="ruaConvidado" readonly required autocomplete="off">
                        <label for="cepConvidado">Rua</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="bairroConvidado" type="text" name="bairroConvidado" readonly required autocomplete="off">
                        <label for="bairroConvidado">Bairro</label>
                    </div>
                    <div class="input-field col s3">
                        <input id="cidadeConvidado" type="text" name="cidadeConvidado" readonly required autocomplete="off">
                        <label for="cidadeConvidado">Cidade</label>
                    </div>
                   <!-- <div class="input-field col s2">
                        <input id="estadoConvidado" type="text" name="estadoConvidado"  readonly required>
                        <label for="estadoConvidado">Estado</label>
                    </div> -->                   
                </div>        
                <div class="row">
                        <div class="input-field col s12 right-align">
                            <a href="<?php echo BASE_URL;?>login" onclick="limpaFormulario()" class="waves-effect waves-light btn red">Cancelar</a>
                            <button type="submit" class="waves-effect waves-light btn">Gravar</button>
                        </div>     
                </div>   

        </form>
                    <!--
                        email
                        cargo
                        nascimento
                        sexo
                        cep
                        rua
                        numero
                        bairro
                        cidade
                    -->
                </div>
        </div>
</div>
</div>
    <div id="modalConvidado" class="modal">
        <div class="modal-content">
        <h4 id="headerModalConvidado" class="center-align"></h4>
        <p id="convidadoTexto" class="center-align"></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect btn red hide" id="modalConvidadoBtnCancel">Cancelar</a>
            <a href="#!" class="modal-close waves-effect btn" id="modalConvidadoBtnSuccess">Sim</a>
        </div>
     </div>
     </div>


    <!-- o jquery vem sempre antes do materialize -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/cssFramework/js/jsPrincipal.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/brands.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/solid.js"></script>
            <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/fontawesome.js"></script>
            <script src="<?php echo BASE_URL; ?>views/login/assets/js/js.js"></script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/vendor/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>

            <script>

$(document).ready(function(){
    $('select').formSelect();
    $('.cep').mask('00000-000');
  });
                // valida campo somente numeros //
                function SomenteNumero(e) {
                    var tecla = (window.event) ? event.keyCode : e.which;
                    if ((tecla > 47 && tecla < 58))
                        return true;
                    else {
                        if (tecla == 8 || tecla == 0)
                            return true;
                        else
                            return false;
                    }
                }




                function localizaCep() {
                    bloqueiaCampos();

//Nova variável "cep" somente com dígitos.
var cep = $("#cepConvidado").val().replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $("#ruaConvidado").val("");
        $("#bairroConvidado").val("");
        $("#cidadeConvidado").val("");
      //  $("#estadoConvidado").val(""); REMOVI POIS NÃO É NECESSÁRIO ENVIAR O ESTADO NO FORMULARIO
        //$("#ibge").val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#ruaConvidado").val(dados.logradouro).removeClass("validate");
                $("#bairroConvidado").val(dados.bairro).removeClass("validate");
                $("#cidadeConvidado").val(dados.localidade).removeClass("validate");
                //$("#estadoConvidado").val(dados.uf).removeClass("validate");
                M.updateTextFields()
                //$("#ibge").val(dados.ibge);
            } //end if.
            else {
                //CEP pesquisado não foi encontrado.
                
                limpaModal();
                $('#headerModalConvidado').html("")
                $('#convidadoTexto').html("CEP não localizado, deseja preencher o endereço manualmente?")
                $('#modalConvidadoBtnSuccess').html("Sim").addClass("endManual");
                $('#modalConvidadoBtnCancel').removeClass("hide");
                $('#modalConvidadoBtnCancel').html("Não").addClass("endManualCancel");
                $('#modalConvidado').modal('open');
                
                $(document).on("click",".endManual", function(){
                    habilitaCampos()
                    limpaModal();
                });

                $(document).on("click",".endManualCancel", function(){
                    bloqueiaCampos();
                    limpaModal();
                });
            }
        });
    } //end if.
    else {
        //cep é inválido.

        impaFormulario();
        limpaModal();
        $('#headerModalConvidado').html("")
        $('#convidadoTexto').html("Formato de CEP inválido.")
        $('#modalConvidadoBtnSuccess').html("ok");
        $('#modalConvidado').modal('open');
    }
} //end if.
else {
    //cep sem valor, limpa formulário.
    limpaFormulario();
}


};

function limpaModal(){
    $('#headerModalConvidado').html("")
    $('#convidadoTexto').html("")
    $('#modalConvidadoBtnSuccess').html("").removeClass("endManual");
    $('#modalConvidadoBtnCancel').html("").addClass("hide");
    
}

function limpaFormulario() {
	// Limpa valores do formulário de cep.
	$("#ruaConvidado").val("");
	//$("#casastraNumFivet").val("");
	$("#bairroConvidado").val("");
    $("#cidadeConvidado").val("");
   // $("#estadoConvidado").val("")
	$("#cepConvidado").val("");

}

function bloqueiaCampos(){
    $("#ruaConvidado").attr("readonly","readonly");
	//$("#casastraNumFivet").val("");
	$("#bairroConvidado").attr("readonly","readonly");
    $("#cidadeConvidado").attr("readonly","readonly");
   // $("#estadoConvidado").attr("disabled","disabled");
}

function habilitaCampos(){
    $("#ruaConvidado").removeAttr("readonly");
	//$("#casastraNumFivet").val("");
	$("#bairroConvidado").removeAttr("readonly");
    $("#cidadeConvidado").removeAttr("readonly");
   // $("#estadoConvidado").removeAttr("disabled");
}






	
		
	function validaCpf(input){

        var cpf = input.value.replace(/\D/g, '');

        if (cpf == ""){
            $("#cpfConvidado").addClass("invalid");
            $(".helper-cpf").attr('data-error', 'Preencha o CPF');
			return false;
			
		}	

		if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
		{
			
			$("#cpfConvidado").addClass("invalid");
            $(".helper-cpf").attr('data-error', 'CPF inválido');
            setTimeout(function(){
                $("#cpfConvidado").val("");
            },2000);
			return false;
		} 		
		else 
		{
			var soma = 0;
				soma = soma + (parseInt(cpf.substring( 0 , 1))) * 10;
				soma = soma + (parseInt(cpf.substring( 1 , 2))) * 9;
				soma = soma + (parseInt(cpf.substring( 2 , 3))) * 8;
				soma = soma + (parseInt(cpf.substring( 3 , 4))) * 7;
				soma = soma + (parseInt(cpf.substring( 4 , 5))) * 6;
				soma = soma + (parseInt(cpf.substring( 5 , 6))) * 5;
				soma = soma + (parseInt(cpf.substring( 6 , 7))) * 4;
				soma = soma + (parseInt(cpf.substring( 7 , 8))) * 3;
				soma = soma + (parseInt(cpf.substring( 8 , 9))) * 2;
		}
			
		var resto1 = (soma * 10) % 11;

		if ((resto1 == 10) || (resto1 == 11)) {
			resto1 = 0;
		}

		var soma = 0;
			soma = soma + (parseInt(cpf.substring( 0 , 1))) * 11;
			soma = soma + (parseInt(cpf.substring( 1 , 2))) * 10;
			soma = soma + (parseInt(cpf.substring( 2 , 3))) * 9;
			soma = soma + (parseInt(cpf.substring( 3 , 4))) * 8;
			soma = soma + (parseInt(cpf.substring( 4 , 5))) * 7;
			soma = soma + (parseInt(cpf.substring( 5 , 6))) * 6;
			soma = soma + (parseInt(cpf.substring( 6 , 7))) * 5;
			soma = soma + (parseInt(cpf.substring( 7 , 8))) * 4;
			soma = soma + (parseInt(cpf.substring( 8 , 9))) * 3;
			soma = soma + (parseInt(cpf.substring( 9 , 10))) * 2;

		var resto2 = (soma *10) % 11;
		
		if ((resto2 == 10) || (resto2 == 11)) {
			resto2 = 0;
		}

		if ( (resto1 == (parseInt(cpf.substring( 9 , 10)))) && (resto2 == (parseInt(cpf.substring( 10 , 11)))) ) {
            $("#cpfConvidado").removeClass("invalid");
            $("#cpfConvidado").addClass("valid");
			return true;
		} else {
            $("#cpfConvidado").addClass("invalid");
            $(".helper-cpf").attr('data-error', 'CPF inválido');
            setTimeout(function(){
                $("#cpfConvidado").val("");
            },2000);
            return false;
		}

	}






            </script>

</body>
</html>