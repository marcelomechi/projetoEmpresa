<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
	
/* O menu da barra lateral */
.sidebar {
  height: 100%; /* 100% altura */
  width: 50px !important; /* 0 largura - altere isso com JavaScript */
  position: fixed; /* Fique no lugar */
  z-index: 1; /* Fique no topo */
  top: 0;
  left: 0;
  /*background-color: #111; /* Black*/
  overflow-x: hidden; /* Desativar rolagem horizontal */
  padding-top: 60px; /* Coloque o conteúdo de 60px a partir do topo */
  transition: 0.5s; /* Efeito de transição de 0,5 segundo para deslizar na barra lateral */
}
#mySidebar{
  width: 50px;
}

#img{
  height: 30px;
}
/* Os links da barra lateral 
.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}*/
/* Quando você passa o mouse sobre os links de navegação, muda sua cor */
.sidebar a:hover {
 /* color: #f1f1f1;*/
}
/* Aprenda a pronunciar
Posicione e estilize o botão Fechar (canto superior direito) */
.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
/* O botão usado para abrir a barra lateral */
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}
.openbtn:hover {
  /*background-color: #444;*/
}
/* Conteúdo da página de estilo - use isso se você quiser enviar o conteúdo da página para a direita quando abrir a navegação lateral */
#main {
  transition: margin-left .5s; /* Se você quiser um efeito de transição */
  padding: 20px;
  margin-left: 50px;
}
/* Em telas menores, nas quais a altura é menor que 450 px, altere o estilo do sidenav (menos preenchimento e um tamanho de fonte menor) 
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
*/
  header, main, footer {
      padding-left: 300px;
    }
    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }
</style>

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/cssFramework/css/materialize.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link href="<?php echo BASE_URL;?>assets/css/fontA/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>assets/css/fontA/css/brands.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>assets/css/fontA/css/solid.css" rel="stylesheet">
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body>

<ul id="mySidebar" class="side-nav fixed">
                <ul class="collapsible" data-collapsible="expandable">
                    <li>
                      <div class="center-align">
                         <img id="img" class="circle" src="<?php echo BASE_URL;?>assets/images/demanda.png">
                      </div>                               
                    </li>
                       <div class="center-align">
                         <img id="img" class="circle" src="<?php echo BASE_URL;?>assets/images/report.png">
                       </div>          
                      
                    </li>
                </ul> 
</ul>


<ul id="mySidebar2" class="side-nav fixed" hidden>
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
</ul>







<div id="main" class="">
      <?php
        $this->loadViewInTemplate($viewName,$viewData);
      ?>
</div>

<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/brands.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/solid.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/fontawesome.js"></script>


<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/materialize.js"></script>

</body>
</html>

<script>
/* Definir a largura da barra lateral para 250px e a margem esquerda do conteúdo da página para 250px */
$(document).ready(function(){
 $('.collapsible').collapsible();
  /* inicia a sidenav */
   $(".button-collapse").sideNav();
})
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("mySidebar").style.transition = "0.5s";
  document.getElementById("main").style.marginLeft = "280px";
  document.getElementById("main").style.transition = "0.5s";
  
  $("#mySidebar2").css("display", "block")
  $("#mySidebar").css("display", "none")
  

}
/* Defina a largura da barra lateral como 0 e a margem esquerda do conteúdo da página como 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "50px";
  document.getElementById("mySidebar").style.transition = "0.5s";
  document.getElementById("main").style.marginLeft = "50px";
  document.getElementById("main").style.transition = "0.5s";
  
  $("#mySidebar").css("display", "block")
  collapseAll()
  $("#mySidebar2").css("display", "none");
}
function expandAll(){
  $(".collapsible-header").addClass("active");
  $(".collapsible").collapsible({accordion: false});
}
function collapseAll(){
  $(".collapsible-header").removeClass(function(){
    return "active";
  });
  $(".collapsible").collapsible({accordion: true});
  $(".collapsible").collapsible({accordion: false});
}
  $( ".side-nav" ).hover(
    function() {
       openNav()     
    }, function() {
      closeNav() 
    }
);
  /*
  $( "#slide-out" ).hover(
    function() {
      //$('.button-collapse').sideNav('show');        
    }, function() {
    collapseAll()
    }
);
*/
	</script>