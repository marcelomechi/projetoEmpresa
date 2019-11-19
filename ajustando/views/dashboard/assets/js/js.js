$('#example').DataTable( {
        columnDefs: [
            {
                targets: [ 0, 1, 2 ]
                
            }
        ],
        "order": [[ 0, "asc" ]]
    } );

    $('select').formSelect();







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
      teal: 'rgb(0,128,128)',
      steelBlue: 'rgb(70,130,180)',
      DodgerBlue: 'rgb(30,144,255)',
      MediumSlateBlue: 'rgb(123,104,238)',
      yellow2: 'rgb(238,238,0)',
      cyan: 'rgb(0,255,255)',
      SkyBlue: 'rgb(135,206,235)',
      RoyalBlue: 'rgb(65,105,225)',
      FireBrick: 'rgb(178,34,34)',
      Crimson: 'rgb(220,20,60)',
      DarkOrange: 'rgb(255,140,0)',
      Khaki: 'rgb(240,230,140)',
      PaleTurquoise: 'rgb(175,238,238)',
      MediumSeaGreen: 'rgb(60,179,113)',
      MediumPurple: 'rgb(147,112,219)',
      Lavender: 'rgb(230,230,250)',
      tealAccent4: 'rgb(0,191,165)',
      purpleLighten4: 'rgb(225,190,231)',
      pinkAccent2: 'rgb(255,64,129)',
      DarkSlateGray4: 'rgb(82,139,139)',
      CadetBlue3: 'rgb(122,197,205)'

      
    };


    var Contratos = ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'];
    var color = Chart.helpers.color;
    var barChartData = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        label: 'Previsto',
        backgroundColor: color(window.chartColors.DodgerBlue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.DodgerBlue,
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
            window.chartColors.teal,
            window.chartColors.Khaki,
            window.chartColors.steelBlue
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
        responsive: true,
        maintainAspectRatio: false
      }
    };


//


  
    var barChartData33 = {
      labels: ['MTE','MEC','PMSP','SEPM','MDH','DETRAN','AMAZONAS ENERGIA','EMBASA','DEFENSORIA','CDHU','SPPREV','PMBV SMEC','CEA','SEE / CIMA','GRUPO SANTA','RORAIMA ENERGIA','BAHIAGAS','ARSESP','DMAE','SMAG','CASAL','SOCICAM','CEUMA'],
      datasets: [{
        label: 'TML',
        backgroundColor: window.chartColors.tealAccent4,
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
        label: 'TML-Meta',
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
        label: 'ABS-Meta',
        backgroundColor: window.chartColors.MediumSlateBlue,
        borderColor: window.chartColors.MediumSlateBlue,
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
        label: 'Absenteísmo',
        backgroundColor: window.chartColors.CadetBlue3,
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
        label: 'TMA-Meta',
        borderColor: window.chartColors.pinkAccent2,
        backgroundColor: window.chartColors.pinkAccent2,
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
        backgroundColor: window.chartColors.RoyalBlue,
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
          backgroundColor: window.chartColors.DarkOrange,
          borderColor: window.chartColors.DarkOrange,
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

    function graficoPausas() {
      var ctx = document.getElementById('pausas').getContext('2d');
      window.myLine = new Chart(ctx, config5);
    };






















     function graficoTMA(){
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



    function carregaGraficoABS(){
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
            text: 'ABSENTEÍSMO'
          },
          tooltips: {
            mode: 'index',
            intersect: true
          }
        }
      });
    }























    function graficoTML(){


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
  






















    function graficoEntrantesAbandonadas() {
      var ctx2 = document.getElementById('entrantesAbandonadas').getContext('2d');
      window.myPie = new Chart(ctx2, config);
    };













    
  

    

    function graficoFaturamento(){
      var ctx = document.getElementById('faturamento').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          title: {
            display: true,
            text: 'FATURAMENTO'
          },
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
     graficoFaturamento();
     graficoEntrantesAbandonadas();
     graficoTML();
     carregaGraficoABS();
     graficoTMA();
     graficoPausas();

    };