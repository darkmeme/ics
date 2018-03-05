@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-lg-6 col-xs-12">
  <a href="causas/create"><button class="btn btn-success">Nuevo +</button></a>
</div>
  </div>

<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Categorias</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>

    <div class="table-header">
      Lista de Areas"
    </div>

      <table class="table text-center table-striped table-hover" id="table-causas">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Opciones</th>
        </thead>

        @foreach ($causas as $causa)
        <tr>
          <td>{{$causa->id}}</td>
          <td>{{$causa->nombre}}</td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('CausasController@edit',$causa->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('borrar')
              <a class="red" href="" data-target="#modal-delete-{{$causa->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>

          </td>
        </tr>
        @include('causas.modal')
        @endforeach
      </table>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-causas').DataTable();

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Causas.',
          "filename": 'Reporte de Causas',
          "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": "copy",
          "titleAttr": 'Copiar a Porta Papeles',
          "text": "<i class='fa fa-copy bigger-110 pink'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": "excel",
          "titleAttr": 'Exportar a Excel',
          "text": "<i class='fa fa-file-excel-o bigger-110 green'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": 'print',
          "titleAttr": 'Imprimir Documento',
          "text": "<i class='fa fa-print bigger-110 grey'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
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
