@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
<div class="col-xs-12">
  <div class="clearfix">
    <div class="tableTools-container">
      <div class="row">

      <div class="col-lg-2 col-md-2 col-xs-4">
        <a href="/tarjetas/create"><button class="btn btn-success" type="button">Nueva<i class="fa fa-plus"></i></button></a>
      </div>

      <div class="col-lg-3 col-xs-6 col-md-6">
      @include('tarjetas.search')
      </div>

      </div>
    </div>
  </div>

  <div class="row">
                <div class="col-lg-2 col-md-3 col-lg-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total: 
                                         <h2>{{$totalTarjetas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Emitidas: 
                                         <h2>{{$totalEmitidas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Reasignadas: 
                                         <h2>{{$totalReasignadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Finalizadas: 
                                         <h2>{{$totalFinalizadas}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                
            </div>

  <div class="table-header">
    Listado de todas las tarjetas"
  </div>
<div class="table-responsive">

      <table class="table text-center table-striped" id="table-tarjetas">
        <thead>
          <th class="text-center">Numero</th>
          <th class="text-center">Area</th>
          <th class="text-center">Planta</th>
          <th class="text-center">Fecha</th>
          <th class="text-center">Creada por</th>
          <th class="text-center">Equipo</th>
          <th class="text-center">Prioridad</th>
          <th class="text-center">Categoria</th>
          <th class="text-center">Descripcion</th>
          <th class="text-center">Estado</th>
          <th class="text-center" WIDTH="122">Opciones</th>
        </thead>

        @foreach ($tarjetas as $t)
        <tr id="filas" class="item{{$t->id}}">
          <td>{{$t->id}}</td>
          <td>{{$t->area->nombre}}</td>
          <td>{{$t->planta->nombre}}</td>
          <td>{{$t->created_at->format('d-m-Y')}}</td>
          <td>{{$t->user->name}}</td>
          <td>{{$t->equipo->nombre}}</td>
          <td>{{$t->prioridad}}</td>
          <td>{{$t->categoria->nombre}}</td>
          <td>{{$t->descripcion_reporte}}</td>
          <td class="td-status"><span class="label label-sm label-warning">{{$t->status}}</span></td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="{{URL::action('TarjetasController@show',$t->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>
              <button class="btn btn-link btnEdit" data-id="{{$t->id}}" data-prioridad="{{$t->prioridad}}" data-desc="{{$t->descripcion_reporte}}">
                <i class="ace-icon fa fa-pencil bigger-200" style="color: green;"></i>
              </button>
              @can('Borrar')
              <button class="btn btn-link btn-borrar" data-id="{{$t->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200" style="color: red;"></i>
              </button>
              @else
              @endcan
            </div>
          </td>
        </tr> 
        @endforeach
        @include('tarjetas.modal-editar')
        @include('tarjetas.modal')
      </table>
        </div>
</div>
</div>

@endsection


@section('scripts')
<script type="text/javascript">
  
  //editar tarjeta con modal
//funcion para abrir modal y mandarle datos para edicion
$(document).on('click', '.btnEdit', function() { 

          $('#prioridad').val($(this).data('prioridad'));
          $('.descripcion').val($(this).data('desc'));         
          //alert('se capturo la planta '+ $(this).data('desc') );
          $('#edit-tarjeta').modal('show');
          //$('#txtPlanta').focus();
          id = $(this).data('id');
          boton = $(this);
        
        }); //fin de la funcion on click

        $('.modal-footer').on('click', '.editar', function() {
            
            fila = $('.item'+id);
            var prioridad= $('#prioridad').val();
            var desc= $('.descripcion').val();  

            $.ajax({
                type: 'PUT',
                url: 'tarjetas/' + id,
                data: {                    
                    'id': id,
                    'prioridad': prioridad,  
                    'descripcion': desc                
                },
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                 
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#edit-tarjeta').modal('show');
                            toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
                        }, 500);
                        
                    } else {
                        $('#edit-tarjeta').modal('hide');
                       
                        fila.find("td:eq(6)").html(prioridad);
                        fila.find("td:eq(8)").html(desc);
                        boton.data('prioridad', prioridad);
                        boton.data('desc', desc);
                       // location.reload();                                           
                        toastr.success('Se ha Modificado Correctamente!', 'Aviso!', {timeOut: 5000});
                                              
                    }
                },
                error: function(){
                    $('#edit-tarjeta').modal('hide');
                    toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
                }
            });
        });

</script>


<script type="text/javascript">
$(document).ready(function(){

$("#prueba").click(function(e){
 var estado='';
 var status;
  //var status= $("#table-tarjetas #filas .td-status").text();
//  estado=$.trim(status);

    $("#table-tarjetas #filas").each(function(index, value){
  estado= $(value).find("td").eq(9).text();
  status=$.trim(estado);
  console.log(status);
if (status=="Reasignada"){
  $("#table-tarjetas #filas .td-status").append("<td id="+index+"><span class=label label-sm label-warning>Reasignada</span></td>")
  //$("#table-tarjetas #filas .td-status .label").addClass("label label-sm label-warning");
}
else {
  $("#table-tarjetas #filas .td-status .label").addClass("label label-sm label-info");
}
});
  //id = $(this).parents("tr").find(".id").html();


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

//script para eliminar con modal
//funcion para abrir modal y mandarle datos
$(document).on('click', '.btn-borrar', function() {
            id = $(this).data('id');
            $('.txtBorrar').text(id);
            $('#modal-delete').modal('show');
               
            //alert('el id es:'+id);         
        });

//funcion para hacer peticion ajax con el modal
$('.modal-footer').on('click', '.borrar', function(){

$.ajax({

     type: 'DELETE',
     url: ' tarjetas/' + id,
     data: {
     },
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    success: function(data){
      toastr.success('Tarjeta Borrada Correractamente!', 'Eliminando Tarjeta', {timeOut: 5000});
      $('#modal-delete').modal('hide');
      $('.item' + id).fadeOut(600);          
      },

      error: function(){
        toastr.error('No se ha podido borrar la tarjeta!', 'Eliminando Tarjeta', {timeOut: 5000});
        $('#modal-delete').modal('hide');
        },
});

});

</script>
@endsection
