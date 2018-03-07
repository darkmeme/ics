@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Consumos de Energia</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/medidores/create"><button class="btn btn-info" type="button">Nuevo<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Cunsumos de Energia
    </div>

<div class="table-responsive">
      <table class="table table-bordered text-center table-striped table-hover" id="table-medidores">
        <thead>
          <th>No</th>
          <th>Fecha</th>
          <th>Nsd 220</th>
          <th>Nsd 480</th>
          <th>Blanqueo</th>
          <th>Calderas</th>
          <th>Sulfonacion</th>
          <th>Oficinas</th>
          <th>Daf</th>
          <th>Comby</th>
          <th>Saponificacion</th>
          <th>Enee Principal</th>
          <th>Enee Reactivo</th>
          <th>FP</th>
          <th>Opciones</th>
        </thead>

        @foreach ($medidores as $m)
        <tr>
          <td>{{$m->id}}</td>
          <td>{{$m->created_at}}</td>
          <td>{{$m->nsd_220}}</td>
          <td>{{$m->nsd_480}}</td>
          <td>{{$m->blanqueo}}</td>
          <td>{{$m->calderas}}</td>
          <td>{{$m->sulfonacion}}</td>
          <td>{{$m->oficinas}}</td>
          <td>{{$m->daf}}</td>
          <td>{{$m->comby}}</td>
          <td>{{$m->saponificacion}}</td>
          <td>{{$m->enee_principal}}</td>
          <td>{{$m->enee_reactivo}}</td>
          <td>{{$m->fp}}</td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              <a class="red" href="" data-target="" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
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

  var table = $('#table-medidores').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de medidores.',
          "filename": 'Reporte de medidores',
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
