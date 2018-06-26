@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div>

  <div class="table-header">
    Listado de mis Tarjetas Realizadas"
  </div>
<div class="table-responsive">

      <table class="table table-bordered text-center table-striped table-hover" id="table-tarjetas-realizadas">
        <thead>
          <th>Numero</th>
          <th>Area</th>
          <th>Planta</th>
          <th>Fecha</th>
          <th>Creada por</th>
          <th>Equipo</th>
          {{--<th>Turno</th>--}}
          <th>Prioridad</th>
          <th>Categoria</th>
          {{--<th>Evento</th>--}}
          {{--<th>Causa</th>--}}
          <th>Descripcion</th>
          {{--<th>Solucion</th>--}}
          {{--<th>Fecha cierre</th>--}}
          {{--<th>Finalizado</th>--}}
          <th>Estatus</th>
          <th>Reasignada a:</th>
          <th>Motivo Reasignacion:</th>
          <th>Opciones</th>
        </thead>


        @foreach ($tarjetas as $t)
        <tr>
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          {{--<td>{{$t->turno}}</td>--}}
          <td>{{$t->prioridad}}</td>
          <td>{{$t->categoria->nombre}}</td>
          {{--<td>{{$t->evento->nombre}}</td>--}}
          {{--<td>{{$t->causa->nombre}}</td>--}}
          <td>{{$t->descripcion_reporte}}</td>
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
              <a class="green" href="#">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>

            </div>
          </td>
        </tr>
        @endforeach
      </table>
        </div>
</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-tarjetas-realizadas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de mis tarjetas realizadas.',
          "filename": 'Reporte de tarjetas',
          "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
          "orientation": 'landscape',
              "  pageSize": 'Letter',
          "exportOptions": {
                    "columns": ':visible'
                }
        },
        {
          "extend": "copy",
          "titleAttr": 'Copiar a Porta Papeles',
          "text": "<i class='fa fa-copy bigger-110 pink'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
          "exportOptions": {
                    "columns": ':visible'
                }
        },
        {
          "extend": "excel",
          "titleAttr": 'Exportar a Excel',
          "text": "<i class='fa fa-file-excel-o bigger-110 green'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
          "exportOptions": {
                    "columns": ':visible'
                }
        },
        {
          "extend": 'print',
          "titleAttr": 'Imprimir Documento',
          "text": "<i class='fa fa-print bigger-110 grey'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
          "exportOptions": {
                    "columns": ':visible'
                }
        },
        {
          "extend": 'colvis',
          "titleAttr": 'Ocultar Columnas',
          "text": "ocultar",
          "className": "btn btn-white btn-primary  btn-bold",
        } ]
  } );

  table.buttons().container()
      .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
} );
</script>
@endsection
