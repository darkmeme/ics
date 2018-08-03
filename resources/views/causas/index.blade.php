@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
  <div class="col-xs-12">
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
        <button class="btn btn-info"  data-target="#modalCreateCausa" data-toggle="modal">Nueva
            <i class="fa fa-plus"></i></button>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Causas
    </div>

      <table class="table text-center table-striped table-hover" id="table-causas">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($causas as $causa)
        <tr class="item{{$causa->id}}">
          <td class="text-center">{{$causa->id}}</td>
          <td class="text-center">{{$causa->nombre}}</td>
          <td class="text-center">
            <div class="action-buttons col-lg-12">
            <a class="green btn-editar" data-id="{{$causa->id}}" data-causa="{{$causa->nombre}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red btnBorrar" " href="#" data-id="{{$causa->id}}" data-nombre="{{$causa->nombre}}">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>                        
              @else
              @endcan
            </div>

          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
  @include('causas.modalEdit')
  @include('causas.modalBorrar')
  @include('causas.modalCreate')
@endsection

@section('scripts')
@include('ScriptDataTable')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
estiloTabla('#table-causas');

$(document).ready(function() {

//script para eliminar con modal
$(document).on('click', '.btnBorrar', function() {
            var nombre = $(this).data('nombre');
            //var
            $('.txt-borrar').text(nombre);
            $('#modal-delete').modal('show');
            id = $(this).data('id');   
            //alert('el id es:'+id);         
        });
$('.modal-footer').on('click', '.eliminar', function(){

    $.ajax({

         type: 'DELETE',
         url:  'causas/' + id,
         data: {
         },
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        success: function(data){
          toastr.success('Causa Borrada Correractamente!', 'Eliminando Causa', {timeOut: 5000});
          $('#modal-delete').modal('hide');
          $('.item' + id).fadeOut(600);          
          },

          error: function(){
            toastr.error('No se puede borrar la causa porque esta en uso!', 'Eliminando Causa', {timeOut: 5000});
            $('#modal-delete').modal('hide');
            },
    });

});

//editar con modal
$(document).on('click', '.btn-editar', function() { 
          id = $(this).data('id');
          fila = $('.item' + id);
          $('#txtCausa').val(fila.find("td:eq(1)").html());
         // alert('se capturo la planta '+id );
          $('#modalEdit').modal('show');
          //$('#txtPlanta').focus();
         
          //boton = $(this);

        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'causas/' + id,
                data: {                    
                    'id': id,
                    'nombre': $('#txtCausa').val(),                   
                },
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#modalEdit').modal('show');
                            toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
                        }, 500);
                        
                    } else {
                        $('#modalEdit').modal('hide');
                        //alert('valor del data antes de editar: '+ boton.data('planta'));
                        fila.find("td:eq(1)").html(data.nombre);  
                        
                        //location.reload();    
                       // alert('valor del data despues de editar: '+ boton.data('planta'));                 
                        toastr.success('Se ha Modificado Correctamente!', 'Aviso!', {timeOut: 5000});
                                              
                    }
                }
            });
        });


} );//termina document ready

</script>
@endsection
