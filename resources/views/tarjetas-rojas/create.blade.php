@extends('layouts.admin')
@section('contenido')
{!!Form::open(array('url'=>'tarjetas-rojas','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<style media="screen">
.amarillo{ background-color:red;}
.color-etiquetas{ background-color:green;}

.modal-right {
  position: absolute;
  top: 100px;
  right: 0;
  bottom: 0;
  left: 1200px;
  z-index: 10040;
  overflow: auto;
  overflow-y: auto;
}
</style>

<div class="col-lg-1"></div>
    <div class="col-xs-8 col-md-12 col-lg-6 amarillo">

      <div class="row">
      <div class="col-lg-6 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Planta</label>
          <select class="form-control" id="select-planta" required name="planta_id">
            <option value="">Seleccione Planta</option>
            @foreach ($plantas as $p)
            <option value="{{$p->id}}">{{$p->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>

    <div class="col-lg-6 col-md-10 col-xs-12">
      <div class="form-group">
        <label for="nombre">Area/Linea</label>
        <select class="form-control" id="select-area" name="area_id" required>
          {{--Este select se llena automatico desde jquery--}}
        </select>
      </div>
    </div>
</div>

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Equipo</label>
        <select class="form-control" id="select-equipos" name="equipo_id" required>

      {{--Este select se llena automatico desde jquery--}}
        </select>
      </div>
    </div>


    <div class="row">
    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        {{--<input id="txtfiltrar" type="text" name="empleado_id" class="form-control" placeholder="usuario">--}}


           <select class="form-control" id="txtfiltrar" name="empleado_id" required>
            <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>

          </select>

      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Turno</label>
        <select class="form-control" name="turno" required placeholder="1">
          <option value="">Seleccione Turno</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Prioridad</label>
        <select class="form-control" name="prioridad" required placeholder="1">
          <option value="">Seleccione Prioridad</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>
      </div>
    </div>
    </div>


    <div class="row">
    <div class="col-lg-10 col-xs-12 offset-1">
      <div class="color-etiquetas text-center">
        <p>DESCRIPCION DE LA ANOMALIA</p>
      </div>
      </div>
      </div>

      <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="form-group">
          <textarea class="form-control" name="descripcion_reporte" rows="3" required cols="50"></textarea>
        </div>
      </div>
        </div>


        <div class="row">
          <div class="col-xs-10 col-lg-8">
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
          <a href="/tarjetas-rojas"><button class="btn btn-danger" type="button">Regresar<i class="fa fa-times"></i></button></a>
        </div>
        </div>
        </div>

    </div>




{{--</div>--}}
  {!!Form::close()!!}


{{--modal para busqueda de usuarios y llenar tarjeta--}}
<div class="modal fade" id="modal-usuario" tabindex="-1">
  <div class="modal-right">
    <div class="modal-content modal-sm">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Busqueda de Usuarios
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">

            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="busqueda" type="text" class="form-control" placeholder="">
            </div>

            <table id="tabla" class="table">
             <thead>
              <tr>
               <th>Codigo</th>
               <th>Nombre</th>
              </tr>
             </thead>
             <tbody class="buscar" id="contenido">
               {{--se llena automatico desde jquery con peticiones ajax--}}
             </tbody>
            </table>

          </div>
        </div>
      </div>

      <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    </div>
  </div>

</div>
@endsection
@section('scripts')
<script src="{{asset('js/combox.js')}}"></script>

<script type="text/javascript">
 // script para llamar modal de busqueda de usuarios
$(document).ready(function () {

      //funcion para abrir modal cuando se da click en select de empleado
 $('#txtfiltrar').click(function () {
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
              // se genera un option con los valores de la fila seleccionada y se cargan al select de tarjetas
              //html_select += '<option value="'+id+'">'+nombre+'</option>';
              //$('#txtfiltrar').html(html_select);
              textbox = $('#txtfiltrar');
              textbox.val(nombre);
              textbox.attr('placeholder', id);
              // se cierra el modal despues de cargar los datos al select
              $('#modal-usuario').modal('hide');
             alert('probando captura de dat ' +textbox.val()+' '+textbox.attr(placeholder));
               });
});//finaliza document ready
  </script>

@endsection
