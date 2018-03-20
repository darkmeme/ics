@extends('layouts.admin')
@section('contenido')
<br>
<div class="col-lg-4">
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
</div>

<div class="row">
<div class="col-xs-12">
  <h3 class="header smaller lighter blue">Listado de Tarjetas Rojas</h3>
  <div class="clearfix">
    <div class="tableTools-container">
      <div class="row">

      <div class="col-lg-2 col-md-2 col-xs-4">
        <a href="/tarjetas-rojas/create"><button class="btn btn-info" type="button">Nueva<i class="fa fa-plus"></i></button></a>
      </div>

      <div class="col-lg-3 col-xs-6 col-md-6">
      @include('tarjetas.rojas.search')
      </div>

      </div>
    </div>
  </div>

  <div class="table-header">
    Listado de todas las tarjetas rojas"
  </div>
<div class="table-responsive">

      <table class="table text-center table-striped" id="tableTarjetasRojas">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Usuario</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Finalizado</th>
          <th class="text-center">Opciones</th>
        </thead>


        @foreach ($tarjetasRojas as $tr)
        <tr id="filas">
          <td>{{$tr->id}}</td>
          <td>{{$tr->area->nombre}}</td>
          <td>{{$tr->planta->nombre}}</td>
          <td>{{$tr->created_at}}</td>
          <td>{{$tr->user->name}}</td>
          <td>{{$tr->equipo->nombre}}</td>
          <td>{{$tr->prioridad}}</td>
          <td>{{$tr->descripcion_reporte}}</td>
          <td class="td-status"><span class="label label-sm label-warning">{{$tr->status}}</span></td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>


              <a class="green edit-btn" value="{{$tr->id}}" data-toggle="modal" data-target="#editTagRoja">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>

              <a class="red" href="" data-target="#" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @can('borrar')
              @else
              @endcan

            </div>
          </td>
        </tr>

        @endforeach
      </table>
        </div>
</div>
</div>
{{--@include('tarjetas.rojas.modal-editar')--}}

@endsection


@section('scripts')
<script type="text/javascript">
//script para editar una tarjeta
$(document).ready(function(){
$("#tableTarjetasRojas").on("click touchstart", ".edit-btn", function () {
$.ajax({
  type: "GET",
  url: "tarjetas/" + $(this).attr("value") + "/edit",
  dataType: 'json',
 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
 beforeSend: function() {
 //$('#item-not-found').remove();
 },
  success: function (data) {
    var html;
  $("#descripcion_reporte").val(data['descripcion']);

  html += '<option value="'+data['prioridad']+'">'+data['prioridad']+'</option>'+
          '<option value="'+'A'+'">'+'A'+'</option>'+
          '<option value="'+'B'+'">'+'B'+'</option>'+
          '<option value="'+'c'+'">'+'C'+'</option>';
  $('#prioridad').html(html);

 },

});//fin de peticion ajax
//alert('se presiono boton de editar');
});//fin de click
});//fin function ready
</script>


<script type="text/javascript">
$(document).ready(function(){

$("#prueba").click(function(e){
 var estado='';
 var status;

    $("#table-tarjetas #filas").each(function(index, value){
  estado= $(value).find("td").eq(9).text()
  status=$.trim(estado);
  console.log(status);
if (status=="Reasignada"){
  $("#table-tarjetas #filas .td-status").append("<td id="+index+"><span class=label label-sm label-warning>Reasignada</span></td>")
}
else {
  $("#table-tarjetas #filas .td-status .label").addClass("label label-sm label-info");
}
});


});
});
</script>

<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-tarjetas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de listado de tarjetas.',
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
      .appendTo( $('.col-sm-6 :eq(0)', table.table().container() ) );
} );
</script>
@endsection
