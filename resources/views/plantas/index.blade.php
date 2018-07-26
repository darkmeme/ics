@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Plantas</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a><button class="btn btn-info" type="button" data-target="#modalCreatePlanta" data-toggle="modal">Nueva<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Plantas
    </div>

      <table class="table text-center table-striped table-hover" id="datatable">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($plantas as $plant)
        <tr class="item{{$plant->id}}">
          <td>{{$plant->id}}</td>
          <td id="nombre">{{$plant->nombre}}</td>
          <td>
          <div class="action-buttons">
          <a class="blue" href="{{URL::action('PlantasController@show',$plant->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>

            <a class="green btn-editar" href="#" data-id="{{$plant->id}}" data-planta="{{$plant->nombre}}">
              <i class="ace-icon fa fa-pencil bigger-200"></i>
            </a>
          
            <a class="red btn-delete" href="#" data-id="{{$plant->id}}" data-nombre="{{$plant->nombre}}">
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

@include('plantas.modalDelete')
@include('plantas.modalEdit')
@include('plantas.modalCreate')
@endsection


@section('scripts')
@include('ScriptDataTable')
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
estiloTabla('#datatable');

$(document).ready(function() {

//script para eliminar con modal
$(document).on('click', '.btn-delete', function() {
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
         url: ' plantas/' + id,
         data: {
         },
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        success: function(data){
          toastr.success('Planta Borrada Correractamente!', 'Eliminando Planta', {timeOut: 5000});
          $('#modal-delete').modal('hide');
          $('.item' + id).fadeOut(600);          
          },

          error: function(){
            toastr.error('No se puede borrar la planta porque esta en uso!', 'Eliminando Planta', {timeOut: 5000});
            $('#modal-delete').modal('hide');
            },
    });

});

//editar con modal
$(document).on('click', '.btn-editar', function() { 
         
          id = $(this).data('id');
          fila = $('.item'+id);
          $('#txtPlanta').val(fila.find('#nombre').text());
         // alert('se capturo la planta '+id );
          $('#modalEditPlanta').modal('show');
          //$('#txtPlanta').focus();
          
        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'plantas/' + id,
                data: {                    
                    'id': id,
                    'nombre': $('#txtPlanta').val(),                   
                },
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                  
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Algo ha salido mal!', 'alerta de Error', {timeOut: 5000});
                        }, 500);
                        
                    } else {
                        $('#modalEditPlanta').modal('hide');
                        //alert('valor del data antes de editar: '+ boton.data('planta'));
                        //setea en valor editado en la tablar cargada
                        fila.find("#nombre").text(data.nombre);  
                       // boton.data('planta', data.nombre);
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
