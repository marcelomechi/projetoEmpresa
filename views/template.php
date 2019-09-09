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
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/datatables.min.css">
      <!-- Corrige o erro 500 -->
    <link rel="icon" href="data:,">
</head>
<body>
<nav>
    <div class="row">
      <div class="nav-wrapper indigo col s12 m12 l12">

        <div id="main" data-target="sidebar" class="sidenav-trigger"><i class="material-icons white-text"><i class="fas fa-bars"></i></i></div>
          <ul class="right">                   
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

        </ul>
</div>   


<div class="row">
     <div class="col s12 m6 l2">
         
       <div class="valign-wrapper item-linha-1">
           <div class="input-field w100">
                      <select multiple>
                        <option value="999">Todos</option>
                        <option value="1">Brasília</option>
                        <option value="2">São Paulo</option>
                      </select>
                    <label>Selecione a Filial</label>
                </div>
       </div>

          
    </div>
    <div class="col s12 m6 l4">
            <div class="valign-wrapper item-linha-1">
           <div class="input-field w100">
                      <select multiple>
                        <option value="999">Todos</option>
                        <option value="1">PMSP</option>
                        <option value="2">MEC</option>
                      </select>
                    <label>Selecione o Contrato</label>
                </div>
       </div>
    </div>


    <div class="col s6 m6 l3">
       <div class="valign-wrapper item-linha-1">
           <div class="input-field w100">
                      <select multiple>
                        <option value="999">Todos</option>
                        <option value="1">Domingo</option>
                        <option value="2">Segunda-Feira</option>
                        <option value="2">Terça-Feira</option>
                        <option value="2">Quarta-Feira</option>
                        <option value="2">Quinta-Feira</option>
                        <option value="2">Sexta-Feira</option>
                        <option value="2">Sábado</option>
                      </select>
                    <label>Dia da Semana</label>
                </div>
       </div>
  </div>


  <div class="col s6 m6 l3">
       <div class="valign-wrapper item-linha-1">
           <div class="input-field w100">
                      <select multiple>
                        <option value="999">Todos</option>
                        <option value="1">1º Semana de Setembro</option>
                        <option value="2">2º Semana de Setembro</option>
                        <option value="2">3º Semana de Setembro</option>
                        <option value="2">4º Semana de Setembro</option>
                        <option value="2">5º Semana de Setembro</option>
                      </select>
                    <label>Semana Mês</label>
                </div>
       </div>
  </div>



</div>
<div class="row">    

   <div class="col s12 m4 l2 item-linha-1">
             <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="2"class="center-align cyan">TML</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">TML</th>
              <th class="center-align cyan lighten-5">META</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">05:58:57</td>
              <td class="center-align">05:00:00</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col s12 m4 l2 item-linha-1">
        <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="2" class="center-align cyan">TMA</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">TMA</th>
              <th class="center-align cyan lighten-5">META</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">00:02:57</td>
              <td class="center-align">00:02:12</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col s12 m4 l3 item-linha-1">
        <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="2" class="center-align cyan">ABSENTEÍSMO</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">ABSENTEÍSMO</th>
              <th class="center-align cyan lighten-5">META</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">03,25%:</td>
              <td class="center-align">03,00%</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col s12 m6 l2 item-linha-1">
        <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="2" class="center-align cyan">NR-17 + WC</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">NR-17 + WC</th>
              <th class="center-align cyan lighten-5">META</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">03,25%:</td>
              <td class="center-align">03,00%</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col s12 m6 l3 item-linha-1">
        <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="2" class="center-align cyan">HORA EXTRA</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">REALIZADO</th>
              <th class="center-align cyan lighten-5">PREVISTO</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">1258:53:15</td>
              <td class="center-align">1000:00:00</td>
            </tr>
          </tbody>
      </table>
    </div>
</div>

   


<div class="row">
  <div class="col s12 m6 l6">
  <div class="valign-wrapper item-linha-1">
  <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="3" class="center-align cyan">FATURAMENTO</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">VALOR PROJETADO</th>
              <th class="center-align cyan lighten-5">VALOR FATURADO</th>
              <th class="center-align cyan lighten-5">DESVIO</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">R$ 200.000.000,00 </td>
              <td class="center-align">R$ 180.000.000,00</td>
              <td class="center-align">R$ 20.000.000,00</td>
            </tr>
          </tbody>
      </table>
  </div>
  </div>

  <div class="col s12 m6 l6">
  <div class="valign-wrapper item-linha-1">
  <table class="striped hoverable">
        <thead>
          <tr>
              <th colspan="3" class="center-align cyan">LIGAÇÕES</th>
          </tr>
          <tr>
              <th class="center-align cyan lighten-5">ENTRANTES</th>
              <th class="center-align cyan lighten-5">ATENDIDAS</th>
              <th class="center-align cyan lighten-5">ABANDONADAS</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td class="center-align">50.000</td>
              <td class="center-align">48.000</td>
              <td class="center-align">2.000</td>
            </tr>
          </tbody>
      </table>
  </div>
  </div>

