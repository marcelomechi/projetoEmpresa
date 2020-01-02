<!DOCTYPE html>
<html>
    <head>
        <title>Workforce Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Language" content="pt-br">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?php if ($_SESSION['perfilDeslogueAutomatico'] == 1): ?>
                 <!--   <meta http-equiv="refresh" content="10;url=<?php /* echo BASE_URL; */ ?>logout" /> -->
        <?php endif; ?>     


        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cssFramework/css/style.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css">
        <link href="<?php echo BASE_URL; ?>assets/css/fontA/css/fontawesome.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>assets/css/fontA/css/brands.css" rel="stylesheet">
        <link href="<?php echo BASE_URL; ?>assets/css/fontA/css/solid.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/datatable.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/template/assets/css/customTemplate.css">
        <!-- Corrige o erro 500 -->
        <link rel="icon" href="data:,">
    </head>
    <body onload="carregaTema(<?php echo $_SESSION['tema'] ?>)">   
        <div class="navbar-fixed"> 
            <nav class="black">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo center"></a>  
                    <div data-target="sidebar" class="sidenav-trigger"><i class="material-icons white-text"><i class="fas fa-bars menuHoverTemplate"></i></i></div>
                    <span class="brand-logo center tituloMenu"><?php echo $_SESSION['relatorio']; ?></span>
                    <ul id="dadosPessoais" class="right">                   
                        <li><a><img id="profile" class="circle responsive-img fotoUsuarioMenu" src="<?php echo BASE_URL . $_SESSION['foto_perfil']; ?>"></a></li>      
                        <li><a href="<?php echo BASE_URL . 'home'; ?>" class="tooltipped" data-position="bottom" data-tooltip="Voltar para a página inicial"><i class="fas fa-home"></i></a></li>
                        <li><a href="<?php echo BASE_URL . 'logout'; ?>" class="tooltipped" data-position="bottom" data-tooltip="Sair"><i class="fas fa-power-off"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="sidebar" class="sidenav" style="width: 340px !important;">    
            <div class="user-view">
                <div class="background">
                    <?php if (!isset($_SESSION['foto_menu']) || empty($_SESSION['foto_menu'])): ?>  
                        <div class="backgroundImgMenu teal"></div>
                    <?php else: ?>
                        <img src="<?php echo BASE_URL . $_SESSION['foto_menu']; ?>" class="backgroundImgMenu">
                    <?php endif; ?>
                </div>
                <img id="perfilFoto" class="circle responsive-img fotoUser" src="<?php echo BASE_URL . $_SESSION['foto_perfil']; ?>">
                <a><span class="white-text name"><?php echo $_SESSION['apelido']; ?></span></a>
                <a><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
            </div>
            <ul class="collapsible">
                <li class="hide-on-med-and-up"><a href="<?php echo BASE_URL . 'home'; ?>" class="collapsible-header"><i class="material-icons"><i class="fas fa-home"></i></i>Página Inicial</a></li>
                <?php
                $menu = new Usuario();
                $item = $menu->menu();
                ?>
                <li class="hide-on-med-and-up"><div class="divider"></div></li>
                <li class="hide-on-med-and-up"><a href="<?php echo BASE_URL . 'logout'; ?>" class="collapsible-header"><i class="material-icons"><i class="fas fa-power-off"></i></i>Sair</a></li>

            </ul>
        </div>   

        <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.1.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/jquery.ui.touch-punch.min.js"></script>

        <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/brands.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/solid.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/css/fontA/js/fontawesome.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/css/cssFramework/js/jsPrincipal.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/datatable.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>views/template/assets/js/jsTemplate.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/vendor/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/vendor/jquery-sortablejs-master/Sortable.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/vendor/jquery-validation-1.19.1/dist/jquery.validate.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/vendor/jquery.loadscript.js"></script>
        <?php $this->loadViewInTemplate($viewName, $viewData, $folder); ?>

        <script>
        function carregaTema(id) {
            // pegar os dados do session, ver se está preenchido, em seguida só pegar o valor ao invés de setar sempre o mesmo.... 
            // ele vai setar só uma vez ao carregar a página, nas próximas vezes ele vai só carregar...

            // var darkThemeSelected = (localStorage.getItem('themeSwitch') !== null && localStorage.getItem('themeSwitch') === 'dark');
            // darkThemeSelected ? document.body.setAttribute('data-theme', 'dark') : document.body.removeAttribute('data-theme')
           

            if (id == 1) {
                document.documentElement.setAttribute('data-theme', 'dark');
                //localStorage.setItem('theme', 'dark');

                console.log("carregou tema escuro")
              
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                ///localStorage.setItem('theme', 'light');
                console.log("carregou tema claro")
             
            }
        }

        /*
         setInterval(function(){
         
         },2000);
         */

        </script>

    </body>
</html>