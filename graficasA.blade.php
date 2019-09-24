@extends('layouts.admin')
@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="row">
    <h2 class="header smaller lighter blue">Tarjetas Amarillas por Áreas</h2>
        <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-6 col-lg-6">        
                            <canvas id="myChartnsd" height="550" width="800"></canvas>
                            </div>
                          <div class="col-md-6 col-lg-6">
                            <canvas id="myChartcombi" height="550" width="800"></canvas>  
                        </div>
                    </div>
                 </div>
  </div>  
</br>
</br>
 <div class="row">
    <h2 class="header smaller lighter blue">Tarjetas Amarillas por Áreas</h2>
        <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-6 col-lg-6">        
                            <canvas id="myChartempaque" height="550" width="800"></canvas>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <canvas id="myCharsecado1" height="550" width="800"></canvas>  
                        </div>
                          
                    </div>
                 </div>
  </div>
  </br>
  </br>
 <div class="row">
        <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-6 col-lg-6">        
                            <canvas id="myCharsecado2" height="550" width="800"></canvas>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <canvas id="myCharsecado3" height="550" width="800"></canvas>  
                        </div>
                          
                    </div>
                 </div>
  </div>





  

  <!-- Grafica de tarjetas amarillas en nsd -->
     
                <script>
                    var final = {{$num_nsd}};
                    var pendien = {{$pen_nsd}};
                    
                    var ctx = document.getElementById('myChartnsd');
                    var myBarChart = new Chart(ctx, { 
                    type: 'bar',
                        data: {
                            labels: ['Finalizadas', 'Pendientes'],
                            datasets: [{
                                label: 'Tarjetas Amarillas de NSD',
                               
                                
                                data: [final,pendien],
                                backgroundColor: [
               
                      /*verde*/  'rgba(97, 171, 64)',
                 
                        /*rojo*/'rgba(231, 76, 60)',
                        
                                ],
                                borderColor: [
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                               
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Tarjetas Amarillas de NSD',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
                                    legend: {
                                                display: true,
                                                labels: {
                                                fontColor: 'rgb(148, 144, 141)'
                                                     }}
                                                }
                                        });
                </script>

  <!-- Grafica de tarjetas amarillas en combi -->
     
                    <script>
                    var final = {{$num_combi}};
                    var pendien = {{$pen_combi}};
                    
                    var ctx = document.getElementById('myChartcombi');
                    var myBarChart = new Chart(ctx, { 
                    type: 'bar',
                        data: {
                            labels: ['Finalizadas', 'Pendientes'],
                            datasets: [{
                                label: 'Tarjetas Amarillas de Combi',
                               
                                
                                data: [final,pendien],
                                backgroundColor: [
               
                      /*verde*/  'rgba(97, 171, 64)',
                 
                        /*rojo*/'rgba(231, 76, 60)',
                        
                                ],
                                borderColor: [
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                               
                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'Tarjetas Amarillas de Combi',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
                                    legend: {
                                                display: true,
                                                labels: {
                                                fontColor: 'rgb(148, 144, 141)'
                                                     }}
                                                }
                                        });
                         </script>

  <!-- Grafica de tarjetas amarillas empaque -->
  		 <script>  
  		 	  var empaqueAF = {{$empaqueAF}};
              var empaqueAP = {{$empaqueAP}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [empaqueAF,empaqueAP],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var empaqueBF = {{$empaqueBF}};
            var empaqueBP = {{$empaqueBP}};            
            var PrioridadB = {
              label: 'Prioridad B',
              data: [empaqueBF,empaqueBF],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };


            var empaqueCF = {{$empaqueCF}};
            var empaqueCP = {{$empaqueCP}};
            var PrioridadC = {
              label: 'Prioridad C',
              data: [empaqueCF,empaqueCP],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var planetData = {
              labels: ["Finalizadas", "Pendientes"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
            	title: {
                                display: true,
                                text: 'Área de Empaque',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
              scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{id: "altura"}, 
                        {id: "altura"},
                        {id: "altura"}]
              }
            };
             
            var barChart = new Chart(myChartempaque, {
              type: 'bar',
              data: planetData,
              options: chartOptions
            });
     	  </script>

  <!-- Grafica de tarjetas amarillas secado1 -->
  		 <script>  
  		 	  var secado1AF = {{$secado1AF}};
              var secado1AP = {{$secado1AP}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [secado1AF,secado1AP],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var secado1BF = {{$secado1BF}};
            var secado1BP = {{$secado1BP}};            
            var PrioridadB = {
              label: 'Prioridad B',
              data: [secado1BF,secado1BF],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };


            var secado1CF = {{$secado1CF}};
            var secado1CP = {{$secado1CP}};
            var PrioridadC = {
              label: 'Prioridad C',
              data: [secado1CF,secado1CP],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var planetData = {
              labels: ["Finalizadas", "Pendientes"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
            	title: {
                                display: true,
                                text: 'Área de Secado 1',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
              scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{id: "altura"}, 
                        {id: "altura"},
                        {id: "altura"}]
              }
            };
             
            var barChart = new Chart(myCharsecado1, {
              type: 'bar',
              data: planetData,
              options: chartOptions
            });
      	 </script>

  <!-- Grafica de tarjetas amarillas secado2 -->
  		 <script>  
  		 	  var secado2AF = {{$secado2AF}};
              var secado2AP = {{$secado2AP}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [secado2AF,secado2AP],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var secado2BF = {{$secado2BF}};
            var secado2BP = {{$secado2BP}};            
            var PrioridadB = {
              label: 'Prioridad B',
              data: [secado2BF,secado2BF],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };


            var secado2CF = {{$secado2CF}};
            var secado2CP = {{$secado2CP}};
            var PrioridadC = {
              label: 'Prioridad C',
              data: [secado2CF,secado2CP],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var planetData = {
              labels: ["Finalizadas", "Pendientes"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
            	title: {
                                display: true,
                                text: 'Área de Secado 2',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
              scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{id: "altura"}, 
                        {id: "altura"},
                        {id: "altura"}]
              }
            };
             
            var barChart = new Chart(myCharsecado2, {
              type: 'bar',
              data: planetData,
              options: chartOptions
            });
      	 </script>

  <!-- Grafica de tarjetas amarillas saponificacion con variables de distinto nombre -->
  		 <script>  
  		 	  var secado3AF = {{$secado3AF}};
              var secado3AP = {{$secado3AP}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [secado3AF,secado3AP],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var secado3BF = {{$secado3BF}};
            var secado3BP = {{$secado3BP}};            
            var PrioridadB = {
              label: 'Prioridad B',
              data: [secado3BF,secado3BF],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };


            var secado3CF = {{$secado3CF}};
            var secado3CP = {{$secado3CP}};
            var PrioridadC = {
              label: 'Prioridad C',
              data: [secado3CF,secado3CP],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var planetData = {
              labels: ["Finalizadas", "Pendientes"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
            	title: {
                                display: true,
                                text: 'Área de Saponificacin',
                                fontSize: 22,
                                titleFontStyle: 'bold',
                                bodyFontFamily: 'Helvetica',
                                    },
              scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{id: "altura"}, 
                        {id: "altura"},
                        {id: "altura"}]
              }
            };
             
            var barChart = new Chart(myCharsecado3, {
              type: 'bar',
              data: planetData,
              options: chartOptions
            });
          </script>


@endsection
