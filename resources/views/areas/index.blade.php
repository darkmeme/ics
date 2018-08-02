@extends('layouts.admin')
@section('contenido')
<br>
    <div class="row">
        <div class="col-xs-12">
                <div class="clearfix">
                  <div class="tableTools-container">
                      <div class="row">
                         <div class="col-lg-2">
                            <button class="btn btn-info"  data-target="#modalCreate" data-toggle="modal">Nueva
                            <i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                   </div>
                 </div>

                 <div class="table-header">
                    Lista de Areas
                    </div>
                    
                      <table class="table table-striped" id="tablaAreas">
                         <thead>
                           <th class="text-center">Id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Planta</th>
                            <th class="text-center">SubArea</th>
                            <th class="text-center">Opciones</th>
                         </thead>
                         @foreach ($areas as $a)
                         <tr class="item{{$a->id}}">
                         <td class="text-center">{{$a->id}}</td>
                         <td class="text-center area">{{$a->nombre}}</td>
                         <td class="text-center planta" data-id="{{$a->planta->id}}">{{$a->planta->nombre}}</td>
                         <td class="text-center">
                         @if(isset($a->subarea->nombre))
                         {{$a->subarea->nombre}}
                         @else Vacio                    
                         @endif
                         </td>
                         <td class="text-center">
                              <div class="action-buttons">
                              <a class="blue" href="{{URL::action('AreasController@show',$a->id)}}">
                                <i class="ace-icon fa fa-eye bigger-200"></i>
                              </a>

                              <a class="green btn-edit" data-id="{{$a->id}}">
                                <i class="ace-icon fa fa-pencil bigger-200"></i>
                              </a>
                            
                              <a class="red btn-del" href="#" data-id="{{$a->id}}">
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
@include('areas.modalEdit') 
@include('areas.modalDelete') 
@include('areas.modalCreate')                 
@endsection

@section('scripts')
@include('ScriptDataTable')

<script type="text/javascript" src="{{asset('js/combox.js')}}"></script>
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
estiloTabla('#tablaAreas');

//script para borrar con ajax
$('.btn-del').click(function (){
         id = $(this).data('id');
         fila = $('.item' + id);   
         $('#nombre').text(fila.find(".area").text());
           
         $('#modal-delete').modal('show');
        
        });

 //se ejecuta la peticion ajax al hacer clic al boton eliminar del modal  
 $('.modal-footer').on('click', '.del', function(){

$.ajax({

     type: 'DELETE',
     url:  'areas/' + id,
     data: {
     },
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    success: function(data){
      toastr.success('Area Borrada Correractamente!', 'Eliminando Area', {timeOut: 5000});
      $('#modal-delete').modal('hide');
     fila.fadeOut(600);          
      },

    error: function(){
        toastr.error('No se puede borrar El Area porque está en uso!', 'Eliminando Categoria', {timeOut: 5000});
        $('#modal-delete').modal('hide');
        },
});

});     

//script para editar
//funcion para mandar datos y abrir el modal
$('.btn-edit').click(function (){

id = $(this).data('id');
fila = $('.item' + id);   
nombre = fila.find(".area");
planta = fila.find(".planta");
idPlanta = planta.data('id');
$('.nombre').val(nombre.text());  
$('#combop').val(idPlanta);
//prueba = $('#combop').text();
//alert('probando data en select: '+prueba);         
$('#modal-edit').modal('show');        
});

//funcion para hacer l apeticion ajax para editar
$('.modal-footer').on('click', '.edit', function() {
  nombreEdited = $('.nombre').val();
  plantaId = $('#combop').val();
 $.ajax({
     type: 'PUT',
     url: 'areas/' + id,
     data: {                    
         'id': id,
         'nombre': nombreEdited, 
         'planta_id': plantaId                           
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
             fila.find(".planta").text($('#combop option:selected').text()); 
             planta.data('id', plantaId);                                                   
             toastr.success('Area modificada Correctamente!', 'Aviso!', {timeOut: 5000});                                    
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
