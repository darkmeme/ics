@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="tableTools-container">
    <div class="row">
      <div class="topnav">
  <a href="/tarjetas-rojas/create">Crear Nueva Tarjeta Roja  <i class="fa fa-plus"></i></a>
  <a href="/tarjetas-rojas">Todas las tarjetas</a>
  <a id="actual" href="/tarjetas-creadas">Mis tarjetas creadas</a>
  <a href="/tarjetasR-asignadas">Mis tarjetas Asignadas</a>
</div>   
      </div>
    </div>
  </div>

  <div class="table-header">
    Listado de mis Tarjetas Rojas Creadas
  </div>
<div class="table-responsive">

       <table class="table text-center table-striped" id="table-tarjetas">
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
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
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
        @include('tarjetas-rojas.modal-editar')
        @include('tarjetas-rojas.modal-borrar')
</div>
</div>

@endsection

@section('scripts')

@include('delEditScripts')
<script type="text/javascript">
operacionesDE('tarjetas-rojas/');
</script>

@endsection
