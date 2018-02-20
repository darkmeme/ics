@extends('layouts.admin')
@section('contenido')

<div class="col-lg-10 offset-1">
      <div class="row">
        <div class="col-lg-3">
          <h3 class="header smaller lighter blue">Tarjeta No: {{$tarjetas->id}}</h3>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-6 col-xs-12">
        {{--<h5><strong>Asignada a: </strong>{{$tarjetas->user_asignado->name}} </h5>--}}
        <h5><strong>Status: </strong>{{$tarjetas->status}} </h5>
        <h5><strong>Fecha: </strong>{{$tarjetas->created_at}} </h5>
        <h5><strong>Area: </strong>{{$tarjetas->area->nombre}} </h5>
        <h5><strong>Planta: </strong>{{$tarjetas->planta->nombre}} </h5>
        <h5><strong>Nombre Empleado: </strong>{{$tarjetas->user->name}} </h5>
        <h5><strong>Equipo: </strong>{{$tarjetas->equipo->nombre}} </h5>
        <h5><strong>Turno: </strong>{{$tarjetas->turno}} </h5>
        <h5><strong>Prioridad: </strong>{{$tarjetas->prioridad}} </h5>
        <h5><strong>Categoria: </strong>{{$tarjetas->categoria->nombre}} </h5>
        <h5><strong>Evento: </strong>{{$tarjetas->evento->nombre}} </h5>
        <h5><strong>Causa: </strong>{{$tarjetas->causa->nombre}} </h5>
        <h5><strong>Descripcion del Reporte: </strong>{{$tarjetas->descripcion_reporte}} </h5>
        <h5><strong>Fecha de Cierre: </strong>{{$tarjetas->fecha_cierre}} </h5>
        <h5><strong>Solucion Implementada: </strong>{{$tarjetas->solucion_implementada}} </h5>
        <h5><strong>Asignada A: </strong>{{$tarjetas->asignado->name}} </h5>
        <h5><strong>Realizada por: </strong>{{$tarjetas->terminado->name}} </h5>
      </div>

      <div class="col-lg-3 col-xs-12">
<a href=""data-target="#modal-asignar" data-toggle="modal"> <button class="btn btn-info">Reasignar</button></a>
<a href=""data-target="#modal-finalizar" data-toggle="modal"> <button class="btn btn-info">Finalizar</button></a>

      </div>
    </div>
</div>



{{--modal para asignar la tarjeta a los tecnicos--}}

{{Form::open(array('action'=>array('TarjetasController@asignar',$tarjetas->id),'method'=>'post'))}}
{{Form::token()}}
<div class="modal fade" id="modal-asignar" tabindex="-1">
  <div class="modal-dialog">
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

            <label for="nombre">Empleados</label>
            <select class="form-control" id="select-empleado" name="empleado_id" class="form-control">
              <option value="">Seleccione Empleado</option>
              @foreach($user as $u)
              <option value="{{$u->id}}">{{$u->name}}</option>
              @endforeach
            </select>

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
    <div class="modal-dialog">
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
              <label for="nombre">Empleado Finaliza</label>
              <select class="form-control" id="select-empleado" name="user_finaliza" class="form-control">
                <option value="">Seleccione Empleado</option>
                @foreach($user as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
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
@endsection
