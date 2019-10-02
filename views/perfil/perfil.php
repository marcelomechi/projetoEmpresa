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
									   <span class="white-text name"><?php echo $apelido;?></span>               
									</div>							
									<div class="input-field left-align padding">
										<span class="white-text email"><?php echo $email;?></span>
									</div>
							    </div>
							    <div class="carousel-item" href="#one!">
							     	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/arrebol.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#three!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/folhasFrutas.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							     	 <img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/gatoLua.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/lampada.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/matrix.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/montanhas.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/naturezaLampada.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/ponteNatureza.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      	<img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/rioFolhas.jpg" class="backgroundImgPerfil">
							    </div>
							    <div class="carousel-item" href="#four!">
							      <img src="<?php echo BASE_URL;?>assets/images/backgroundMenu/terra.jpg" class="backgroundImgPerfil">
							    </div>
  						</div>
		  						<div class="center-align">
						        	<div class="file-field input-field">
										  <div class="btn waves-effect">
											<span>Perfil</span>
											<input type="file" id="imgInp"><i class="fas fa-camera"></i>
										  </div>
										  <div class="file-path-wrapper">
											<input class="file-path validate" type="text">
										  </div>
									</div>
										<div class="right-align">
						         		 	<a class="waves-effect waves-light btn">Gravar</a>
						         		</div>
						        </div>
				        </div>
     			 </div>				
		
	</div>
	<div class="col s12 m12 l6">
		<div class="card grey lighten-3 h500">
			<div class="card-content">
				 <span class="card-title center-align"><h5>Dados e preferências pessoais</h5></span>
				 	<form method="POST">
						<div id="tema" class="switch"><br>
							<label class="center-align">
							  <input type="checkbox">
							  <span class="lever"></span>
							</label>
						</div>
						<label for="tema">Tema Escuro</label>
						<div class="input-field">
						  <input id="apelido" type="text" class="validate" name="apelido" value="<?php echo $apelido; ?>">
						  <label for="apelido">Como gostaria de ser chamado?</label>
						</div>
						<div class="input-field">
						  <input id="email" type="email" class="validate" name="mail" value="<?php echo $email; ?>">
						  <label for="email">E-mail</label>
						</div>
						<div class="input-field">
						  <input id="telefone1" type="text" class="validate phone_with_ddd" name="telefoneFixo" value="<?php echo $telefone1; ?>">
						  <label for="telefone1">Telefone Fixo</label>
						</div>
						<div class="input-field">
						  <input id="telefone2" type="text" class="validate sp_celphones" name="telefone2" value="<?php echo $telefone2; ?>" onkeypress="return SomenteNumero(event)">
						  <label for="telefone2">Telefone Celular</label>
						</div>
						<div class="input-field">
						  <input id="telefone3" type="text" class="validate sp_celphones" name="telefone3" value="<?php echo $telefone3; ?>" onkeypress="return SomenteNumero(event)">
						  <label for="telefone3">Telefone Recado</label>
						</div>
						<label>
					        <input type="checkbox" class="filled-in" checked="checked" />
					        <span>Exibir Aniversário?</span>
      					</label>
      					<div class="right-align">
						  	<button class="btn waves-effect" type="submit" name="action">Gravar</button>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>


<!--

<div class="row">
		<div class="col s12 m6 l6 background-image">
			<div class="input-field col s12 m3 l3 center-align">
				<img id="img-upload" src="assets/images/marcelo.jpg" class="circle responsive-img asdffdsa">
			</div>			
			<div class="col s12 m12 l5">
				<div class="col s12">
					<h5>Marcelo Mechi</h5>
				</div>
				<div class="col s12">
					<h6>Analista de Tráfego - M.I.S.</h6>
				</div>
				<div class="col s12">
					<h6>Membro desde 2013</h6>
				</div>	
			</div>
			<div class="col s12 m4 l4 right-align">				
					<div class="col s12">
						<h5><h6>Administrador</h6></h5>
					</div>			
			</div>
		</div>
</div>
<div class="row">
			<div class="input-field col s12">
					<div class="file-field input-field">
						  <div class="btn waves-effect">
							<span>Editar Foto</span>
							<input type="file" id="imgInp"><i class="fas fa-camera"></i>
						  </div>
						  <div class="file-path-wrapper hide">
							<input class="file-path validate" type="text">
						  </div>
					</div>
					<div class="file-field input-field">
						  <div class="btn fundo waves-effect">
							<span>Editar Imagem de Fundo</span>
							<input type="file" id="imgInp"><i class="fas fa-camera"></i>
						  </div>
						  <div class="file-path-wrapper hide">
							<input class="file-path validate" type="text">
						  </div>
					</div>
			</div>
</div>


<!--
<div class="row">
	<form method="POST">
					<div class="col s12 m6 l6">
				<div id="tema" class="switch"><br>
					<label class="center-align">
					  <input type="checkbox">
					  <span class="lever"></span>
					</label>
				</div>
				<label for="tema">Tema Escuro</label>
			</div> 
			<div class="input-field col s12 m6 l6">
			  <input id="apelido" type="text" class="validate" name="apelido">
			  <label for="apelido">Nome</label>
			</div>
	</form>
</div>
-->

<script type="text/javascript">
	
  $(document).ready(function(){
  
	// altera foto do perfil
		$(".btn").change(function(){
			$("#img-upload").attr('src',URL.createObjectURL(event.target.files[0]))
		});

	// altera fundo de tela

	 $('.carousel.carousel-slider').carousel({
   	 	fullWidth: true,
    	indicators: true
  	});


	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('.sp_celphones').mask(SPMaskBehavior, spOptions);
	$('.phone_with_ddd').mask('(00) 0000-0000');




		
  });








   // valida campo somente numeros //
    function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
        else  return false;
        }
    }


</script>