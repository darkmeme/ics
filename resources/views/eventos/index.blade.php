@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
  <div class="col-xs-12">
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
        <button class="btn btn-info"  data-target="#modalCreateEvento" data-toggle="modal">Nuevo
            <i class="fa fa-plus"></i></button>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Eventos
    </div>

      <table class="table text-center table-striped table-hover" id="table-eventos">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($eventos as $e)
        <tr class="item{{$e->id}}">
          <td>{{$e->id}}</td>
          <td>{{$e->nombre}}</td>
          <td>

            <div class="action-buttons">
              <a class="green btn-edit" href="#" data-id="{{$e->id}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              <a class="red btn-delete" href="#" data-id="{{$e->id}}">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @can('Borrar')
              @else
              @endcan
            </div>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
       @include('eventos.modalEdit')
       @include('eventos.modalBorrar')
       @include('eventos.modalCreate')
 
@endsection

@section('scripts')
@include('ScriptDataTable')

<script type="text/javascript">

estiloTabla('#table-eventos');

$('.btn-delete').click(function (){
         id = $(this).data('id');
         fila = $('.item' + id);   
         $('.txtEvento').text(fila.find("td:eq(1)").html());
           
         $('#modal-delete').modal('show');
        
        });

 //se ejecuta la peticion ajax al hacer clic al boton eliminar del modal  
 $('.modal-footer').on('click', '.del', function(){

$.ajax({

     type: 'DELETE',
     url:  'eventos/' + id,
     data: {
     },
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    success: function(data){
      toastr.success('Evento Borrado Correractamente!', 'Eliminando Evento', {timeOut: 5000});
      $('#modal-delete').modal('hide');
     fila.fadeOut(600);          
      },

      error: function(){
        toastr.error('No se puede borrar el evento porque esta en uso!', 'Eliminando Evento', {timeOut: 5000});
        $('#modal-delete').modal('hide');
        },
});

});     

//script para editar
//funcion para mandar datos y abrir el modal
$('.btn-edit').click(function (){

 id = $(this).data('id');
 fila = $('.item' + id);   
 nombre = fila.find("td:eq(1)");
 $('#nombre').val(nombre.html());           
 $('#modal-edit').modal('show');        
});
//funcion para hacer l apeticion ajax para editar
$('.modal-footer').on('click', '.edit', function() {
   nombreEdited = $('#nombre').val();
  $.ajax({
      type: 'PUT',
      url: 'eventos/' + id,
      data: {                    
          'id': id,
          'nombre': nombreEdited                           
      },
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
       
          if ((data.errors)) {
              setTimeout(function () {
                  $('#modal-edit').modal('show');
                  toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
              }, 500);
              
          } else {
              
              $('#modal-edit').modal('hide');
              nombre.html(nombreEdited);                                                       
              toastr.success('Evento modificado Correctamente!', 'Aviso!', {timeOut: 5000});                                    
          }
      },
      error: function(){
          $('#modal-edit').modal('hide');
          toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
      }
  });
});

</script>

@endsection
