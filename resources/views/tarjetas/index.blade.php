@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="tableTools-container">
      <div class="row">
      <div class="topnav">
  <a class="active link-crear" href="#">Crear Nueva Tarjeta Amarilla <i class="fa fa-plus"></i></a>
  
</div>   
      </div>
    </div>
  </div>

  <div class="row">
                <div class="col-lg-2 col-md-3 col-lg-offset-1">
                    <div class="panel panel-warning">
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
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-warning">
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
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-warning">
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
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-warning">
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
                <div class="col-lg-2 col-md-3">
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

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#todas">Todas las Tarjetas</a></li>
  <li><a data-toggle="tab" href="#creadas">Mis tarjetas Creadas</a></li>
  <li><a data-toggle="tab" href="#asignadas">Mis Tarjetas Asignadas</a></li>
</ul>

<div class="tab-content">
  <div id="todas" class="tab-pane fade in active">

  <div class="table-header">
    Listado de todas las tarjetas Amarillas
  </div>
<div class="table-responsive">
  @include('tarjetas.filtro-fecha')

      <table class="table text-center table-striped" id="table-tarjetas">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Categoria</th>
          @if($filtro=='fina')
          <th class="text-center">Fecha Cierre</th>
          @else
          <th class="text-center">Fecha</th>
          @endif
          <th class="text-center">Prioridad</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Estado</th>
          <th class="text-center" WIDTH="122">Opciones</th>
        </thead>

        @foreach ($tarjetas as $t)
        <tr id="filas" class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td>{{$t->categoria->nombre}}</td>
          @if($filtro=='fina')
          <td>{{date('d-m-Y', strtotime($t->fecha_cierre))}} </td>              
          @else 
          <td>{{$t->created_at->format('d-m-Y')}}</td>                
          @endif
                    
          <td class="pri">{{$t->prioridad}}</td>
          <td class="des">{{$t->descripcion_reporte}}</td>
          <td>{{$t->user->name}}</td>
          <td class="td-status"><span class="label label-sm label-warning">{{$t->status}}</span></td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
              <a class="green btnEdit" href="#" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red btn-borrar" href="#" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr> 
        @endforeach
       
      </table>
        </div>

  </div>
  <div id="creadas" class="tab-pane fade">
    
  <div class="table-header">
    Listado de mis Tarjetas Amarillas Creadas
  </div>
<div class="table-responsive">
                  
      <table class="table text-center table-striped" id="table-creadas">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Categoria</th>          
          <th class="text-center">Estatus</th>
          <th class="text-center">Reasignada a:</th>
          <th class="text-center">Motivo Reasignacion:</th>
          <th class="text-center" WIDTH="122">Opciones</th>
        </thead>


        @foreach ($tarjetasC as $t)
        <tr class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td class="pri">{{$t->prioridad}}</td>
          <td class="des">{{$t->descripcion_reporte}}</td>
          <td>{{$t->categoria->nombre}}</td>
          
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
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
              <a class="green btnEdit" href="#" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red btn-borrar" href="#" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan

            </div>
          </td>
        </tr>
        @endforeach
        
      </table>
        </div>
    
  </div>
  <div id="asignadas" class="tab-pane fade">
    
  <div class="table-header">
    Listado de mis Tarjetas Amarillas Asignadas
  </div>
<div class="table-responsive">

      <table class="table text-center table-striped" id="table-asignadas">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Categoria</th>          
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
          <td class="pri">{{$t->prioridad}}</td>
          <td class="des">{{$t->descripcion_reporte}}</td>
          <td>{{$t->categoria->nombre}}</td>
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>

              <a class="green btnEdit" href="#" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red btn-borrar" href="#" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
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
@include('tarjetas.modal-editar')
@include('tarjetas.modal')
</div>
</div>
@include('tarjetas.modal-create')
@endsection


@section('scripts')

@include('delEditScripts')

<script type="text/javascript">
//llamado de las funciones para editar y eliminar con Ajax
operacionesDE('tarjetas/');
//llamado de funciones para darle estilo con Datatable a las tablas.
estiloTabla('#table-tarjetas');
estiloTabla('#table-creadas');
estiloTabla('#table-asignadas');


//funciones para usar el componente datepicker de Jquery Ui
  var txtInicio = $( "#fini" );
  var txtFin = $( "#ffin" );

 $( function() {
  txtInicio.datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  $( function() {
    txtFin.datepicker({ dateFormat: 'yy-mm-dd' });
  } );

  
  //seccion para quitar filtro por fecha
  
   if(txtInicio.val() === '' && txtFin.val() === ''){
    $('.btnban').attr('disabled', true);
   }else{
    $('.btnban').attr('disabled', false);
   }

   $('.btnban').click(function(){ 
  txtInicio.val('');
  txtFin.val('');
  $('#tipo').val('crea');
  });

  //seccion para setear en el select el valor que se mando para el filtro por status
    
    select = '{{$status}}';
    if(select === ""){
      $('#combo').val('def');
    }else{
      $('#combo').val(select);
    }

    tipoFecha = '{{$filtro}}';
    if(tipoFecha === ""){
      $('#tipo').val('crea');
    }else{
      $('#tipo').val(tipoFecha);
    }
  
    if($('#combo').val() === 'def'){
      $('.btnres').attr('disabled', true);
      
    }else{
       $('.btnres').attr('disabled', false);
      }
    $('.btnres').click(function(){ 
      $('#combo').val('def');
  });
  
   
</script>

@endsection