</div>



<div class="row">
  <div class="col s12 m12 l7"> 
      <div class="valign-wrapper item-linha-2">
        <canvas class="item-linha-2" id="faturamento"></canvas>
      </div>
  </div>
  <div class="col s12 m12 l5 item">
    <div class="valign-wrapper item-linha-2">
      <canvas id="entrantesAbandonadas"></canvas>
    </div>
  </div>
</div>





<div class="row">
  <div class="col s12 m12 l7">
    <div class="valign-wrapper item-linha-2">
      <canvas class="item-linha-2" id="tml"></canvas>
    </div>
  </div>


  <div class="col s12 m12 l5">
    <div class="valign-wrapper item-linha-2">

      <table id="example" class="mdl-data-table">
        <thead>
            <tr>
                <th class="center-align cyan" colspan="3">HORA EXTRA</th>
            </tr>
            <tr>
                <th class="center-align cyan lighten-5">Contrato</th>
                <th class="center-align cyan lighten-5">Total</th>
                <th class="center-align cyan lighten-5">Representatividade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center-align">PMSP</td>
                <td class="center-align">308:53:00</td>
                <td class="center-align">19,26%</td>
            </tr>
            <tr>
                <td class="center-align">MEC</td>
                <td class="center-align">300:11:00</td>
                <td class="center-align">31,18%</td>
            </tr>
            <tr>
                <td class="center-align">MTE</td>
                <td class="center-align">200:11:00</td>
                <td class="center-align">16,25%</td>
            </tr>
            <tr>
                <td class="center-align">SOCICAM</td>
                <td class="center-align">45:11:00</td>
                <td class="center-align">28,15%</td>
            </tr>
            <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
                        <tr>
                <td class="center-align">DEFENSORIA</td>
                <td class="center-align">150:47:33</td>
                <td class="center-align">46,25%</td>
            </tr>
           
        </tbody>
        <tfoot>
            <tr>
                <th class="center-align">Contrato</th>
                <th class="center-align">Total</th>
                <th class="center-align">Representatividade</th>
            </tr>
        </tfoot>
    </table>

    </div>

  </div>


  <div class="row">
  <div class="col s12 m12 l12 item-linha-2">
    <div class="valign-wrapper item-linha-2">
      <canvas class="item-linha-2" id="abs"></canvas>
    </div>
  </div>
    <div class="row">
  <div class="col s12 m12 l6 item-linha-2">
    <div class="valign-wrapper item-linha-2">
      <canvas class="item-linha-2" id="tma"></canvas>
    </div>
  </div>
    <div class="row">
  <div class="col s12 m12 l6 item-linha-2">
    <div class="valign-wrapper item-linha-2">
      <canvas class="item-linha-2" id="pausas"></canvas>
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
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/datatables.min.js"></script>


</body>
</html>

<script>
/* Definir a largura da barra lateral para 250px e a margem esquerda do conteúdo da página para 250px */

$(document).ready(function(){
 $('.collapsible').collapsible();
 $('.tap-target').tapTarget('open');
 $('select').formSelect();
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


   $('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
    } );

  })





  var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

// grafico barra //

window.chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)',
      indigo: 'rgb(75, 0, 130)',
      indianred: 'rgb(205,92,92)',
      MediumSlateBlue: 'rgb(123,104,238)',
      teal: 'rgb(0,128,128)',
      blue2: 'rgb(33,150,243)'
    };


    var Contratos = ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'];
    var color = Chart.helpers.color;
    var barChartData = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        label: 'Previsto',
        backgroundColor: color(window.chartColors.blue2).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue2,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }, {
        label: 'Faturado',
        backgroundColor: color(window.chartColors.teal).alpha(0.5).rgbString(),
        borderColor: window.chartColors.teal,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }]
    };

   
    


// grafico pizza //


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
            randomScalingFactor()
          ],
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.orange,
            window.chartColors.yellow
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Entrantes',
          'Atendidas',
          'Abandonadas'
        ]
      },
      options: {
        responsive: true
      }
    };


