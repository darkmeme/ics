@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
<div class="col-lg-6 col-xs-12">
  <a href="areas/create"><button class="btn btn-info">Nuevo</button></a>
</div>
</div>

<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Areas</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container">

      </div>
    </div>
    <div class="table-header">
      Lista de Areas"
    </div>
      <table class="table text-center table-striped" id="example">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Planta</th>
          <th>Opciones</th>
        </thead>

        @foreach ($areas as $are)
        <tr>
          <td>{{$are->id}}</td>
          <td>{{$are->nombre}}</td>
          <td>{{$are->planta->nombre}}</td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('AreasController@edit',$are->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @hasanyrole('Administrador|Coordinador')
              <a class="red" href="" data-target="#modal-delete-{{$are->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
@include('areas.modal')
        @endforeach
      </table>
  </div>
</div>
@endsection



@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#example').DataTable();

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Areas.',
          "filename": 'Reporte de Areas',
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
