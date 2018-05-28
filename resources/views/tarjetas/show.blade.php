@extends('layouts.admin')
@section('contenido')
<br>
<div class="col-lg-1 col-md-0 col-xs-0">

</div>
<div class="row">
<div class="container">
<div class="col-xs-10">
  <div class="panel panel-primary">
    <div class="panel-heading">Detalle de Tarjetas</div>
      <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h3 class="header smaller lighter blue">Tarjeta No: {{$tarjetas->id}}</h3>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <h5><strong>Status: </strong><span class="blue">{{$tarjetas->status}}</span></h5>
        <h5><strong>Fecha: </strong><span class="blue">{{$tarjetas->created_at}}</span> </h5>
        <h5><strong>Area: </strong><span class="blue">{{$tarjetas->area->nombre}} </span></h5>
        <h5><strong>Planta: </strong><span class="blue">{{$tarjetas->planta->nombre}} </span></h5>
        <h5><strong>Nombre Empleado:</strong><span class="blue">{{$tarjetas->user->name}} </span></h5>
        <h5><strong>Equipo: </strong><span class="blue">{{$tarjetas->equipo->nombre}} </span></h5>
        <h5><strong>Turno: </strong><span class="blue">{{$tarjetas->turno}} </span></h5>
        <h5><strong>Prioridad: </strong><span class="blue">{{$tarjetas->prioridad}} </span></h5>
        <h5><strong>Categoria: </strong><span class="blue">{{$tarjetas->categoria->nombre}}</span> </h5>
        <h5><strong>Evento: </strong><span class="blue">{{$tarjetas->evento->nombre}} </span></h5>
        <h5><strong>Causa: </strong><span class="blue">{{$tarjetas->causa->nombre}} </span></h5>
        <h5><strong>Descripcion del Reporte: </strong><span class="blue">{{$tarjetas->descripcion_reporte}}</span> </h5>
        <h5><strong>Fecha de Cierre: </strong><span class="blue">{{$tarjetas->fecha_cierre}}</span> </h5>
        <h5><strong>Solucion Implementada: </strong><span class="blue">{{$tarjetas->solucion_implementada}}</span> </h5>
        <h5><strong>Asignada A: </strong><span class="blue">{{$tarjetas->asignado->name}}</span> </h5>
        <h5><strong>Realizada por: </strong><span class="blue">{{$tarjetas->terminado->name}} </span></h5>
      </div>
      <div class="col-lg-5 col-xs-12">
<a href=""data-target="#modal-asignar" data-toggle="modal"> <button class="btn btn-info">Reasignar</button></a>
<a href=""data-target="#modal-finalizar" data-toggle="modal"> <button class="btn btn-info">Finalizar</button></a>
<a href="javascript:history.back()"> <button class="btn btn-info">Regresar</button></a>
      </div>
    </div>
</div>

    </div>
</div>
</div>
</div>
{{--modal para asignar la tarjeta a los tecnicos--}}

{{Form::open(array('action'=>array('TarjetasController@asignar',$tarjetas->id),'method'=>'post'))}}
{{Form::token()}}
<div class="modal fade" id="modal-asignar" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Asignar Tarjeta a Empleado
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-10">

            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="busqueda" type="text" class="form-control" >
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

            <select style="visibility:hidden" class="form-control" id="user-selected" name="empleado_id" class="form-control">
              {{--se llena desde jquery--}}
            </select>
          </div>
          <div class="col-xs-1" id="imagen">

          </div>
        </div>
      </div>

      <div class="modal-footer no-margin-top">
        <button type="submit" class="btn btn-sm btn-success pull-left">
          <i class="ace-icon fa fa-check"></i>
          Asignar
        </button>
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    </div>
  </div>
