<!DOCTYPE html>
<html>
<head>

<title>WFM</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


     <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/cssFramework/css/material.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/brands.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>/assets/css/fontA/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/datatable.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>views/template/assets/css/customTemplate.css">
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body class="grey lighten-4">
<div class="navbar-fixed"> 
  <nav class="grey darken-4">
              <div class="nav-wrapper">
              <a href="#" class="brand-logo center"></a>  
                <div data-target="sidebar" class="sidenav-trigger"><i class="material-icons white-text"><i class="fas fa-bars menuHoverTemplate"></i></i></div>
                  <span class="brand-logo center tituloMenu"><?php echo $_SESSION['relatorio']; ?></span>
                  <ul id="dadosPessoais" class="right">                   
                    <li><a href="#"><i class="material-icons center-align"><img id="profile" class="circle responsive-img h10Template" src="assets/images/marcelo.jpg"></i></a></li>      
                    <li><a href="#"><i class="fas fa-bell"></i></a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i></a></li>
                  </ul>
            </div>
  </nav>
</div>
  <div id="sidebar" class="sidenav">    
              <div class="user-view">
                <div class="background">
                  <img src="assets/images/computador.jpg" class="backgroundImgMenu">
               </div>                
                <a href="#!user"><img id="profile" class="circle h110Template responsive-img" src="assets/images/marcelo.jpg"></a>
                <a href="#!name"><span class="white-text name">Marcelo Mechi</span></a>
                <a href="#!email"><span class="white-text email">marcelo.goncalves@brbpo.com.br</span></a>
              </div>
        <ul class="collapsible">
          <?php 
            $menu = new Usuarios();  
            $item = $menu -> menu();
          ?>
        </ul>
</div>   
    
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/brands.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/solid.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/fontawesome.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/jsMaterial.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/datatable.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>views/template/assets/js/jsTemplate.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>



<?php $this -> loadViewInTemplate($viewName, $viewData); ?>


</body>
</html>