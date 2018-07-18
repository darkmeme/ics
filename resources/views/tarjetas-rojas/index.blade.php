@extends('layouts.admin')
@section('contenido')

<div class="col-lg-4">
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
</div>

<div class="row">
<div class="col-xs-12">
  
   <div class="clearfix">
    <div class="tableTools-container">
      <div class="row">
      <div class="topnav">
  <a class="active link-crear" href="#">Crear Nueva Tarjeta Roja <i class="fa fa-plus"></i></a>
  
</div>    

      </div>
    </div>
  </div>


   <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-6 col-lg-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total: 
                                         <h2>{{$totalTarjetas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Emitidas: 
                                         <h2>{{$totalEmitidas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Reasignadas: 
                                         <h2>{{$totalReasignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Finalizadas: 
                                         <h2>{{$totalFinalizadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="panel panel-danger">
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

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#all">Todas las Tarjetas</a></li>
  <li><a data-toggle="tab" href="#mt">Mis tarjetas Creadas</a></li>
  <li><a data-toggle="tab" href="#ta">Mis tarjetas Asignadas</a></li>
</ul>

<div class="tab-content">
  <div id="all" class="tab-pane fade in active">
  <div class="table-header">
    Listado de todas las tarjetas rojas
  </div>
<div class="table-responsive">
@include('tarjetas-rojas.search')

      <table class="table text-center table-striped" id="table-tt">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Status</th>
          <th class="text-center">Opciones</th>
        </thead>


        @foreach ($tarjetasRojas as $tr)
        <tr id="filas" class="item{{$tr->id}}">
          <td>{{$tr->id}}</td>
          <td>{{$tr->area->nombre}}</td>
          <td>{{$tr->planta->nombre}}</td>
          <td>{{$tr->created_at}}</td>
          <td>{{$tr->user->name}}</td>
          <td>{{$tr->equipo->nombre}}</td>
          <td>{{$tr->prioridad}}</td>
          <td>{{$tr->descripcion_reporte}}</td>
          <td class="td-status"><span class="label label-sm label-warning">{{$tr->status}}</span></td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasRojasController@show',$tr->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>


              <button class="btn btn-link btnEdit" data-id="{{$tr->id}}" data-prioridad="{{$tr->prioridad}}" data-desc="{{$tr->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200" style="color: green;"></i>
              </button>

              <button class="btn btn-link btn-borrar" data-id="{{$tr->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200" style="color: red;"></i>
              </button>
              @can('borrar')
              @else
              @endcan

            </div>
          </td>
        </tr>

        @endforeach
      </table>
        </div>
  </div>

  <div id="mt" class="tab-pane fade">
  <div class="table-header">
    Listado de mis Tarjetas Rojas Creadas
  </div>
<div class="table-responsive">

       <table class="table text-center table-striped" id="table-tc">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>          
          <th class="text-center">Descripcion</th>         
          <th class="text-center">Estatus</th>
          <th class="text-center">Reasignada a:</th>
          <th class="text-center">Motivo Reasignacion:</th>
          <th class="text-center">Opciones</th>
        </thead>


        @foreach ($tarjetas as $t)
        <tr class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td>{{$t->prioridad}}</td>          
          <td>{{$t->descripcion_reporte}}</td>          
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>@if(isset($t->reasignado->name))
            {{$t->reasignado->name}} 
          @else Sin Reasignar                    
          @endif
          </td>
          <td>@if(isset($t->motivo_reasignado))
            {{$t->motivo_reasignado}} 
          @else N/A                    
          @endif
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasRojasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
              
              <button class="btn btn-link btnEdit" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200" style="color: green;"></i>
              </button>

              <button class="btn btn-link btn-borrar" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200" style="color: red;"></i>
              </button>
              @can('borrar')
              @else
              @endcan

            </div>
          </td>
        </tr>
        @endforeach
      </table>
        </div>
  </div>

  <div id="ta" class="tab-pane fade">
    
  <div class="table-header">
    Listado de mis Tarjetas Rojas Asignadas
  </div>
<div class="table-responsive">
             
       <table class="table text-center table-striped" id="table-ta">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>          
          <th class="text-center">Descripcion</th>         
          <th class="text-center">Estatus</th>
          <th class="text-center">Opciones </th>
        </thead>

        @foreach ($tarjetasAsig as $t)
        <tr class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td>{{$t->prioridad}}</td>
          <td>{{$t->descripcion_reporte}}</td>
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasRojasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>

             <button class="btn btn-link btnEdit" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200" style="color: green;"></i>
              </button>

              <button class="btn btn-link btn-borrar" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200" style="color: red;"></i>
              </button>
              @can('borrar')
              @else
              @endcan
             
            </div>
          </td>
        </tr>       
        @endforeach
      </table>
        </div>
    
  </div>
</div>

  
        @include('tarjetas-rojas.modal-editar')
        @include('tarjetas-rojas.modal-borrar')
       
        
</div>
</div>

@include('tarjetas-rojas.modal-create')

@endsection


@section('scripts')

@include('delEditScripts')

<script type="text/javascript">

operacionesDE('tarjetas-rojas/');

//llamado de la funcion para crear estilo de datatables en todas las pestañas
//de tarjetas rojas
//var tablaTt = $('#table-tt');
estiloTabla('#table-tt');

//var tablaTc = $('#table-tc');
estiloTabla('#table-tc');

//var tablaTa = $('#table-ta');
estiloTabla('#table-ta');

</script>

@endsection
