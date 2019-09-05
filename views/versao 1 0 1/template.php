<!DOCTYPE html>
<html>
<head>

<style>

#img{
  height: 20px;
}

</style>
	<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/cssFramework/css/materialize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body>
      
<div class="row">
<div class="navbar">
    <nav>
      <div class="nav-wrapper  blue-grey darken-4">
        <ul class="left">
          <li><div id="main" onclick="openNav()" data-target="sidebar" class="sidenav-trigger"><i class="material-icons white-text">menu</i></div></li>
        </ul>
      </div>
    </nav>
  </div>    

<div class="container"> 
    
    
<div id="sidebar" class="sidenav">    
            <div class="user-view">
              <div class="background">
                <img src="<?php echo BASE_URL;?>assets/images/computador.jpg">
              </div>
              <a href="#!user"><img class="circle" src="<?php echo BASE_URL;?>assets/images/marcelo.jpg"></a>
              <a href="#!name"><span class="white-text name">Marcelo Mechi</span></a>
              <a href="#!email"><span class="white-text email">marcelo.goncalves@brbpo.com.br</span></a>
            </div>

      <ul class="collapsible">
        <li>
            <a class="collapsible-header"><i class="material-icons">arrow_drop_down</i>Point</a>
            <div class="collapsible-body">
                      <ul>
                        <li><a href="#!">Apontamentos</a></li>
                        <li><a href="#!">Gerencial</a></li>
                            <ul class="collapsible">
                                <li>
                                <a class="collapsible-header">Menu com submenu</a>
                                <div class="collapsible-body">
                                    <ul>
                                    <li><a href="#!">asdf</a></li>
                                    <li><a href="#!">asdf</a></li>
                                    <li><a href="#!">asdf</a></li>
                                    </ul>
                                </div>
                                </li>
                            </ul>
                            <li><a href="#!">Teste</a></li>
                      </ul>
              </div>
        </li>
        <li>
              <a class="collapsible-header">Quadro<i class="material-icons">arrow_drop_down</i></a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="#!">Gerenciar</a></li>
                  <li><a href="#!">Dados Funcionários</a></li>
                  <li><a href="#!">Parametrizar</a></li>
                </ul>
              </div>
        </li>
        <li>
        <a class="collapsible-header"><i class="material-icons">arrow_drop_down</i>Demandas</a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!">Atendimento</a></li>
              <li><a href="#!">Nova Demanda</a></li>
              <li><a href="#!">Minhas Demandas</a></li>
            </ul>
          </div>
        </li>
        <li>
          <a class="collapsible-header">Planejamento<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!">Faturamento</a></li>
              <li><a href="#!">Dimensionamento</a></li>
              <li><a href="#!">Escala de Pausa</a></li>
            </ul>
          </div>
        </li>
      </ul> 
        
            
</div>      
    </div>
</div>

    


    <div  class="">
      <?php
        $this->loadViewInTemplate($viewName,$viewData);
      ?>
    
    
        <!--<a href="#" onclick="openNav()" data-target="sidebar" class="sidenav-trigger"><i class="material-icons">menu</i></a>-->
        <!--<a href="#" onclick="openNav()"  data-activates="mySidebar"  class="button-collapse visible-only-small-screen"><i class="material-icons">menu</i></a>-->
        <!-- caso eu queira que abra em um clique <button class="openbtn" onclick="openNav()">&#9776;BARRA FILHA DA PUTAAAAAA</button> -->
    </div>

    
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/materialize.js"></script>


</body>
</html>

<script>
/* Definir a largura da barra lateral para 250px e a margem esquerda do conteúdo da página para 250px */

$(document).ready(function(){
 $('.collapsible').collapsible();
  /* inicia a sidenav */
   $(".sidenav").sidenav({
    onCloseEnd: function () {
        document.getElementById("main").style.marginLeft = "0px";
        document.getElementById("main").style.transition = "0.2s";
    }
   });

  })




function openNav() {
  //document.getElementById("mySidebar").style.width = "250px";
  //document.getElementById("mySidebar").style.transition = "1s";
  document.getElementById("main").style.marginLeft = "310px";
  document.getElementById("main").style.transition = "0.1s";
  //collapseAll()
}
/* Defina a largura da barra lateral como 0 e a margem esquerda do conteúdo da página como 0 */
function closeNav() {
 // document.getElementById("mySidebar").style.width = "50px";
  //document.getElementById("mySidebar").style.transition = "1s";
  document.getElementById("main").style.marginLeft = "0px";
  document.getElementById("main").style.transition = "0.2s";
 // collapseAll()
}




	</script>