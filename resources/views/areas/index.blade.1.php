@extends('layouts.admin')
@section('contenido')
<br>
<div class="container" id="table">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue">Listado de Areas</h3>
                <div class="clearfix">
                  <div class="tableTools-container">
                      <div class="row">
                         <div class="col-lg-2">
                            {{--<a href=""><button class="btn btn-info" type="button">Nueva<i class="fa fa-plus"></i>
                            </button></a>--}}
                         </div>
                        </div>
                   </div>
                 </div>

                 <div class="table-header">
                    Lista de Areas"
                    </div>
                    
                      <table class="table text-center table-striped" id="table-areas">
                         <thead>
                           <th>Id</th>
                            <th>Nombre</th>
                            <th>Planta</th>
                            <th>Opciones</th>
                         </thead>
                         <tr v-for="area in areas">
                         <td>@{{area.id}}</td>
                         <td>@{{area.nombre}}</td>
                         <td>@{{area.planta.nombre}}</td>
                         <td>
                           <a href="#" class="btn btn-warning btn-sm">Editar </a>
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteArea(area)">Eliminar</a>
                           </td>
                         </tr>
                          </table>
                         
  </div>
</div>
</div>
@include('areas.modalCreate')
@endsection

@section('scripts')

<script src="{{asset('js/app.js')}}">//script para llamar a vue js</script>
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#').DataTable({
    //"aaSorting": [[ 0, "desc" ]],
  });

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
