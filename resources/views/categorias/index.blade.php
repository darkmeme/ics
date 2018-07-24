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
        <tr class="item{{$cat->id}}">
          <td>{{$cat->id}}</td>
          <td id="cat">{{$cat->nombre}}</td>
          <td>
            <div class="action-buttons">            
              <a class="green btn-edit" href="#" data-id="{{$cat->id}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              
              <a class="red btn-del" href="#" data-id="{{$cat->id}}">
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
@include('categorias.modalEdit')
@include('categorias.modalBorrar')
@include('categorias.modalCreate')
@endsection

@section('scripts')
@include('ScriptDataTable')

<script type="text/javascript">
estiloTabla('#table-categorias');

$('.btn-del').click(function (){
         id = $(this).data('id');
         fila = $('.item' + id);   
         $('.nombre').text(fila.find("td:eq(1)").html());
           
         $('#modal-delete').modal('show');
        
        });

   //se ejecuta la peticion ajax al hacer clic al boton eliminar del modal  
 $('.modal-footer').on('click', '.del', function(){

$.ajax({

     type: 'DELETE',
     url:  'categorias/' + id,
     data: {
     },
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    success: function(data){
      toastr.success('Categoria Borrada Correractamente!', 'Eliminando Categoria', {timeOut: 5000});
      $('#modal-delete').modal('hide');
     fila.fadeOut(600);          
      },

    error: function(){
        toastr.error('No se puede borrar la categoria porque esta en uso!', 'Eliminando Categoria', {timeOut: 5000});
        $('#modal-delete').modal('hide');
        },
});

});     


//script para editar
//funcion para mandar datos y abrir el modal
$('.btn-edit').click(function (){

id = $(this).data('id');
fila = $('.item' + id);   
nombre = fila.find("#cat");
$('.nombre').val(nombre.text());           
$('#modal-edit').modal('show');        
});
//funcion para hacer l apeticion ajax para editar
$('.modal-footer').on('click', '.edit', function() {
  nombreEdited = $('.nombre').val();
 $.ajax({
     type: 'PUT',
     url: 'categorias/' + id,
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
             nombre.text(nombreEdited);                                                       
             toastr.success('Categoria modificada Correctamente!', 'Aviso!', {timeOut: 5000});                                    
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
