@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Equipos</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="#"><button class="btn btn-info btnCrear">Nuevo <i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Equipos
    </div>

<div class="table-responsive">
      <table class="table text-center table-striped table-hover" id="table-equipos">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Area</th>
          <th class="text-center">Padre</th>
          <th class="text-center" WIDTH="100">Opciones</th>
        </thead>

        @foreach ($equipos as $eq)
        <tr class="item{{$eq->id}}">
          <td>{{$eq->id}}</td>
          <td class="equipo">{{$eq->nombre}}</td>
          <td class="area" data-id="{{$eq->area->id}}">{{$eq->area->nombre}}</td>
        <td>  @if ($eq->padre==1)
          <i class="ace-icon fa fa-check bigger-200"></i>
        </td>
          @endif
          <td>
            <div class="action-buttons">
              <a class="green btn-edit" href="#" data-id="{{$eq->id}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              <a class="red btn-del" href="#" data-id="{{$eq->id}}">
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
  </div>
@include('equipos.modalEdit')
@include('equipos.modalDelete')
@include('equipos.modalCreate')
@endsection

@section('scripts')
@include('ScriptDataTable')
<script src="{{asset('js/combox.js')}}"></script>

<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
estiloTabla('#table-equipos');
//script para abrir modal para crear equipo
$('.btnCrear').click(function(){
  $('#modalCreate').modal('show');
});

//script para borrar con peticion ajax
$('.btn-del').click(function (){
         id = $(this).data('id');
         fila = $('.item' + id);   
         $('.nombre').text(fila.find(".equipo").text());
           
         $('#modal-delete').modal('show');
        
        });

 //se ejecuta la peticion ajax al hacer clic al boton eliminar del modal  
 $('.modal-footer').on('click', '.del', function(){

$.ajax({

     type: 'DELETE',
     url:  'equipos/' + id,
     data: {
     },
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    success: function(data){
      toastr.success('Equipo Borrado Correractamente!', 'Eliminando Equipo', {timeOut: 5000});
      $('#modal-delete').modal('hide');
     fila.fadeOut(600);          
      },

    error: function(){
        toastr.error('No se puede borrar El equipo porque está en uso!', 'Eliminando Equipos', {timeOut: 5000});
        $('#modal-delete').modal('hide');
        },
});

});     


//script para editar
//funcion para mandar datos y abrir el modal
$('.btn-edit').click(function (){

id = $(this).data('id');
fila = $('.item' + id);   
nombre = fila.find(".equipo");
area = fila.find(".area");
idArea = area.data('id');
$('#nombre').val(nombre.text());  
$('.comboA').val(idArea);
//prueba = $('.comboA option:selected').text();
//alert('probando data en select: '+prueba);         
$('#modal-edit').modal('show');        
});

//funcion para hacer l apeticion ajax para editar
$('.modal-footer').on('click', '.edit', function() {
  nombreEdited = $('#nombre').val();
  areaId = $('.comboA').val();
 $.ajax({
     type: 'PUT',
     url: 'equipos/' + id,
     data: {                    
         'id': id,
         'nombre': nombreEdited, 
         'area_id': areaId                           
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
             fila.find(".area").text($('.comboA option:selected').text()); 
             area.data('id', areaId);                                                   
             toastr.success('Equipo modificado Correctamente!', 'Aviso!', {timeOut: 5000});                                    
         }
     },
     error: function(){
         $('#modal-edit').modal('hide');
         toastr.error('No se ha podido modificar equipo!', 'alerta de Error', {timeOut: 5000});
     }
 });
});

</script>
@endsection
