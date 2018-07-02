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
      Lista de Plantas"
    </div>

      <table class="table text-center table-striped table-hover" id="table-plantas">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($plantas as $plant)
        <tr class="item{{$plant->id}}">
          <td>{{$plant->id}}</td>
          <td><div id="nombre{{$plant->id}}">{{$plant->nombre}}</div></td>
          <td>
          <a class="btn btn-link" href="{{URL::action('PlantasController@show',$plant->id)}}">
                <i class="ace-icon fa fa-eye bigger-200"></i>
              </a>              
              <button class="btn btn-link btn-editar" data-id="{{$plant->id}}" data-planta="{{$plant->nombre}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
                </button>
                @can('Borrar')
              <button class="btn btn-link btn-delete" data-id="{{$plant->id}}" data-nombre="{{$plant->nombre}}">       
                <i class="ace-icon fa fa-trash-o bigger-200" style="color: red;"> </i>
                </button>  
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
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#table-plantas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Plantas.',
          "filename": 'Reporte de plantas',
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

} );//termina document ready

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
         // editar = editado;
          $('#txtPlanta').val($(this).data('planta'));
         // alert('se capturo la planta '+id );
          $('#modalEditPlanta').modal('show');
          //$('#txtPlanta').focus();
          id = $(this).data('id');
          boton = $(this);

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
                        $('#nombre'+data.id).text(data.nombre);  
                        boton.data('planta', data.nombre);
                        //location.reload();    
                       // alert('valor del data despues de editar: '+ boton.data('planta'));                 
                        toastr.success('Se ha Modificado Correctamente!', 'Aviso!', {timeOut: 5000});
                                              
                    }
                }
            });
        });

</script>
@endsection
