
<script type="text/javascript">
// script para hacer la busqueda de usuarios
function buscarUsuario(txtBusqueda, setImg, tbodyId, tabla, txtNombre, txtId){
    $(document).ready(function () {
  //cuando se presiona una tecla sobre input de busqueda se hace una peticion ajax con filtro
  txtBusqueda.keyup(function(e){
            //obtenemos el texto introducido en el campo de búsqueda
            var consulta = txtBusqueda.val();
    // se hace la peticion ajax al servidor 
       $.ajax({
      url: "/list-users/"+ consulta,
      type: 'get',
      dataType: 'JSON',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      beforeSend: function(){
        //imagen de carga
        setImg.html("<p align='center'><img src='/images/loader.gif' /></p>");
                      },
      error: function(){
        //  alert("Error en la petición ajax");
              },
      success: function (data) {
        /* Inicializamos la tabla */
        tbodyId.html('');
                setImg.html('');
    // se recorre la variable data para pasarlo a la tabla
            $.each(data, function(index, value){
              tbodyId.append("<tr class=fila><td class=id>" + value.id + "</td><td class=nombre>" + value.name + "</tr>")});
  }
  }); //finaliza la peticion ajax
  });//finaliza evento keyup de input de busqueda
  
  //funcion para cargar los datos de la fila seleccionada al objeto select de html
                tabla.on('click','tr td', function(evt){
                  if($(this).hasClass("resaltar-fila")){
                    $(this).removeClass("resaltar-fila")
                  }else{
                    $(this).addClass("resaltar-fila");
                  }
                   
                var nombre,id;
                //se recorre el tr padre luego se busca el td con el nombre id
                id = $(this).parents("tr").find(".id").html();
                nombre= $(this).parents("tr").find(".nombre").html();
                // se genera un option con los valores de la fila seleccionada y se cargan al select de tarjetas
                txtNombre.val(nombre);
                txtId.val(id);
                 });
  });//finaliza document ready
  
  } //fin de la funcion principal de busqueda usuario

  </script>
  