@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Equipos</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/equipos/create"><button class="btn btn-info" type="button">Nuevo<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Equipos"
    </div>

<div class="table-responsive">
      <table class="table text-center table-striped table-hover" id="table-equipos">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Area</th>
          <th>Padre</th>
          <th>Opciones</th>
        </thead>

        @foreach ($equipos as $equipo)
        <tr>
          <td>{{$equipo->id}}</td>
          <td>{{$equipo->nombre}}</td>
          <td>{{$equipo->area->nombre}}</td>
        <td>  @if ($equipo->padre==1)
          <i class="ace-icon fa fa-check bigger-200"></i>
        </td>
          @endif
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('EquiposController@edit',$equipo->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('borrar')
              <a class="red" href="" data-target="#modal-delete-{{$equipo->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>

          </td>
        </tr>
           @include('equipos.modal')
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

  var table = $('#table-equipos').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Equipos.',
          "filename": 'Reporte de Equipos',
          "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
          "exportOptions": {
                    "columns": ':visible'
                }
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
