<style type="text/css">

.asdffdsa{
	height: 110px !important;
	width: 110px !important;
}

.w1999{
	width: 100% !important;
}

.background-image{
	  background-image: url("<?php echo BASE_URL;?>assets/images/tecnologia.jpg");
	  background-size: cover;
	  height: 222px;
	  width: 300px;
}

</style>
<div class="row">
		<div class="col s12 m6 l6 background-image">
			<div class="input-field col s12 m3 l3 center-align">
				<img id="img-upload" src="<?php echo BASE_URL;?>assets/images/marcelo.jpg" class="circle responsive-img asdffdsa">
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

		
  });

</script>