</div>
  {{Form::Close()}}





  {{--modal para finalizar la tarjeta--}}

  {{Form::open(array('action'=>array('TarjetasController@finalizar',$tarjetas->id),'method'=>'post'))}}
  {{Form::token()}}
  <div class="modal fade" id="modal-finalizar" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header no-padding">
          <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <span class="white">&times;</span>
            </button>
            Finalizar Tarjeta
          </div>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-10">

              <div class="input-group">
                <span class="input-group-addon">Buscar</span>
                <input id="busqueda-user" type="text" class="form-control">
              </div>

              <table id="tabla-finalizar" class="table">
               <thead>
                <tr>
                 <th>Codigo</th>
                 <th>Nombre</th>
                </tr>
               </thead>
               <tbody class="buscar" id="contenido-user">
                 {{--se llena automatico desde jquery con peticiones ajax--}}
               </tbody>
              </table>

              <select class="form-control" id="empleado" name="user_finaliza" class="form-control">
                <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                {{--se llena automatico desde jQuery--}}
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-10 col-xs-12">
              <div class="form-group">
                <label for="nombre">Describa la solucion</label>
                <textarea class="form-control" name="solucion" rows="3" required cols="50"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer no-margin-top">
          <button type="submit" class="btn btn-sm btn-success pull-left">
            <i class="ace-icon fa fa-check"></i>
            Finalizar
          </button>
          <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
            <i class="ace-icon fa fa-times"></i>
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
    {{Form::Close()}}
    <style media="screen">
      .resaltar-fila {background-color: #8FBC8F}
    </style>
@endsection




@section('scripts')
<script type="text/javascript">

 // script para llamar modal de busqueda de usuarios
$(document).ready(function () {
//cuando se presiona una tecla sobre input de busqueda se hace una peticion ajax con filtro
        $("#busqueda").keyup(function(e){
          //obtenemos el texto introducido en el campo de búsqueda
          var consulta = $("#busqueda").val();
  // se hace la peticion ajax al servidor 
     $.ajax({
    url: "/list-users/"+ consulta,
    type: 'get',
    dataType: 'JSON',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    beforeSend: function(){
      //imagen de carga
      $("#imagen").html("<p align='center'><img src='/images/loader.gif' /></p>");
                    },
    error: function(){
      //  alert("Error en la petición ajax");
            },
    success: function (data) {
      /* Inicializamos la tabla */
              $("#contenido").html('');
              $("#imagen").html('');
  // se recorre la variable data para pasarlo a la tabla
          $.each(data, function(index, value){
  $("#contenido").append("<tr class=fila><td class=id>" + value.id + "</td><td class=nombre>" + value.name + "</tr>")});
}
}); //finaliza la peticion ajax
});//finaliza evento keyup de input de busqueda

//funcion para cargar los datos de la fila seleccionada al objeto select de html
               $('#tabla').on('click','tr td', function(evt){
                 $(this).addClass("resaltar-fila");
              var nombre,id,html_select;
              //se recorre el tr padre luego se busca el td con el nombre id
              id = $(this).parents("tr").find(".id").html();
              nombre= $(this).parents("tr").find(".nombre").html();
              // se genera un option con los valores de la fila seleccionada y se cargan al select de tarjetas
              html_select += '<option value="'+id+'">'+nombre+'</option>';
              $('#user-selected').html(html_select);
               });
});//finaliza document ready
  </script>


  <script type="text/javascript">
   // script para llamar modal de busqueda de usuarios
  $(document).ready(function () {
  //cuando se presiona una tecla sobre input de busqueda se hace una peticion ajax con filtro
          $("#busqueda-user").keyup(function(e){
            //obtenemos el texto introducido en el campo de búsqueda
            var consulta = $("#busqueda-user").val();
    // se hace la peticion ajax al server
       $.ajax({
      url: '/list-users/'+consulta+'/',
      //data: consulta,
      type: 'get',
      dataType: 'JSON',
      beforeSend: function(){
        //imagen de carga
      //  $("#resultado").html("<p align='center'><img src='/images/loader.gif' /></p>");
                      },
      error: function(){
        //  alert("Error en la petición ajax");
              },
      success: function (data) {
        /* Inicializamos la tabla */
                $("#contenido-user").html('');
    // se recorre la variable data para pasarlo a la tabla
            $.each(data, function(index, value){
    $("#contenido-user").append("<tr><td class=id>" + value.id + "</td><td class=nombre>" + value.name + "</tr>")});
  }
  }); //finaliza la peticion ajax
  });//finaliza evento keyup de input de busqueda

  //funcion para cargar los datos de la fila seleccionada al objeto select de html
                 $('#tabla-finalizar').on('click','tr td', function(evt){
                var nombre,id,html_select;
                //se recorre el tr padre luego se busca el td con el nombre id
                id = $(this).parents("tr").find(".id").html();
                nombre= $(this).parents("tr").find(".nombre").html();
                // se genera un option con los valores de la fila seleccionada y se cargan al select de tarjetas
                html_select += '<option value="'+id+'">'+nombre+'</option>';
                $('#empleado').html(html_select);
                 });
  });//finaliza document ready
    </script>
@endsection
