@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Causas</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/causas/create"><button class="btn btn-info" type="button">Nueva<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Areas"
    </div>

      <table class="table text-center table-striped table-hover" id="table-causas">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center" WIDTH="300px">Opciones</th>
        </thead>

        @foreach ($causas as $causa)
        <tr>
          <td>{{$causa->id}}</td>
          <td>{{$causa->nombre}}</td>
          <td>
            <div class="action-buttons col-lg-12">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('CausasController@edit',$causa->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              {{Form::open(array('action'=>array('CausasController@destroy',$causa->id),'method'=>'delete'))}}
              <a class="red btnBorrar" href="">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>          
              {{Form::Close()}}
              @else
              @endcan
            </div>

          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
//se ejecuta el script cuando la pagina termina de cargar
$(document).ready(function() {
// script para eliminar una causa mediante ajax
$('.btnBorrar').click(function(e){
e.preventDefault();
if(! confirm("Esta seguro de Eliminar?")){
  return false;
}
var row= $(this).parents('tr');
var form= $(this).parents('form');
var url= form.attr('action');

// se hace la peticion ajax
$.post(url,form.serialize(),function(result){
row.fadeOut();
toastr.success('CAUSA ELIMINADA CORRECTAMENTE');
})//finaliza la peticion ajax

.fail(function(){
  toastr.error('NO SE PUEDE ELIMINAR LA CAUSA PORQUE ESTA EN USO');
})
});//finaliza evento click de boton borrar
  




//script para poner estilo de data table de jquery
  var table = $('#table-causas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

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
