@extends('layouts.admin')
@section('contenido')
  <br>

  <div class="col-lg-5">
    @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('message')}}
      </div>
    @endif
  </div>


<div class="row">
<div class="col-xs-12">
  <h3 class="header smaller lighter blue">Listado de mis Tarjetas Asignadas</h3>
  <div class="clearfix">
    <div class="pull-right tableTools-container"></div>
  </div>

  <div class="table-header">
    Listado de mis Tarjetas Asignadas"
  </div>
<div class="table-responsive">

      <table class="table table-bordered text-center table-striped table-hover" id="table-tarjetas-asignadas">
        <thead>
          <th>Numero</th>
          <th>Area</th>
          <th>Planta</th>
          <th>Fecha</th>
          <th>Nombre</th>
          <th>Equipo</th>
          {{--<th>Turno</th>--}}
          <th>Prioridad</th>
          <th>Categoria</th>
          {{--<th>Evento</th>
          <th>Causa</th>--}}
          <th>Descripcion</th>
          {{--<th>Solucion</th>
          <th>Fecha cierre</th>--}}
          <th>Finalizado</th>
          <th>Estatus</th>
          <th>Opciones</th>
        </thead>


        @foreach ($tarjetas as $t)
        @include('tarjetas.modal-editar')
        <tr>
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td>{{$t->prioridad}}</td>
          <td>{{$t->categoria->nombre}}</td>
          <td>{{$t->descripcion_reporte}}</td>
          <td>{{$t->finalizado}}</td>
          <td><span class="label label-sm label-success">{{$t->status}}</span>
          </td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>

              <a class="green edit-btn" value="{{$t->id}}" data-toggle="modal" data-target="#edit-tag-{{$t->id}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
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
    //script para editar una tarjeta amarilla
    $(document).ready(function(){
        $("#table-tarjetas-asignadas").on("click touchstart", ".edit-btn", function () {
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
                    $(".descripcion_reporte").val(data['descripcion']);

                    html += '<option value="'+data['prioridad']+'">'+data['prioridad']+'</option>'+
                        '<option value="'+'A'+'">'+'A'+'</option>'+
                        '<option value="'+'B'+'">'+'B'+'</option>'+
                        '<option value="'+'c'+'">'+'C'+'</option>';
                    $('.prioridad').html(html);
                    $('.equipo').html('<option value="'+data['equipo']+'">'+data['equipo']+'</option>');
                    //$('#update-form').show();
                },
            });//fin de peticion ajax
//alert('se presiono boton de editar');
        });//fin de click
    });//fin function ready
  </script>




<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-tarjetas-asignadas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de mis tarjetas asignadas.',
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
      .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
} );
</script>
@endsection
