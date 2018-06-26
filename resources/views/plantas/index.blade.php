@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Plantas</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a><button class="btn btn-info" type="button" data-target="#modalCreatePlanta" data-toggle="modal">Nueva<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Plantas"
    </div>

      <table class="table text-center table-striped table-hover" id="table-plantas">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Opciones</th>
        </thead>

        @foreach ($plantas as $plant)
        <tr>
          <td>{{$plant->id}}</td>
          <td>{{$plant->nombre}}</td>
          <td>
          <a class="blue" href="{{URL::action('PlantasController@show',$plant->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
          <a class="green" href="{{URL::action('PlantasController@edit',$plant->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>            
              @can('Borrar')
              <a class="red" href="" data-target="#modal-delete-{{$plant->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
@include('plantas.modalDelete')
        @endforeach
      </table>
    </div>
  </div>
@include('plantas.modalCreate')
@endsection


@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-plantas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Plantas.',
          "filename": 'Reporte de plantas',
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
