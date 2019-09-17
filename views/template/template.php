<!DOCTYPE html>
<html>
<head>

<style>

#img{
  height: 20px;
}

#main{
  width: 50px !important;
}

.w20{
  width: 20px !important;
  align: center !important;
  margin: 0 !important;
  padding: 0 !important;
}

.h{
  height: 110px !important;
  border-radius: 50% !important;
}

.h10{
  height: 30px !important;
  border-radius: 50% !important;
}

.graficoPizza{
  min-height: 300px;
}

.item-linha-1{
  min-height: 200px !important;
  
}

.item-linha-2{
  min-height: 600px !important;
}


.w100{
  width: 100% !important;
}

#example_wrapper{
  width: 100% !important;
}





#grafico{
  width: 100%;
  height: 100%;
}


.hvr{
  cursor: pointer;
}

#entrantesAbandonadas{
  max-height: 300px;
  width: auto;
}

@media (max-width: 600px) 
{

  #dadosPessoais{
    display: none;
  }


}



</style>
	<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/cssFramework/css/materialize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/brands.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/datatable.css">
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body>
<nav>
    <div class="row">        
      <div class="nav-wrapper indigo col s12 m12 l12">
      <a href="#" class="brand-logo center"></a>  
        <div id="main" data-target="sidebar" class="sidenav-trigger"><i class="material-icons white-text"><i class="fas fa-bars hvr"></i></i></div>
          <ul id="dadosPessoais" class="right">                   
            <li><a href="#"><i class="material-icons center-align"><img id="profile" class="responsive-img h10" src="assets/images/marcelo.jpg"></i></a></li>      
            <li><a href="#"><i class="fas fa-bell"></i></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
              
  <div id="sidebar" class="sidenav">    
              <div class="user-view">
                <div class="background">
                  <img src="assets/images/computador.jpg">
                </div>
                
                  <a href="#!user"><img id="profile" class="responsive-img h" src="assets/images/marcelo.jpg"></a>

                <a href="#!name"><span class="white-text name">Marcelo Mechi</span></a>
                <a href="#!email"><span class="white-text email">marcelo.goncalves@brbpo.com.br</span></a>
              </div>

        <ul class="collapsible">
          <li>
              <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="assets/images/trabalho-em-equipe.png"></i><i class="material icons small right"><i class="fas fa-angle-down"></i></i>DH</a>
              <div class="collapsible-body">
                        <ul>
                          <li><a href="#!">Avaliações</a></li>
                          <li><a href="#!">Banco de Curriculum</a></li>
                              <ul class="collapsible">
                                  <li>
                                  <a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>Relatórios</a>
                                  <div class="collapsible-body">
                                      <ul>
                                      <li><a href="#!">Desempenho</a></li>
                                      </ul>
                                  </div>
                                  </li>
                              </ul>
                              <li><a href="#!">Quadro de Funcionários</a></li>
                        </ul>
                </div>
          </li>
          <li>
                <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="assets/images/inteligencia.png"></i>Planejamento<i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#!">Dimensionamento</a></li>
                    <li><a href="#!">Atendimento de Demandas</a></li>
                  </ul>
                </div>
          </li>
          <li>
          <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="assets/images/hospital.png"></i><i class="material icons small right"><i class="fas fa-angle-down"></i></i>Sesmt</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">Atestados</a></li>
              </ul>
            </div>
          </li>


           <li>
          <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="assets/images/sistema.png"></i><i class="material icons small right"><i class="fas fa-angle-down"></i></i>Administração</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">Administrar Módulos</a></li>
              </ul>
            </div>
          </li>

                     <li>
          <a class="collapsible-header"><i class="material-icons"><img id="img" class="circle" src="assets/images/report.png"></i><i class="material-icons small right"><i class="fas fa-angle-down"></i></i>Relatórios</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="<?php echo BASE_URL;?>dashboard">Dashboard</a></li>
              </ul>
            </div>
          </li>

        </ul>
</div>   

<div>
  <?php// $this -> loadViewInTemplate($viewName, $viewData); ?>

</div>




    
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/brands.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/solid.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/fontawesome.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/materialize.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/datatable.js"></script>


</body>
</html>

<script>
/* Definir a largura da barra lateral para 250px e a margem esquerda do conteúdo da página para 250px */

$(document).ready(function(){
 $('.collapsible').collapsible();
 $('.tap-target').tapTarget('open');
 
  /* inicia a sidenav */
   $(".sidenav").sidenav({
    onOpenStart: function(){
     // document.getElementById("main").style.marginLeft = "300px";
     //document.getElementById("main").style.transition = "0.1s";
     // document.getElementById("main2").style.marginLeft = "300px";
     // document.getElementById("main2").style.transition = "0.1s";
    },
    onCloseEnd: function(){
     // document.getElementById("main").style.marginLeft = "18px";
     // document.getElementById("main").style.transition = "0.1s";
     // document.getElementById("main2").style.marginLeft = "auto";
     // document.getElementById("main2").style.transition = "0.1s";      
    }
   });

  })

   
	</script>