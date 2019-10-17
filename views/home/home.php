<style>

    .teste{
     //   position: relative;
     //   height: 80vh;
     //   margin: 0;
    }

  .modal{
   // text-align: center !important;
   // position: absolute !important;
    //padding: 20px !important;
   // left: 50% !important;
   // top: 50% !important;
    //-webkit-transform: translateX(-50%) translateY(-50%) !important;
    //transform: translateX(-50%) translateY(-50%) !important;
   // max-height: 100%  !important;
  }
  
  .modal-content{
     /* max-height: 900px !important;
      background-color: orange;*/
  }
  
  .carousel-item{
     /* min-height: 300px !important;*/
  }
  
  .conteudo{
   //   height: 900px !important;
      
  }

  
  .carousel-slider{
     // height: 200px !important;
  }
  
  div#modal1 {
 //   height: 1000px;
}

.carousel .indicators .indicator-item{
    //background-color: #000 !important;
}

.carousel .indicators .indicator-item.active{
   // background-color: blue !important;
}




</style>



<?php echo $_SESSION['token']; ?>

<?php if($_SESSION['senha'] == md5($_SESSION['CPF'])): ?>

  <div id="modal1" class="modal">
    <div class="modal-content">
        <h5 class="center-align">Seja bem-vindo ao novo Workforce, <?php echo $nome; ?>!</h5>
        <p class="center-align">Identificamos que está acessando a ferramenta usando sua senha inicial, solicitamos que você altere para uma senha de sua preferência, que seja diferente da senha inicial, para isso, preencha as informações abaixo.</p>
        <div class="input-field">
          <input id="cpf" type="text" class="cpf">
          <label for="cpf">Digite seu CPF</label>
        </div>
        <div class="input-field">
          <input id="novaSenha" type="password" class="validate">
          <label for="novaSenha">Nova Senha</label>
        </div>
        <div class="input-field">
          <input id="confirmaNovaSenha" type="password" class="validate">
          <label for="confirmaNovaSenha">Confirme sua nova senha</label>
        </div>
         <div class="input-field right-align">            
           <button id="gravaAlteracaoSenha" class="btn waves-effect">Gravar</button> 
        </div>
      
  </div>
    </div>

  

  <script>
      
      
  $(document).ready(function(){
    $('.modal').modal({ 
        //'onOpenEnd': iniciaCarousel,
         dismissible: false
    }); 
    
     $('.modal').modal('open');
    
    /*function clica(){
        $("#testando").click();
    }*/
    
    /*function iniciaCarousel() { 
        $('.carousel.carousel-slider').carousel({
                fullWidth: true
               // indicators: true
        }) 
    } */
    
    
     $('.cpf').mask('000.000.000-00', {reverse: true});
     
     
     
       $('#gravaAlteracaoSenha').on('click', function () {
            if($("#cpf").val() == "" || $("#novaSenha").val() == "" || $("#confirmaNovaSenha").val() == ""){
                 M.toast({html: 'Preencha todas as informações.', classes: 'red lighten-2'});                 
                 return 0;                 
            }else{
                if($("#novaSenha").val() != $("#confirmaNovaSenha").val()){
                    M.toast({html: 'As senhas não conferem, preencha novamente.', classes: 'red lighten-2'});
                    $("#cpf").val("");
                    $("#novaSenha").val("");
                    $("#confirmaNovaSenha").val("");
                    return 0;   
                }else if($("#novaSenha").val() == $("#confirmaNovaSenha").val() && $("#novaSenha").val() ==  $("#cpf").val() && $("#confirmaNovaSenha").val() == $("#cpf").val()){
                     M.toast({html: 'Por favor preencha uma senha diferente do seu CPF.', classes: 'red lighten-2'});
                     $("#cpf").val("");
                     $("#novaSenha").val("");
                     $("#confirmaNovaSenha").val("");
                    return 0;
                }
            }            
            
             var cpf = $("#cpf").val().replace(/[^0-9]/g,'');
             var novaSenha = $("#novaSenha").val();
             var novaSenhaConfirma = $("#confirmaNovaSenha").val();
        
             $.ajax({
                url: 'http://10.11.194.42/ajaxHome',
                type: 'POST',
                async: false,
                //dataType: "json",
                data: {CPF: cpf, novaSenha: novaSenha, novaSenhaConfirma: novaSenhaConfirma},
                success: function (r) {
                    if (r == "success") {                        
                        M.toast({html: 'Senha alterada com sucesso!', classes: 'teal accent-4', completeCallback: function(){$('.modal').modal('close');} });
                        $("#cpf").val("");
                        $("#novaSenha").val("");
                        $("#confirmaNovaSenha").val("");
                    } else {
                       M.toast({html: 'Não foi possível atender sua solicitação, verifique as informações preenchidas.', classes: 'red lighten-2'});
                        $("#cpf").val("");
                        $("#novaSenha").val("");
                        $("#confirmaNovaSenha").val("");
                    }
                }
            });
     
      });
     
     
  });
  

      </script>
      
<?php endif; ?>
