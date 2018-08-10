
<style media="screen">
.amarillo{ background-color:#FAFAD2;}
.rojo{ background-color:#CD5C5C;}

.modal-right {
  position: absolute;
  top: 100px;
  right: 0;
  bottom: 0;
  left: 1250px;
  z-index: 10040;
  overflow: auto;
  overflow-y: auto;
}

#mediano{
      width: 45% !important;
    }
</style>

<script src="{{asset('js/combox.js')}}"></script>

<script type="text/javascript">
//seccion de scripts para modal crear tarjetas rojas
 // script para llamar modal de busqueda de usuarios
$(document).ready(function () {

    //funcion para abrir modal crear
$('.link-crear').click(function (){
  $('#crear-tarjeta').modal('show');
});

      //funcion para abrir modal cuando se da click en boton de empleado
$('.btnUser').click(function () {
$('#modal-usuario').modal('show');
});// finaliza funcion para abrir modal

//cuando se presiona una tecla sobre input de busqueda se hace una peticion ajax con filtro
        $("#busqueda").keyup(function(e){
          //obtenemos el texto introducido en el campo de búsqueda
          var consulta = $("#busqueda").val();
  // se hace la peticion ajax al server
     $.ajax({
    url: '/list-users/'+consulta+'/',
    //data: consulta,
    type: 'get',
    dataType: 'JSON',
    beforeSend: function(){
      //imagen de carga
      $("#resultado").html("<p align='center'><img src='/images/loader.gif' /></p>");
                    },
    error: function(){
      //  alert("Error en la petición ajax");
            },
    success: function (data) {
      /* Inicializamos la tabla */
              $("#contenido").html('');
  // se recorre la variable data para pasarlo a la tabla
          $.each(data, function(index, value){
  $("#contenido").append("<tr><td class=id>" + value.id + "</td><td class=nombre>" + value.name + "</tr>")});
}
}); //finaliza la peticion ajax
});//finaliza evento keyup de input de busqueda

//funcion para cargar los datos de la fila seleccionada al objeto select de html
               $('#tabla').on('click','tr td', function(evt){
              var nombre,id;
              //se recorre el tr padre luego se busca el td con el nombre id
              id = $(this).parents("tr").find(".id").html();
              nombre= $(this).parents("tr").find(".nombre").html();
              //se setean datos en los textbox 
              $('#txtfiltrar').val(nombre);
              //id seteado en un textbox oculto
              $('.txtHidden').val(id);              
              // se cierra el modal despues de cargar los datos los input text
              $('#modal-usuario').modal('hide');
              
               });
});//finaliza document ready
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
             
              fila.find(".pri").text(prioridad);
              fila.find(".des").text(desc);
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

//funcnion para cargar estilo y botones de jQuery DataTable

function estiloTabla(id){

$(document).ready(function() {

var table = $(id).DataTable({
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

} //fin de la funcion principal

</script>
