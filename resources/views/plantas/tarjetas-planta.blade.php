@extends('layouts.admin')
@section('contenido')
  <br>
<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div>

  <div class="table-header">
    Listado de Tarjetas en esta Planta
  </div>
<div class="table-responsive">

      <table class="table table-bordered text-center table-striped table-hover" id="table-tarjetas-asignadas">
        <thead>
          <th>Numero</th>
          <th>Planta</th>
          <th>Fecha</th>                    
          <th>Descripcion</th>
          <th>Estatus</th>
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
@endsection

@section('scripts')

<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-tarjetas-asignadas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de mis tarjetas asignadas.',
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