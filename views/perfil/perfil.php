<link rel="stylesheet" href="<?php echo BASE_URL; ?>views/perfil/assets/css/customPerfil.css">
<div class="row h580 tool">
    <div class="col s12 m12 l6">
        <div class="card h580">
            <div class="card-content">
                <span class="card-title center-align"><h5>Imagem de fundo e foto do perfil</h5></span>
                <div class="carousel carousel-slider center h350">
                    <div class="carousel-fixed-item center">						     	
                        <div class="input-field left-align padding">
                            <?php if (empty($caminhoFoto)): ?>
                                <img id="img-upload" src="assets/images/default.jpg" class="circle responsive-img tamanhoFotoPerfil">
                            <?php else: ?>
                                <img id="img-upload" src="<?php echo BASE_URL . $caminhoFoto ?>" class="circle responsive-img tamanhoFotoPerfil">
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
                    $carousel = $usuarios->carregaCarousel();
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
        <div class="card h580">
            <div class="card-content">
                <span class="card-title center-align"><h5>Dados e preferências pessoais</h5></span>

                <div id="tema" class="switch"><br>
                    <label class="theme-switch">
                        Tema Escuro
                        <?php if ($id_tema_preferido == 0): ?>
                            <input type="checkbox" name="tema">
                        <?php else: ?>
                            <input type="checkbox" name="tema" checked="checked">
                        <?php endif; ?>
                        <span class="lever"></span>
                    </label>
                </div>
                <div class="input-field">
                    <input id="apelido" type="text" class="validate textoInput" name="apelido" value="<?php echo $apelido; ?>">
                    <label for="apelido">Como gostaria de ser chamado?</label>
                </div>
                <div class="input-field">
                    <?php if (empty($email)): ?>
                        <input id="email" type="email" class="validate textoInput" name="email">
                    <?php else: ?>
                        <input id="email" type="email" class="validate textoInput" name="email" value="<?php echo $email; ?>">
                    <?php endif; ?>
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field">
                    <?php if (empty($telefone1)): ?>
                        <input id="telefone1" type="text" class="validate phone_with_ddd textoInput" name="telefoneFixo">
                    <?php else: ?>
                        <input id="telefone1" type="text" class="validate phone_with_ddd textoInput" name="telefoneFixo" value="<?php echo $telefone1; ?>">
                    <?php endif; ?>
                    <label for="telefone1">Telefone Fixo</label>
                </div>
                <div class="input-field">
                    <?php if (empty($telefone2)): ?>
                        <input id="telefone2" type="text" class="validate sp_celphones textoInput" name="telefoneCelular">
                    <?php else: ?>
                        <input id="telefone2" type="text" class="validate sp_celphones textoInput" name="telefoneCelular" value="<?php echo $telefone2 ?>">
                    <?php endif; ?>
                    <label for="telefone2">Telefone Celular</label>
                </div>
                <div class="input-field">
                    <?php if (empty($telefone3)): ?>
                        <input id="telefone3" type="text" class="validate sp_celphones textoInput" name="telefoneRecado">
                    <?php else: ?>
                        <input id="telefone3" type="text" class="validate sp_celphones textoInput" name="telefoneRecado" value="<?php echo $telefone3; ?>">
                    <?php endif; ?>
                    <label for="telefone3">Telefone Recado</label>
                </div>
                <label>
                    <?php if ($exibir_aniversario == 1): ?>
                        <input type="checkbox" class="filled-in" checked="checked" name="exibeAniversario"/>
                    <?php else: ?>
                        <input type="checkbox" class="filled-in" name="exibeAniversario"/>
                    <?php endif; ?>
                    <span>Exibir Aniversário?</span>
                </label>
                <div class="right-align">
                    <button data-target="updateSenha" class="btn waves-effect modal-trigger blue-grey lighten-1" id="alteraSenha">Alterar Senha</button>
                    <button class="btn waves-effect" id="gravaPreferencias">Gravar</button>
                    <button data-target="modalMsg" class="btn modal-trigger hide"></button>
                </div>
            </div>
        </div>
    </div>
</div>

 <div id="updateSenha" class="modal">
    <div class="modal-content center-align">
      <h5>Alteração de Senha</h5>
        <div class="input-field">
          <input id="senhaAntiga" type="password" class="validate">
          <label for="senhaAntiga">Senha Atual</label>
        </div>
        <div class="input-field">
          <input id="novaSenha" type="password" class="validate">
          <label for="novaSenha">Nova Senha</label>
        </div>
        <div class="input-field">
          <input id="confirmaNovaSenha" type="password" class="validate">
          <label for="confirmaNovaSenha">Confirme sua nova senha</label>
        </div>
    </div>
     <div class="modal-footer">
         <div class="right-align">             
          <button class="modal-close btn waves-effect red lighten-1" id="cancela">Fechar</button>
          <button id="gravaAlteracaoSenha" class="btn waves-effect">Gravar</button>
        </div>
     </div>
 </div>
<script src="<?php echo BASE_URL; ?>views/perfil/assets/js/jsPerfil.js"></script>

<script type="text/javascript">

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