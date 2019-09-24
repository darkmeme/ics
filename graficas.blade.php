@extends('layouts.admin')
@section('contenido')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <div class="row">
    <h2 class="header smaller lighter blue"> &nbsp;&nbsp;&nbsp;&nbsp;Tarjetas Amarillas por Plantas</h2>
                 <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-6 col-lg-6">        
                            <canvas id="myChart" height="550" width="800"></canvas>
                            </div>
                          <div class="col-md-6 col-lg-6">
                            <canvas id="myCharts" height="550" width="800"></canvas>  
                        </div>
                    </div>
                 </div>
</div>
</br>
  <div class="row">
    <h2 class="header smaller lighter blue">&nbsp;&nbsp;&nbsp;&nbsp;Tarjetas Amarillas Finalizadas por Prioridad</h2>
        <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-8 col-lg-10">        
                            <canvas id="finprioridad" height="400" width="800"></canvas>
                            </div>
                            
                    </div>
        </div>
</div>
</br>
    <div class="row">
    <h2 class="header smaller lighter blue">&nbsp;&nbsp;&nbsp;&nbsp;Tarjetas Amarillas Pendientes por Prioridad</h2>
        <div class="col-sm-12">
                    <div class=row>
                        <div class="col-md-8 col-lg-10">        
                            <canvas id="penprioridad" height="400" width="800"></canvas>
                            </div>
                            
                    </div>
        </div>
</div>
  
                    
                    
