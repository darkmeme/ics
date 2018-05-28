@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
  <div class="col-sm-12">
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/users/create"><button class="btn btn-info" type="button">Nuevo<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>
    <div class="table-header">
      Lista de Usuarios"
    </div>
    <div class="table-responsive">
      <table class="table text-center" id="table-empleados" width="100%" cellspacing="0">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Email</th>
          <th class="text-center">Codigo</th>
          <th class="text-center">Puesto</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($users as $u)
        <tr>
          <td>{{$u->id}}</td>
          <td>{{$u->name}}</td>
          <td>{{$u->email}}</td>
          <td>{{$u->codigoempleado}}</td>
          <td>{{$u->puesto->nombre}}</td>

          <td>
            @can('borrar')
            <a href="{{URL::action('UsersController@edit',$u->id)}}"> <button class="btn btn-info">Editar</button></a>
              <a href=""data-target="#modal-delete-{{$u->id}}" data-toggle="modal"> <button class="btn btn-danger">Eliminar</button></a>
              @else
              @endcan
          </td>
        </tr>
        @include('users.modal')
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

var table = $('#table-empleados').DataTable({
  "aaSorting": [[ 0, "desc" ]],
});

new $.fn.dataTable.Buttons( table, {
    buttons: [
      {
        "extend": "pdf",
        "titleAttr": 'Exportar a PDF',
        "messageTop": 'Reporte de Empleados.',
        "filename": 'Reporte de Empleados',
        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        //"orientation": 'landscape',
              "  pageSize": 'Letter',
          "exportOptions": {
                    "columns": ':visible',
      }},
      {
        "extend": "copy",
        "titleAttr": 'Copiar a Porta Papeles',
        "text": "<i class='fa fa-copy bigger-110 pink'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                    "columns": ':visible',
                }
      },
      {
        "extend": "excel",
        "titleAttr": 'Exportar a Excel',
        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                    "columns": ':visible',
                }
      },
      {
        "extend": 'print',
        "titleAttr": 'Imprimir Documento',
        "text": "<i class='fa fa-print bigger-110 grey'></i>",
        "className": "btn btn-white btn-primary  btn-bold",
        "exportOptions": {
                    "columns": ':visible',
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