//


  
    var barChartData33 = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        label: 'TML',
        backgroundColor: window.chartColors.red,
        data: [
          randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }, {
        label: 'TML-META',
        backgroundColor: window.chartColors.blue,
        data: [
          randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }]

    };




//


    var chartData = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        type: 'line',
        label: 'ABS-META',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [
          randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }, {
        type: 'bar',
        label: 'ABS',
        backgroundColor: window.chartColors.red,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ],
        borderColor: 'white',
        borderWidth: 2
      }]

    };


    var chartData2 = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        type: 'line',
        label: 'TMA-META',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [
          randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
      }, {
        type: 'bar',
        label: 'TMA',
        backgroundColor: window.chartColors.red,
        data: [
          randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ],
        borderColor: 'white',
        borderWidth: 2
      }]

    };





    var config5 = {
      type: 'line',
      data: {
        labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
        datasets: [{
          label: 'NR-17 + WC',
          backgroundColor: window.chartColors.blue,
          borderColor: window.chartColors.blue,
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
          ],
          fill: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
          display: true,
          text: 'NR-17 + WC'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
         scales: {
            xAxes: [{
              stacked: true,
              gridLines: {
                display: false,
              },
              ticks: {
                    autoSkip: false, // ASSIM NÃO OCULTA AUTOMATICO DEVIDO AO TAMANHO DO CANVAS
                    maxRotation: 90, // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                    minRotation: 90 // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              },
              stacked: true
            }]
          }
      }
    };

    function carregaUltimoGrafico() {
      var ctx = document.getElementById('pausas').getContext('2d');
      window.myLine = new Chart(ctx, config5);
    };






















     function carragaOutroGrafico3(){
      var ctx = document.getElementById('tma').getContext('2d');
      window.myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: chartData2,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            xAxes: [{
              stacked: true,
              gridLines: {
                display: false,
              },
              ticks: {
                    autoSkip: false, // ASSIM NÃO OCULTA AUTOMATICO DEVIDO AO TAMANHO DO CANVAS
                    maxRotation: 90, // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                    minRotation: 90 // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                }
            }],
            yAxes: [{
              stacked: true,
              gridLines: {
                display: false,
              },
            }]
          },
          title: {
            display: true,
            text: 'TMA'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          }
        }
      });
    }



    function carragaOutroGrafico(){
      var ctx = document.getElementById('abs').getContext('2d');
      window.myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
              },
              stacked: true,
              ticks: {
                    autoSkip: false, // ASSIM NÃO OCULTA AUTOMATICO DEVIDO AO TAMANHO DO CANVAS
                    maxRotation: 90, // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                    minRotation: 90 // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              },
              stacked: true
            }]
          },
          title: {
            display: true,
            text: 'Absenteísmo'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          }
        }
      });
    }























    function grafico5(){


      var ctx = document.getElementById('tml').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData33,
        options: {
          title: {
            display: true,
            text: 'TML'
          },
          tooltips: {
            mode: 'index',
            intersect: false
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            xAxes: [{
              gridLines: {
                display: false,
              },
              stacked: true,
              ticks: {
                    autoSkip: false, // ASSIM NÃO OCULTA AUTOMATICO DEVIDO AO TAMANHO DO CANVAS
                    maxRotation: 90, // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                    minRotation: 90 // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              },
              stacked: true
            }]
          }
        }
      });

    }
  






















    function carregaEssaPorra() {
      var ctx2 = document.getElementById('entrantesAbandonadas').getContext('2d');
      window.myPie = new Chart(ctx2, config);
    };













    
  

    

    function grafico3(){
      var ctx = document.getElementById('faturamento').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          maintainAspectRatio: false,
        scales: {
            xAxes: [{
              gridLines: {
                display: false,
              },
              
                ticks: {
                    autoSkip: false, // ASSIM NÃO OCULTA AUTOMATICO DEVIDO AO TAMANHO DO CANVAS
                    maxRotation: 90, // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                    minRotation: 90 // FAZ A ROTAÇÃO PARA FICAR NA VERTICAL
                }
            }],
            yAxes: [{
              gridLines: {
                display: false,
              }
            }]
        }
    }
      });
    }


  
    window.onload = function() {
     // var ctx = document.getElementById('grafico').getContext('2d');
     // window.myPie = new Chart(ctx, config);
     // var contexto = document.getElementById("grafico1").getContext("2d");
     // carrega();
     grafico3();
      carregaEssaPorra();
     grafico5()
     carragaOutroGrafico()
     carragaOutroGrafico3()
     carregaUltimoGrafico()

    };










	</script>