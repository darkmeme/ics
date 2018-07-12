

<script type="text/javascript">
//script para setear opcion actual del navbar
$(document).ready(function() {
 $('#actual').addClass('active');
});
</script>


<script type="text/javascript">
  
  //funcion para editar y eliminar con modal y peticion ajax
  //ruta='tarjetas/' 
  //o
  //ruta='tarjetas-rojas/'

function operacionesDE(ruta){

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
      url: ruta + id,
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
              fila.find("td:eq(7)").html(desc);
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
url: ruta + id,
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

}//fin de la funcion operaciones

  

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
