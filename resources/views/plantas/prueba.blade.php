@extends('layouts.admin')
@section('contenido')
<div class="container-fluid">
  <div class="col-lg-6">
  <a><button class="btn btn-info" type="button" data-target="#modalCreatePlanta" data-toggle="modal">Nueva<i class="fa fa-plus"></i></button></a>
      <table class="table text-center table-hover" id="table-plantas">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">descripcion</th>
          <th class="text-center">Estatus</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Opciones</th>
        </thead>

        {{--@foreach ($planta as $p)
        <tr>
          <td>{{$p->id}}</td>
          <td>{{$p->descripcion_reporte}}</td>
          <td>{{$p->status}}</td>
          <td>{{$p->planta->nombre}}</td>
          <td>
          <a class="blue" href="">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
          
              @can('Borrar')
              @else
              @endcan
          </td>
        </tr>
        @endforeach--}}
      </table>
      </div>

      <div class="col-lg-6">
      <p>prueba de grafico</p>
      <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chart Demo</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
      </div>
      </div>
@endsection


@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {
  var table = $('#table-plantas').DataTable({
   
  });
});
</script>
@endsection
