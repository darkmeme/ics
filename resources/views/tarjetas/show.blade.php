@extends('layouts.admin')
@section('contenido')
<br>
<div class="col-lg-1 col-md-0 col-xs-0">

</div>
<div class="row">
<div class="container">
<div class="col-xs-10">
  <div class="panel panel-primary">
    <div class="panel-heading">Detalle de Tarjetas Amarillas</div>
      <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h3 class="header smaller lighter blue">Tarjeta No: {{$tarjetas->id}}</h3>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-4 col-xs-12">
        <h5><strong>Status: </strong><span class="blue">{{$tarjetas->status}}</span></h5>
        <h5><strong>Fecha: </strong><span class="blue">{{$tarjetas->created_at->format('d-m-Y')}}</span> </h5>
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
        <h5><strong>Fecha de Cierre: </strong><span class="blue">
        @if(isset($tarjetas->fecha_cierre))
            {{date('d-m-Y', strtotime($tarjetas->fecha_cierre))}}  
          @else No Finalizada                  
          @endif
        </span> </h5>
        <h5><strong>Solucion Implementada: </strong><span class="blue">
        @if(isset($tarjetas->solucion_implementada))
            {{$tarjetas->solucion_implementada}} 
          @else No Finalizada                    
          @endif
        </span> </h5>
        <h5><strong>Responsable: </strong><span class="blue">{{$tarjetas->asignado->name}}</span> </h5>           
        <h5><strong>Reasignada A: </strong><span class="blue">
        @if(isset($tarjetas->reasignado->name))
            {{$tarjetas->reasignado->name}} 
          @else Sin Reasignar                    
          @endif
        </span> </h5>
        <h5><strong>Motivo Reasignacion: </strong><span class="blue">
        @if(isset($tarjetas->motivo_reasignado))
            {{$tarjetas->motivo_reasignado}} 
          @else N/A                   
          @endif
        </span> </h5>
        <h5><strong>Finalizada por: </strong><span class="blue">
        @if(isset($tarjetas->terminado->name))
            {{$tarjetas->terminado->name}} 
          @else No Finalizada                  
          @endif
        </span></h5>
      </div>
      <div class="col-lg-5 col-xs-12">
      <div class="row">
      <a href=""data-target="#modal-responsable" data-toggle="modal"> <button class="btn btn-info">Cambiar Responsable</button></a>
      <a href=""data-target="#modal-asignar" data-toggle="modal"> <button class="btn btn-info">Reasignar</button></a>
      <a href=""data-target="#modal-finalizar" data-toggle="modal"> <button class="btn btn-info">Finalizar</button></a>
      <a href="javascript:history.back()"> <button class="btn btn-info">Regresar</button></a>
      </div>
      <div class="row">
      <br>
      {{--se setea atributo href a la etiqueta a mediante Jquery--}}
      <a class="link" href="" target="_blank">  
      <img class="img" src="@if(isset($tarjetas->ruta_foto)) {{asset('img/'.$tarjetas->id.'.'.$tarjetas->ruta_foto)}} @else {{asset('img/noimg.png')}} @endif" style="max-width:100%;width:auto;height:auto;">
      </a>      
      </div> 
      </div>
    </div>
</div>

    </div>
</div>
</div>
</div>
{{--modal para reasignar la tarjeta a los tecnicos--}}

{{Form::open(array('action'=>array('TarjetasController@asignar',$tarjetas->id),'method'=>'post'))}}
{{Form::token()}}
<div class="modal fade" id="modal-asignar" tabindex="-1">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Reasignar Tarjeta a Empleado
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col col-lg-6 col-md-6 col-sm-6">

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
            <input id="user-selected" type="text" placeholder="Busque y seleccione un empleado" class="form-control" required readonly>
            <input id="txtHidden" type="text" name="empleado_id" hidden>
             
          </div>
          <div class="col-xs-1" id="imagen">

          </div>          
          <div class="col col-lg-4 col-md-4 col-sm-4">
          <div class="input-group">
          <label for="nombre">Motivo de Reasignacion</label>
          <textarea name="motivo" class="motivo-reasignacion" rows="5" cols="18"></textarea>
          </div>
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



{{--modal para cambiar de responsable--}}

{{Form::open(array('action'=>array('TarjetasController@cambiarResponsable',$tarjetas->id),'method'=>'post'))}}
{{Form::token()}}
<div class="modal fade" id="modal-responsable" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Cambiar Responsable de Tarjeta
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col col-lg-10">

            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="busquedaCambiar" type="text" class="form-control" >
            </div>

            <table id="tablaCambiar" class="table">
             <thead>
              <tr>
               <th>Codigo</th>
               <th>Nombre</th>
              </tr>
             </thead>
             <tbody class="buscar" id="conteCambiar">
               {{--se llena automatico desde jquery con peticiones ajax--}}
             </tbody>
            </table>
            <input id="empleCambiar" type="text" placeholder="Busque y seleccione un empleado" class="form-control" required readonly>
            <input id="txt-id" type="text" name="empleado_id" hidden>
            
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
            <div class="col-lg-10 col-xs-12">

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
              <input id="empleado" type="text" placeholder="{{Auth::user()->name}}" class="form-control" required readonly>
              <input id="txt-fin" type="text" value="{{Auth::user()->id}}" name="user_finaliza" hidden>
              
            </div>
            <div class="col-lg-2" id="imagenR">
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
@include('buscarUser')

<script type="text/javascript">
//script para setear enlace de imagen para poder abrir la imagen en otra pestaña
$(document).ready(function(){

 var ruta = $(".img").attr("src");
 $(".link").attr("href", ruta);

});

</script>

<script type="text/javascript">

 // script para buscar usuario en modal Reasignar
 var txtbuscar=$("#busqueda");
 var img=$("#imagen");
 var tbody=$("#contenido");
 var tab=$('#tabla');
 var combo=$('#user-selected');
 var txtId=$('#txtHidden');

  buscarUsuario(txtbuscar, img, tbody, tab, combo, txtId);

  </script>


  <script type="text/javascript">
   //script para buscar usuario en modal de Finalizar Tarjeta 

  var txtBusca=$("#busqueda-user");
  var imagen=$("#imagenR");
  var tabBody=$("#contenido-user");
  var table=$('#tabla-finalizar');
  var txtNombre=$('#empleado');
  var txtId=$('#txt-fin');

  buscarUsuario(txtBusca, imagen, tabBody, table, txtNombre, txtId);
   
    </script>


<script type="text/javascript">
   
   //script para buscar usuario en modal para cambiar responsable de tarjeta asignada
   var txtBusca=$("#busquedaCambiar");
   var imagen=$("#imagenC");
   var tabBody=$("#conteCambiar");
   var table=$('#tablaCambiar');
   var txtNombre=$('#empleCambiar');
   var txtId=$('#txt-id');

   buscarUsuario(txtBusca, imagen, tabBody, table, txtNombre, txtId);
   
    </script>

@endsection