<!-- Grafica de tarjetas amarillas finalizadas -->
                    
                <script>
                var nsd = {{$num_nsd}};
                var combi = {{$num_combi}};
                var sulfonacion = {{$num_sulfonacion}};
                var calderas = {{$num_calderas}};
                var oficinasadmin = {{$num_oficinasadmin}};
                var blanqueo = {{$num_blanqueo}};
                var ctx = document.getElementById('myChart');
                var myBarChart = new Chart(ctx, { 
                type: 'bar',
                borderAlign : 'inner',
                    data: {
                       labels: ['Combi','NSD','Sulfonación','Calderas','Oficinas Admin','Blanqueo'],
                        datasets: [{
                            label: 'Tarjetas Finalizadas',
                            data: [combi, nsd, sulfonacion,calderas,oficinasadmin,blanqueo],
                            backgroundColor: [
                                'rgba(0, 168, 255)',
                                'rgba(97, 171, 64)',
                                'rgba(241, 196, 15)',
                                'rgba(166, 172, 175)',
                                'rgba(142, 68, 173)',
                                'rgba(231, 76, 60)',
                            ],
                            borderColor: [
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                            title: {
                                display: true,
                                text: 'Tarjetas Finalizadas',
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


<!-- Grafica de tarjetas amarillas pendientes -->

                <script>
                var nsd = {{$pen_nsd}};
                var combi = {{$pen_combi}};
                var sulfonacion = {{$pen_sulfonacion}};
                var calderas = {{$pen_calderas}};
                var oficinasadmin = {{$pen_oficinasadmin}};
                var blanqueo = {{$pen_blanqueo}};
                var ctx = document.getElementById('myCharts');
                var myBarChart = new Chart(ctx, { 
                type: 'bar',
                borderAlign : 'inner',
                    data: {
                       labels: ['Combi','NSD','Sulfonación','Calderas','Oficinas Admin','Blanqueo'],
                        datasets: [{
                            label: 'Tarjetas Pendientes',
                            data: [combi, nsd, sulfonacion,calderas,oficinasadmin,blanqueo],
                            backgroundColor: [
                                'rgba(0, 168, 255)',
                      /*verde*/  'rgba(97, 171, 64)',
                     /*amarillo*/'rgba(241, 196, 15)',
                       /*naranja*/'rgba(166, 172, 175)',
                        /*morado*/'rgba(142, 68, 173)',
                        /*rojo*/'rgba(231, 76, 60)',
                            ],
                            borderColor: [
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)',
                                'rgba(227,224,225)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                            title: {
                                display: true,
                                text: 'Tarjetas Pendientes',
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


<!-- Grafica de tarjetas por prioridad general -->     
    <script>  var combi_prioA_final = {{$combi_prioA_final}};
              var nsd_prioA_final = {{$nsd_prioA_final}};
              var sulfonacion_prioA_final = {{$sulfonacion_prioA_final}};
              var calderas_prioA_final = {{$calderas_prioA_final}};
              var oficinasadmin_prioA_final = {{$oficinasadmin_prioA_final}};
              var blanqueo_prioA_final = {{$blanqueo_prioA_final}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [combi_prioA_final, nsd_prioA_final, sulfonacion_prioA_final, calderas_prioA_final, oficinasadmin_prioA_final, blanqueo_prioA_final],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var combi_prioB_final = {{$combi_prioB_final}};
            var nsd_prioB_final = {{$nsd_prioB_final}};
            var sulfonacion_prioB_final = {{$sulfonacion_prioB_final}};
            var calderas_prioB_final = {{$calderas_prioB_final}};
            var oficinasadmin_prioB_final = {{$oficinasadmin_prioB_final}};
            var blanqueo_prioB_final = {{$blanqueo_prioB_final}}; 
            var PrioridadB = {
              label: 'Prioridad B',
              data: [combi_prioB_final, nsd_prioB_final, sulfonacion_prioB_final ,calderas_prioB_final, oficinasadmin_prioB_final, blanqueo_prioB_final],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };

            var combi_prioC_final = {{$combi_prioC_final}};
            var nsd_prioC_final = {{$nsd_prioC_final}};
            var sulfonacion_prioC_final = {{$sulfonacion_prioC_final}};
            var calderas_prioC_final = {{$calderas_prioC_final}};
            var oficinasadmin_prioC_final = {{$oficinasadmin_prioC_final}};
            var blanqueo_prioC_final = {{$blanqueo_prioC_final}}; 
            var PrioridadC = {
              label: 'Prioridad C',
              data: [combi_prioC_final, nsd_prioC_final, sulfonacion_prioC_final, calderas_prioC_final, oficinasadmin_prioC_final, blanqueo_prioC_final],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var planetData = {
              labels: ["Combi", "NSD", "Sulfonación", "Calderas", "oficinas Admin", "Blanqueo"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
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
             
            var barChart = new Chart(finprioridad, {
              type: 'bar',
              data: planetData,
              options: chartOptions
            });
    </script>


<!-- Grafica de tarjetas por prioridad general -->     
    <script>  
              var combi_prioA_pen = {{$combi_prioA_pen}};
              var nsd_prioA_pen = {{$nsd_prioA_pen}};
              var sulfonacion_prioA_pen = {{$sulfonacion_prioA_pen}};
              var calderas_prioA_pen = {{$calderas_prioA_pen}};
              var oficinasadmin_prioA_pen = {{$oficinasadmin_prioA_pen}};
              var blanqueo_prioA_pen = {{$blanqueo_prioA_pen}};
              var PrioridadA = {
              label: 'Prioridad A',
              data: [combi_prioA_pen, nsd_prioA_pen, sulfonacion_prioA_pen, calderas_prioA_pen, oficinasadmin_prioA_pen, blanqueo_prioA_pen],
              backgroundColor: 'rgba(231, 76, 60)',
              borderColor: 'rgba(169, 50, 38)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var combi_prioB_pen = {{$combi_prioB_pen}};
            var nsd_prioB_pen = {{$nsd_prioB_pen}};
            var sulfonacion_prioB_pen = {{$sulfonacion_prioB_pen}};
            var calderas_prioB_pen = {{$calderas_prioB_pen}};
            var oficinasadmin_prioB_pen = {{$oficinasadmin_prioB_pen}};
            var blanqueo_prioB_pen = {{$blanqueo_prioB_pen}}; 
            var PrioridadB = {
              label: 'Prioridad B',
              data: [combi_prioB_pen, nsd_prioB_pen, sulfonacion_prioB_pen ,calderas_prioB_pen, oficinasadmin_prioB_pen, blanqueo_prioB_pen],
              backgroundColor: 'rgba(241, 196, 15)',
              borderColor: 'rgba(212, 172, 13)',
              borderWidth: 1,
              yAxisID: "altura"
            };

            var combi_prioC_pen = {{$combi_prioC_pen}};
            var nsd_prioC_pen = {{$nsd_prioC_pen}};
            var sulfonacion_prioC_pen = {{$sulfonacion_prioC_pen}};
            var calderas_prioC_pen = {{$calderas_prioC_pen}};
            var oficinasadmin_prioC_pen = {{$oficinasadmin_prioC_pen}};
            var blanqueo_prioC_pen = {{$blanqueo_prioC_pen}}; 
            var PrioridadC = {
              label: 'Prioridad C',
              data: [combi_prioC_pen, nsd_prioC_pen, sulfonacion_prioC_pen, calderas_prioC_pen, oficinasadmin_prioC_pen, blanqueo_prioC_pen],
              backgroundColor: 'rgba(82, 190, 128)',
              borderColor: 'rgba(34, 153, 84)',
              borderWidth: 1,
              yAxisID: "altura"
            };
             
            var pendientes = {
              labels: ["Combi", "NSD", "Sulfonación", "Calderas", "oficinas Admin", "Blanqueo"],
              datasets: [PrioridadA, PrioridadB, PrioridadC]
            };
             
            var chartOptions = {
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
             
            var barChart = new Chart(penprioridad, {
              type: 'bar',
              data: pendientes,
              options: chartOptions
            });
    </script>

@endsection


       
