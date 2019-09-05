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
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body>
  <nav>
    <div class="row">
      <div class="nav-wrapper indigo col s12 m12 l12 valign-wrappe">
        <div id="main" data-activates="sidebar" class="button-collapse"><i class="material-icons white-text"><i class="fas fa-bars"></i></i></div>
          <ul class="right">                   
            <li><a href="#"><i class="material-icons center-align"><img id="profile" class="responsive-img h10" src="<?php echo BASE_URL;?>assets/images/marcelo.jpg"></i></a></li>      
            <li><a href="#"><i class="fas fa-bell"></i></a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
              
  <div id="sidebar" class="side-nav">    
              <div class="user-view">
                <div class="background">
                  <img src="<?php echo BASE_URL;?>assets/images/computador.jpg">
                </div>
                
                  <a href="#!user"><img id="profile" class="responsive-img h" src="<?php echo BASE_URL;?>assets/images/marcelo.jpg"></a>

                <a href="#!name"><span class="white-text name">Marcelo Mechi</span></a>
                <a href="#!email"><span class="white-text email">marcelo.goncalves@brbpo.com.br</span></a>
              </div>

        <ul class="collapsible">
          <li>
              <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="<?php echo BASE_URL;?>assets/images/trabalho-em-equipe.png"></i><i class="material icons small right"><i class="fas fa-angle-down"></i></i>DH</a>
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
                <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="<?php echo BASE_URL;?>assets/images/inteligencia.png"></i>Planejamento<i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#!">Dimensionamento</a></li>
                    <li><a href="#!">Atendimento de Demandas</a></li>
                  </ul>
                </div>
          </li>
          <li>
          <a class="collapsible-header"><i class="material icons"><img id="img" class="circle" src="<?php echo BASE_URL;?>assets/images/hospital.png"></i><i class="material icons small right"><i class="fas fa-angle-down"></i></i>Sesmt</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">Atestados</a></li>
              </ul>
            </div>
          </li>

        </ul>
</div>   


<div class="row center-align ">
    <div id="main2" class="col s12 blue">
      <?php
        $this->loadViewInTemplate($viewName,$viewData);
      ?>
    </div>
</div>

<div class="row" id="graficosxxx">
      <div class="col s12 m12 l4">
          <div class="card hoverables center-align z-depth-3">
            <div class="card-content">
              <span class="card-title">PMSP</span>
                <div>
                    <canvas id="grafico"></canvas>
                </div>
            </div>
            <div class="card-action">
              <a href="#">Relatório</a>
              <a href="#">Relatório</a>
            </div>
          </div>
     </div>
    <div class="col s12 m12 l4">
          <div class="card hoverables center-align z-depth-3">
            <div class="card-content">
              <span class="card-title">DEFENSORIA</span>
                <div>
                    <canvas id="grafico1"></canvas>
                </div>
            </div>
            <div class="card-action">
              <a href="#">Relatório</a>
              <a href="#">Relatório</a>
            </div>
         </div>
     </div>
     <div class="col s12 m12 l4">
          <div class="card hoverables center-align z-depth-3">
            <div class="card-content">
              <span class="card-title">CDHU</span>
                <div>
                    <canvas id="grafico2"></canvas>
                </div>
            </div>
            <div class="card-action">
              <a href="#">Relatório</a>
              <a href="#">Relatório</a>
            </div>
          </div>
     </div>
    </div>

         



    
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/brands.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/solid.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/fontA/js/fontawesome.js"></script>
<script src="<?php echo BASE_URL;?>assets/css/cssFramework/js/materialize.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/Chart.min.js"></script>


</body>
</html>

<script>
/* Definir a largura da barra lateral para 250px e a margem esquerda do conteúdo da página para 250px */

$(document).ready(function(){
 $('.collapsible').collapsible();
 $('.tap-target').tapTarget('open');
 
  /* inicia a sidenav */
   $(".button-collapse").sideNav({
    onOpen: function(){
     // document.getElementById("main").style.marginLeft = "300px";
     //document.getElementById("main").style.transition = "0.1s";
     // document.getElementById("main2").style.marginLeft = "300px";
     // document.getElementById("main2").style.transition = "0.1s";
    },
    onClose: function(){
     // document.getElementById("main").style.marginLeft = "18px";
     // document.getElementById("main").style.transition = "0.1s";
     // document.getElementById("main2").style.marginLeft = "auto";
     // document.getElementById("main2").style.transition = "0.1s";      
    }
   });

  })

// grafico pizza //
window.chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
    };
    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
          ],
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.green,
            window.chartColors.grey,
            window.chartColors.purple,
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Red',
          'Orange',
          'Green',
          'Grey',
          'Purple'
        ]
      },
      options: {
        responsive: true
      }
    };




// graficos linha //
      var contexto = document.getElementById("grafico1").getContext("2d");
      var grafico = new Chart(contexto, {
        type:'line',
        data: {
            labels: ['janeiro','fevereiro','março','abril','Maio'],
            datasets: [{ 
                label:'Vendas',
                backgroundColor:'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                data: [10,28,33,42,15], // faço um implode separando por , para ficar no padrão do data eu consigo misturar o php com javascrip de forma muito simples, bem mais que o asp, por exemplo sem necessidade de ficar criando ajax ?>],      
                fill: false
              },     { 
                  label: 'Custos',
                  backgroundColor: 'rgb(255, 99, 132)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: [
                   30,
                   5,
                   8,
                   10,
                   22
                  ],
                  fill: false
              }]
          },
      options: {
        responsive: true
      }
      });
    function createConfig(pointStyle) {
      return {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            label: 'My First dataset',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [10, 23, 5, 99, 67],
            fill: false,
            pointRadius: 10,
            pointHoverRadius: 15,
            showLine: false // no line shown
          }]
        },
        options: {
          responsive: true,
          title: {
            display: true,
            text: 'Point Style: ' + pointStyle
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              pointStyle: 'circle'
            }
          }
        }
      };
    }
    function carrega() {
      var container = document.querySelector('.container');
      [
        'circle',
        'triangle',
        'rect',
        'rectRounded',
        'rectRot',
        'cross',
        'crossRot',
        'star',
        'line',
        'dash'
      ].forEach(function(pointStyle) {
        
        var ctx1 = document.getElementById('grafico2').getContext('2d');
        var config = createConfig(pointStyle);
        new Chart(ctx1, config);
      });
    };
  
    window.onload = function() {
      var ctx = document.getElementById('grafico').getContext('2d');
      window.myPie = new Chart(ctx, config);
      var contexto = document.getElementById("grafico1").getContext("2d");
      carrega();
    };
























function openNav() {
  //document.getElementById("mySidebar").style.width = "250px";
  //document.getElementById("mySidebar").style.transition = "1s";
  document.getElementById("main").style.marginLeft = "300px";
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