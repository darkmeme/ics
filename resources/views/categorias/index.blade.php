@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
    <div class="col-xs-12">
      <div class="clearfix">
        <div class="tableTools-container">
          <div class="row">
          <div class="col-lg-2">
            <button class="btn btn-info"  data-target="#modalCreateCategoria" data-toggle="modal">Nueva
            <i class="fa fa-plus"></i></button>
          </div>
          </div>
        </div>
      </div>

      <div class="table-header">
        Lista de Categorias
      </div>

        <table class="table text-center table-striped" id="table-categorias">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($categorias as $cat)
        <tr>
          <td>{{$cat->id}}</td>
          <td>{{$cat->nombre}}</td>
          <td>
            <div class="action-buttons">            
              <a class="green" data-target="#modal-edit-{{$cat->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              
              <a class="red" href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @can('borrar')
              @else
              @endcan
            </div>
          </td>
        </tr>
        @include('categorias.modalBorrar')
        @include('categorias.modalEdit')
        @endforeach
      </table>
    </div>
</div>
@include('categorias.modalCreate')
@endsection

@section('scripts')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-categorias').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Categorias.',
          "filename": 'Reporte de Categorias',
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
