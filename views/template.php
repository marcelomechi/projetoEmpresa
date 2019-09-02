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
</head>
<body>
  <ul id="mySidebar" class="side-nav fixed">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <ul class="collapsible" data-collapsible="expandable">
                    <li>
                      <div class="collapsible-header">
                        <i class="medium material-icons">insert_chart</i>sdfsf<i class="material-icons">keyboard_arrow_right</i>
                      </div>
                          <div class="collapsible-body left-align blue">
                              <ul class="collapsible" data-collapsible="expandable">
                                <li>
                                  <div class="collapsible-header">
                                    menu <i class="material-icons">keyboard_arrow_right</i>
                                  </div>
                                  <div class="collapsible-body center-align">
                                    item do submenu
                                  </div>
                                  <div class="collapsible-body center-align">
                                    item do submenu
                                  </div>
                                </li>
                              </ul>
                          </div>   
                      <div class="collapsible-body red">
                        item do menu principal
                      </div>              
                    </li>

                    <li>
                      <div class="collapsible-header">
                        <i class="material-icons">dashboard</i>Menu
                      </div>
                      <div class="collapsible-body">
                        item do menu principal
                      </div>
                      <div class="collapsible-body center-align">
                        item do menu principal
                      </div>
                    </li>
                </ul> 
        </ul>

<div id="main" class="">
 
    <a href="#" onclick="openNav()"  data-activates="mySidebar"  class="button-collapse visible-only-small-screen"><i class="material-icons">menu</i></a>
    <!-- caso eu queira que abra em um clique <button class="openbtn" onclick="openNav()">&#9776;BARRA FILHA DA PUTAAAAAA</button> -->

    <div>

      <?php
        $this->loadViewInTemplate($viewName,$viewData);
      ?>

    </div>


</div>

<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/cssFramework/js/materialize.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>

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
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementById("main").style.transition = "0.5s";
}

/* Defina a largura da barra lateral como 0 e a margem esquerda do conteúdo da página como 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "50px";
  document.getElementById("mySidebar").style.transition = "0.5s";
  document.getElementById("main").style.marginLeft = "50px";
  document.getElementById("main").style.transition = "0.5s";
  collapseAll()
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

  $( "#mySidebar" ).hover(
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