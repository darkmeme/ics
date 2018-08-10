@extends('layouts.admin')
@section('contenido')
  <br>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#ta">Tarjetas Amarillas</a></li>
  <li><a data-toggle="tab" href="#tr">Tarjetas Rojas</a></li>  
</ul>

<div class="tab-content">
  <div id="ta" class="tab-pane fade in active">
   
  <div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div> 

  <div class="table-header">
    Listado de Tarjetas Amarillas en la Planta: <b>{{$nombre}}</b>
  </div>

<div class="row">
         <div class="col-lg-1 col-md-2">
         <a href="javascript:history.back()"><button class="btn btn-info" type="button">Regresar<i class="fa fa-arrow-circle-o-left"></i></button></a>
         </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Tarjetas: 
                                         <h2>{{$totalTarjetas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Emitidas: 
                                         <h2>{{$TarjetasAsignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Reasignadas: 
                                         <h2>{{$TarjetasReasignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Finalizadas: 
                                         <h2>{{$TarjetasFinalizadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Pendientes: 
                                         <h2>{{$pendientes}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                
            </div>

<div class="table-responsive">

      <table class="table table-bordered text-center table-striped table-hover" id="table-ta">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>                    
          <th class="text-center">Descripcion</th>
          <th class="text-center">Estatus</th>
          <th class="text-center" WIDTH="100">Opciones </th>
        </thead>

        @foreach ($tarjetasP as $t)
        <tr>
          <td>{{$t->id}}</td>         
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>          
          <td>{{$t->descripcion_reporte}}</td>
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
            </div>
          </td>
        </tr>

        @endforeach
      </table>
        </div>
</div>
</div>
   
  </div>
  <div id="tr" class="tab-pane fade">
    
  <div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div> 

  <div class="table-header">
    Listado de Tarjetas Rojas en la Planta: <b>{{$nombre}}</b>
  </div>

<div class="row">
         <div class="col-lg-1 col-md-2">
         <a href="javascript:history.back()"><button class="btn btn-info" type="button">Regresar<i class="fa fa-arrow-circle-o-left"></i></button></a>
         </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Tarjetas: 
                                         <h2>{{$totalRojas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Emitidas: 
                                         <h2>{{$rojasAsignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Reasignadas: 
                                         <h2>{{$rojasReasignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Finalizadas: 
                                         <h2>{{$rojasFinalizadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Pendientes: 
                                         <h2>{{$penRojas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                
            </div>

<div class="table-responsive">

      <table class="table table-bordered text-center table-striped table-hover" id="table-tr">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>                    
          <th class="text-center">Descripcion</th>
          <th class="text-center">Estatus</th>
          <th class="text-center" WIDTH="100">Opciones </th>
        </thead>

        @foreach ($tarjetasR as $t)
        <tr>
          <td>{{$t->id}}</td>         
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>          
          <td>{{$t->descripcion_reporte}}</td>
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasRojasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
            </div>
          </td>
        </tr>

        @endforeach
      </table>
        </div>
</div>
</div>
    
  </div>

</div>


@endsection

@section('scripts')
@include('ScriptDataTable')

<script type="text/javascript">

estiloTabla('#table-ta');
estiloTabla('#table-tr');

</script>
@endsection
