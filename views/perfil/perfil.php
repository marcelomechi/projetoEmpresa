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
<div class="row h500 tool">
    <div class="col s12 m12 l6">

        <div class="card h500">
            <div class="card-content">
                <span class="card-title center-align"><h5>Imagem de fundo e foto do perfil</h5></span>
                <div class="carousel carousel-slider center h350">
                    <div class="carousel-fixed-item center">						     	
                        <div class="input-field left-align padding">
                            <?php if(empty($caminhoFoto)): ?>
                                <img id="img-upload" src="assets/images/default.jpg" class="circle responsive-img asdffdsa">
                            <?php else: ?>
                                <img id="img-upload" src="<?php echo BASE_URL.$caminhoFoto?>" class="circle responsive-img asdffdsa">
                            <?php endif; ?>
                        </div>	
                        <div class="input-field left-align padding">
                            <span class="white-text name"><?php echo $apelido; ?></span>               
                        </div>							
                        <div class="input-field left-align padding">
                            <span class="white-text email"><?php echo $email; ?></span>
                        </div>
                    </div>
                    
                    <?php
                        $usuarios = new Usuarios();
                        $carousel = $usuarios -> carregaCarousel();
                    
                    ?>
                    
                    
                    
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
        <div class="card h500">
            <div class="card-content">
                <span class="card-title center-align"><h5>Dados e preferências pessoais</h5></span>
                    
                    <div id="tema" class="switch"><br>
                        <label class="theme-switch">
                            <?php if ($id_tema_preferido == 0): ?>
                                <input type="checkbox" name="tema">
                            <?php else: ?>
                                <input type="checkbox" name="tema" checked="checked">
                            <?php endif; ?>
                            <span class="lever"></span>
                        </label>
                    </div>
                    <label for="tema">Tema Escuro</label>
                    <div class="input-field">
                       <input id="apelido" type="text" class="validate textoInput" name="apelido" value="<?php echo $apelido;?>">
                       <label for="apelido">Como gostaria de ser chamado?</label>
                    </div>
                    <div class="input-field">
                        <?php if(empty($email)): ?>
                        <input id="email" type="email" class="validate textoInput" name="email">
                         <?php else: ?>
                        <input id="email" type="email" class="validate textoInput" name="email" value="<?php echo $email;?>">
                        <?php endif; ?>
                        <label for="email">E-mail</label>
                    </div>
                    <div class="input-field">
                        <?php if(empty($telefone1)): ?>
                        <input id="telefone1" type="text" class="validate phone_with_ddd textoInput" name="telefoneFixo">
                        <?php else: ?>
                        <input id="telefone1" type="text" class="validate phone_with_ddd textoInput" name="telefoneFixo" value="<?php echo $telefone1;?>">
                        <?php endif; ?>
                        <label for="telefone1">Telefone Fixo</label>
                    </div>
                    <div class="input-field">
                        <?php if(empty($telefone2)): ?>
                        <input id="telefone2" type="text" class="validate sp_celphones textoInput" name="telefoneCelular">
                        <?php else: ?>
                        <input id="telefone2" type="text" class="validate sp_celphones textoInput" name="telefoneCelular" value="<?php echo $telefone2 ?>">
                        <?php endif; ?>
                        <label for="telefone2">Telefone Celular</label>
                    </div>
                    <div class="input-field">
                        <?php if(empty($telefone3)): ?>
                        <input id="telefone3" type="text" class="validate sp_celphones textoInput" name="telefoneRecado">
                        <?php else: ?>
                        <input id="telefone3" type="text" class="validate sp_celphones textoInput" name="telefoneRecado" value="<?php echo $telefone3; ?>">
                        <?php endif; ?>
                        <label for="telefone3">Telefone Recado</label>
                    </div>
                    <label>
                        <?php if($exibir_aniversario == 1): ?>
                            <input type="checkbox" class="filled-in" checked="checked" name="exibeAniversario"/>
                        <?php else: ?>
                            <input type="checkbox" class="filled-in" name="exibeAniversario"/>
                        <?php endif; ?>
                        <span>Exibir Aniversário?</span>
                    </label>
                    <div class="right-align">
                        <button class="btn waves-effect" id="gravaPreferencias">Gravar</button>
                        <button data-target="modalMsg" class="btn modal-trigger hide"></button>
                    </div>
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
                    
            var dadosImg = new FormData();
            var arquivos = $('input[name=profileImg]')[0].files;
            var backgroundMenu = $("div .active").attr("id");
                 

            if (arquivos.length > 0) {
                dadosImg.append('backgroundMenu', backgroundMenu);
                dadosImg.append('foto', arquivos[0]);
                dadosImg.append('tipo', 1);
            }else{
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
                       
                        if (r == "success"){ 
                           M.toast({html: 'Alterações efetuadas com sucesso!', classes: 'teal accent-4'}); 
                        }else{ 
                           M.toast({html: 'Não foi possível importar, verfique o tamanho e o tipo do arquivo.', classes: 'red lighten-2' });
                        }

                        $('.progress').addClass('hide');
                    }
                });
    
        });
        
       /* 
        $("input[name=tema]").on('change',function(){
            
           // alert(this);
            
            if($(this).is(':checked')){
                           
                var tipo = 3;
                var tema = 1;
                
                $.ajax({
                   url: 'http://10.11.194.42/ajaxPerfil',
                   type:'POST',
                   async: false,
                   data:{tipo: tipo, tema: tema},                            
                
                    success: function (r) {
                        if(r == "success"){
                           console.log("ok")                     
                        }else{
                             console.log("nok");    
                        }
                    }
                });
                
                
            }else{
                var tipo = 3;
                var tema = 0;
                
                $.ajax({
                   url: 'http://10.11.194.42/ajaxPerfil',
                   type:'POST',
                   async: false,
                   data:{tipo: tipo, tema: tema},                            
                
                    success: function (r) {
                        if(r == "success"){
                           console.log("ok")                     
                        }else{
                             console.log("nok");    
                        }
                    }
                });
            }
        });
           */   
        
        $('#gravaPreferencias').on('click', function () {
               if($("input[name=apelido]").val() == ""){
                   M.toast({html: 'Preencha o campo "Como gostaria de ser chamado?".', classes: 'red lighten-2' });
                   return 0;
               }
        
               /*var data = new FormData();*/
            
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
            var email = $("input[name=email]").val() === "" ? null : $("input[name=email]").val();
            var telefoneFixo = $("input[name=telefoneFixo]").val() === "" ? null : $("input[name=telefoneFixo]").val().replace(/[^0-9]/g,'');
            var telefoneCelular = $("input[name=telefoneCelular]").val() === "" ? null : $("input[name=telefoneCelular]").val().replace(/[^0-9]/g,'');
            var telefoneRecado = $("input[name=telefoneRecado]").val() === "" ? null : $("input[name=telefoneRecado]").val().replace(/[^0-9]/g,'');           
            
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
                    type:'POST',
                    async: false,
                    data: {tema: tema, apelido: apelido, email: email, telefoneFixo: telefoneFixo, telefoneCelular: telefoneCelular, telefoneRecado: telefoneRecado, aniversario: aniversario, tipo: 2},                    
                    success: function (r) {
                        if(r == "success"){
                            M.toast({html: 'Preferências alteradas com sucesso!', classes: 'teal accent-4'}); 
                            $(".name").html(apelido);
                            $(".email").html(email);
                        }else{
                             M.toast({html: 'Não foi possível gravar as alterações verifique as informações preenchidas.', classes: 'red lighten-2' });
                        }
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

// tema switch

const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
       // localStorage.setItem('theme', 'dark');
        
    }
    else {        
          document.documentElement.setAttribute('data-theme', 'light');
         // localStorage.setItem('theme', 'light');
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);

<?php

$classe = new Usuarios();

$classe ->updateSession($_SESSION['PIN']);

?>


</script>