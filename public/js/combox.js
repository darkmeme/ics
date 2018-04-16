//funcion java script para llenar un select cuando cambia el valor del otro select
// en la vista create de tarjetas

$(function () {
  $('#select-planta').on('change', selectPlantaChange);
});

function selectPlantaChange() {
  var planta_id = $(this).val();

  //peticion ajax
  $.get('/planta/'+planta_id+'/areas',function (data)
  {
    var html_select='<option value="">Seleccione Area';
    for(var i=0; i<data.length; ++i)
    html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
    //pasar los datos al segundo select cuando se cambia el valor del primero
    $('#select-area').html(html_select);
  });
}


//peticion ajax para llenar equipos por medio de areas en vista de create tarjetas
$(function () {
  $('#select-area').on('change', selectAreaChange);
});
function selectAreaChange() {
var area_id = $(this).val();
$.get('/area/'+area_id+'/equipos',function (data) {

  var html_select_equipos='<option value="">Seleccione Equipo';
  for(var i=0; i<data.length; ++i)
  html_select_equipos += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
  //pasar los datos al segundo select cuando se cambia el valor del primero
  $('#select-equipos').html(html_select_equipos);
});
}


// funcion para llamar a los equipos padres
$(function () {
  $('#select-area').on('change', selectArea_equipoChange);
});

function selectArea_equipoChange() {
var area_id = $(this).val();
//alert(area_id);
$.get('/area/'+area_id+'/equiposPadres',function (data) {

  var html_select_equiposPadres='<option value="">Seleccione Equipo';
  for(var i=0; i<data.length; ++i)
  html_select_equiposPadres += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
  //pasar los datos al segundo select cuando se cambia el valor del primero
  $('#select-create-equipos').html(html_select_equiposPadres);
});
}
