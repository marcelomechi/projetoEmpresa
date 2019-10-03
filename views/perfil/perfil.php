<style type="text/css">

    .asdffdsa{
        height: 110px !important;
        width: 110px !important;
    }

    .w1999{
        width: 100% !important;
    }

    .backgroundImgPerfil{
        background-repeat: no-repeat;		
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .h350{
        height: 350px !important;
    }

    .h500{
        height: 580px !important;
    }

    .padding{
        padding-left: 40px; 
    }




    @media (max-width: 600px) 
    {

        .backgroundImgPerfil{
            background-repeat: no-repeat;		
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            width: 100% !important;
            height: 100% !important;
        }

    }


</style>
<div class="row h500">
    <div class="col s12 m12 l6">

        <div class="card grey lighten-3 h500">
            <div class="card-content">
                <span class="card-title center-align"><h5>Imagem de fundo e foto do perfil</h5></span>
                <div class="carousel carousel-slider center h350">
                    <div class="carousel-fixed-item center">						     	
                        <div class="input-field left-align padding">
                            <img id="img-upload" src="assets/images/marcelo.jpg" class="circle responsive-img asdffdsa">
                        </div>	
                        <div class="input-field left-align padding">
                            <span class="white-text name"><?php echo $apelido; ?></span>               
                        </div>							
                        <div class="input-field left-align padding">
                            <span class="white-text email"><?php echo $email; ?></span>
                        </div>
                    </div>
                    <div id= "1" class="carousel-item" href="#one!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/1.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "2" class="carousel-item" href="#three!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/2.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "3" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/3.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "4" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/4.jpg" class="backgroundImgPerfil">
                    </div>
                    <div  id= "5" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/5.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "6" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/6.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "7"class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/7.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "8" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/8.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "9" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/9.jpg" class="backgroundImgPerfil">
                    </div>
                    <div id= "10" class="carousel-item" href="#four!">
                        <img src="<?php echo BASE_URL; ?>assets/images/backgroundMenu/10.jpg" class="backgroundImgPerfil">
                    </div>
                </div>
                <div class="center-align">
                    <!--<form method="POST" enctype="multipart/form-data" method="post" id="sendProfile">-->
                    <div class="file-field input-field">									  
                        <div class="btn waves-effect">
                            <span>Perfil</span>
                            <input name="profileImg" type="file" id="imgInp"><i class="fas fa-camera"></i>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="right-align">															         		 	
                        <button class="btn waves-effect" id="enviaFotos">Gravar</button>
                    </div>
                    <span class="center-align msg"></span>
                    <div class="progress hide">
                        <div class="indeterminate"></div>
                    </div>
                    <!--</form>-->
                </div>
            </div>
        </div>				

    </div>
    <div class="col s12 m12 l6">
        <div class="card grey lighten-3 h500">
            <div class="card-content">
                <span class="card-title center-align"><h5>Dados e preferências pessoais</h5></span>
                    <div id="tema" class="switch"><br>
                        <label class="center-align">
                            <input type="checkbox" name="tema">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <label for="tema">Tema Escuro</label>
                    <div class="input-field">
                        <input id="apelido" type="text" class="validate" name="apelido" value="<?php echo $apelido; ?>">
                        <label for="apelido">Como gostaria de ser chamado?</label>
                    </div>
                    <div class="input-field">
                        <input id="email" type="email" class="validate" name="email" value="<?php echo $email; ?>">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="input-field">
                        <input id="telefone1" type="text" class="validate phone_with_ddd" name="telefoneFixo" value="<?php echo $telefone1; ?>">
                        <label for="telefone1">Telefone Fixo</label>
                    </div>
                    <div class="input-field">
                        <input id="telefone2" type="text" class="validate sp_celphones" name="telefoneCelular" value="<?php echo $telefone2; ?>" onkeypress="return SomenteNumero(event)">
                        <label for="telefone2">Telefone Celular</label>
                    </div>
                    <div class="input-field">
                        <input id="telefone3" type="text" class="validate sp_celphones" name="telefoneRecado" value="<?php echo $telefone3; ?>" onkeypress="return SomenteNumero(event)">
                        <label for="telefone3">Telefone Recado</label>
                    </div>
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="exibeAniversario"/>
                        <span>Exibir Aniversário?</span>
                    </label>
                    <div class="right-align">
                        <button class="btn waves-effect" id="gravaPreferencias">Gravar</button>
                        <button data-target="modalMsg" class="btn modal-trigger hide"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        // altera foto do perfil
        $(".btn").change(function () {
            $("#img-upload").attr('src', URL.createObjectURL(event.target.files[0]))
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
            var data = new FormData();
            var arquivos = $('input[name=profileImg]')[0].files;
            var backgroundMenu = $("div .active").attr("id");

            if (arquivos.length > 0) {

                data.append('backgroundMenu', backgroundMenu);
                data.append('foto', arquivos[0]);
                data.append('tipo', 1);

                $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxPerfil',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (r) {
                        if (r == "success")
                        {
                            $('.file-path').val("");
                            $('.msg').html("Alterações efetuadas com sucesso!").addClass("teal-text").fadeOut(5000);
                        } else
                        {
                            $('.file-path').val("");
                            $('.msg').html("Não foi possível importar, verfique o tamanho e o tipo do arquivo.").addClass("red-text").fadeOut(5000);
                        }

                        $('.progress').addClass('hide');
                        //$('.modal-trigger').click();
                    }
                });
            }
        });
        
    

        
        
        $('#gravaPreferencias').on('click', function () {
            var data = new FormData();
            
                if( $("input[name=tema]").is(':checked') ){
                 var  tema = 1;
                } else {
                 var  tema = 0;                     
                } 
                
                if( $("input[name=exibeAniversario]").is(':checked') ){
                 var  aniversario = 1;
                } else {
                 var  aniversario = 0;            
                } 
                                          
            var apelido = $("input[name=apelido]").val();
            var email = $("input[name=email]").val();
            var telefoneFixo = $("input[name=telefoneFixo]").val();
            var telefoneCelular = $("input[name=telefoneCelular]").val();
            var telefoneRecado = $("input[name=telefoneRecado]").val();           
            
            data.append('tema', tema);
            data.append('apelido', apelido);
            data.append('email', email);
            data.append('telefoneFixo', telefoneFixo);
            data.append('telefoneCelular', telefoneCelular);
            data.append('telefoneRecado', telefoneRecado);
            data.append('aniversario', aniversario);
            data.append('tipo', 2);
            

                $.ajax({
                    type: 'POST',
                    url: 'http://10.11.194.42/ajaxPerfil',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function (r) {
                        alert(r)
                    }
                });
            });





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


</script>