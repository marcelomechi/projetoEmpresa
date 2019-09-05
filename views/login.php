<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>WFM</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/cssFramework/css/materialize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/brands.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/custom.css">

</head>
<body>
<!--
Vamos criar oa tela de login
-->
  <div class="grid centro">

    <div>


    </div>
     
      <div  class="card-panel hoverables center-align">                 

        <div class="card-content card-size">          
                  
              <div class="grid grid-template-areas-4">      

                 <section id="cardUsuario" class="esquerda"> 
                  
                   <div class="input-field">
                        <img src="<?php echo BASE_URL;?>assets/images/wfm.png" class="responsive-img foto">
                   </div>
                   <div class="input-field">   
                      <div class="card-title w100 flow-text center-align"><b>Workforce Menagement</b></div>
                   </div> 
                  <div class="input-field">
                      <input type="text" autocomplete="off" class="validate" name="usuario" id="usuario" onkeypress="return SomenteNumero(event)" />
                      <label for="usuario" data-error="Preencha corretamente o campo Usuário" data-success="">CPF</label>
                      <span class="flow-text red-text" id="nLocalizado" hidden>Usuário não localizado.</span>
                      <span class="flow-text red-text" id="inativo" hidden>Usuário inativo.</span>
                  </div>
                  <div class="input-field left-align">
                      <a href="#" id="recuperaSenha">Não me lembro</a>
                  </div>
                     <div class="input-field">
                        <button type="submit" id="proximo" class="btn waves-effect waves-light w100">Próximo</button>
                     </div> 
                     <div id="loadUsuario" class="input-field" hidden> 
                         <div class="progress">
                             <div class="indeterminate"></div>
                         </div>
                     </div>                           
                </section>            


                <section id="cardSenha" class="esquerda" hidden> 
                      <div class="card-title left-align">
                        
                        <i id="voltar" class="fas fa-arrow-left"></i> 
                      </div>                                
                            <i class="fas fa-user-circle large"></i> 
                      <div class="card-title w100 flow-text">Olá, <span id="nomeUsuario"></span>!</div>
                        <div class="input-field col s12">              
                          <input type="password" class="validate" name="password" id="password"/>
                          <label for="password" data-error="Preencha corretamente o campo Senha" data-success="">Senha</label>
                          <span class="flow-text red-text" id="senhaInvalida" hidden>Usuário ou senha inválido.</span>
                        </div>
                            <p class="left-align">
                              <input type="checkbox" class="filled-in left" id="filled-in-box"  />
                              <label for="filled-in-box">Mantenha-me Conectado.</label>
                            </p>
                         <div class="input-field">
                              <button class="btn waves-effect waves-light w100" id="logar">Entrar</button>
                        </div>
                     <div class="input-field" id="loadSenha" hidden> 
                         <div class="progress">
                             <div class="indeterminate"></div>
                         </div>
                     </div>  
                </section>


                 <section id="cardEsqueciSenha" class="esquerda" hidden>                     
                      <div class="card-title w100 flow-text">Recuperação de Acesso</div>
                       <div class="input-field">
                        <span>Vamos ajudá-lo a redefinir sua conta, primeiro digite seu CPF, caso tenha e-mail, digite também.
                        </span>
                       </div>
                        <div class="input-field">              
                          <input type="text" class="validate" name="cpf" id="cpf" required />
                          <label for="cpf" data-error="Preencha o campo corretamente" data-success="">CPF</label>
                        </div>
                         <div class="input-field">              
                          <input type="email" class="validate" name="email" id="email" />
                          <label for="email" data-error="Preencha o campo corretamente" data-success="">E-mail</label>
                        </div>
                        <div class="input-field right-align">                              
                              <button id="cancelaEsqueciSenha" class="btn waves-effect waves-light red responsivo-w100">Cancelar</button>
                              <button id="proximoRedefinirSenha" class="btn waves-effect waves-light responsivo-w100">Próximo</button>
                        </div>
                        <div class="progress">
                          <div class="indeterminate"></div>
                        </div>
                </section>



                <section id="cardNovaSenha" class="esquerda" hidden>                     
                        <div class="card-title w100 flow-text">Recuperação de Acesso</div>
                        <div class="input-field">              
                          <input type="password" class="validate" name="novaSenha" id="novaSenha" required />
                          <label for="novaSenha" data-error="Preencha o campo corretamente" data-success="">Digite sua nova senha</label>
                        </div>
                         <div class="input-field">              
                          <input type="password" class="validate" name="novaSenhaValidacao" id="novaSenhaValidacao" />
                          <label for="novaSenhaValidacao" data-error="As senhas não conferem" data-success="">Digite novamente</label>
                        </div>
                        <div class="input-field">              
                          <input type="text" class="validate" name="token" id="tokenValidaNovaSenha" />
                          <label for="tokenValidaNovaSenha" data-error="Digite corretamente o código recebido" data-success="">Digite o token recebido</label>
                        </div>
                        <div class="input-field right-align">
                              <button data-target="teste" class="btn waves-effect waves-light modal-trigger responsivo-w100">Gravar Alteração</button>
                        </div>
                        <div class="progress">
                          <div class="indeterminate"></div>
                        </div>
                </section>


            </div>
        </div>
    
    </div>

<div class="modal bottom-sheet" id="teste">
  <div class="modal-content center-align">
      <h4>Sua Solicitação foi concluída</h4>
      <p>
          Acesse sua conta com os novos dados
      </p>
  </div>
  <div class="modal-footer right-align">
      <button id="fechaModalSenha" class="btn modal-close modal-action red">Fechar</button>
  </div>
</div>


<div class="modal bottom-sheet" id="teste2">
  <div class="modal-content center-align">
      <p>
          Usuário não localizado, verifique suas informações.
      </p>
  </div>
  <div class="modal-footer right-align">
      <button id="fecha" class="btn modal-close modal-action red">Fechar</button>
  </div>
</div>


<!-- o jquery vem sempre antes do materialize -->
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/materialize.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/brands.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/solid.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/fontawesome.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/js.js"></script>

<script>
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

</body>
</html>