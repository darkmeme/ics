@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="tableTools-container">
    <div class="row">
      <div class="topnav">
  <a href="/tarjetas/create">Crear Nueva Tarjeta Amarilla <i class="fa fa-plus"></i></a>
  <a href="/tarjetas">Todas las tarjetas</a>
  <a id="actual" href="/mis-tarjetas">Mis tarjetas creadas</a>
  <a href="/tarjetas-asignadas">Mis tarjetas Asignadas</a>
</div>   
      </div>
    </div>
  </div>

  <div class="table-header">
    Listado de mis Tarjetas Amarillas Creadas
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
          <th class="text-center">Categoria</th>          
          <th class="text-center">Estatus</th>
          <th class="text-center">Reasignada a:</th>
          <th class="text-center">Motivo Reasignacion:</th>
          <th class="text-center" WIDTH="122">Opciones</th>
        </thead>


        @foreach ($tarjetas as $t)
        <tr class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          {{--<td>{{$t->turno}}</td>--}}
          <td>{{$t->prioridad}}</td>
          <td>{{$t->descripcion_reporte}}</td>
          <td>{{$t->categoria->nombre}}</td>
          {{--<td>{{$t->evento->nombre}}</td>--}}
          {{--<td>{{$t->causa->nombre}}</td>--}}
          {{--<td>{{$t->solucion_implementada}}</td>--}}
          {{--<td>{{$t->fecha_cierre}}</td>--}}
          {{--<td>{{$t->finalizado}}</td>--}}
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
              @can('Borrar')
              @else
              @endcan

            </div>
          </td>
        </tr>
        @endforeach
        @include('tarjetas.modal-editar')
        @include('tarjetas.modal')
      </table>
        </div>
</div>
</div>

@endsection

@section('scripts')

@include('delEditScripts')

<script type="text/javascript">

operacionesDE('tarjetas/');

</script>

@endsection
