@extends('layouts.admin')
@section('contenido')

{!!Form::model($tarjetas,['method'=>'PATCH','route'=>['tarjetas.update',$tarjetas->id]])!!}
{{Form::token()}}
<br>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Editar Tarjeta No: {{$tarjetas->id}}</div>
    <div class="container">
<div class="row">
  <div class="col-lg-3 col-xs-12">
    <div class="form-group">
      <label for="planta">Planta</label>
      <select class="form-control" name="planta_id" class="form-control">
        <option value="{{$tarjetas->planta_id}}">{{$tarjetas->planta->nombre}}</option>
      </select>
    </div>
  </div>

    <div class="col-lg-3 col-xs-12">
      <div class="form-group">
        <label for="area">Area/Linea</label>
        <select class="form-control" name="area_id" class="form-control">
          <option value="{{$tarjetas->area_id}}">{{$tarjetas->area->nombre}}</option>
        </select>
      </div>
    </div>

    <div class="col-lg-3 col-xs-12">
      <div class="form-group">
        <label for="equipo">Equipo:</label>
        <select class="form-control" name="equipo_id" class="form-control">
          <option value="{{$tarjetas->equipo_id}}">{{$tarjetas->equipo->nombre}}</option>
        </select>
      </div>
    </div>

    </div>
    <div class="row">
    <div class="col-lg-3 col-xs-12 offset-1">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <select class="form-control" name="user_id" class="form-control">
          <option value="{{$tarjetas->user_id}}">{{$tarjetas->user->name}}</option>
        </select>
      </div>
      </div>
      <div class="col-lg-3 col-xs-12">
        <div class="form-group">
          <label for="turno">Turno</label>
          <select class="form-control" name="turno">
            <option value="{{$tarjetas->turno}}">{{$tarjetas->turno}}</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="form-group">
          <label for="prioridad">Prioridad</label>
          <select class="form-control" name="prioridad">
            <option value="$tarjetas->prioridad}}">{{$tarjetas->prioridad}}</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-control" name="categoria">
          <option value="{{$tarjetas->categoria_id}}">{{$tarjetas->categoria->nombre}}</option>
        </select>
      </div>
    </div>
    </div>

      <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="form-group">
        <label for="evento">Evento</label>
        <select class="form-control" name="evento">
          <option value="{{$tarjetas->evento_id}}">{{$tarjetas->evento->nombre}}</option>
        </select>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="form-group">
        <label for="nombre">Causa del evento</label>
        <select class="form-control" name="causa">
          <option value="{{$tarjetas->causa_id}}">{{$tarjetas->causa->nombre}}</option>
        </select>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-10 offset-1">
      <div class="color-etiquetas text-center">
        <p>DESCRIPCION DE LA ANOMALIA</p>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <textarea name="descripcion_reporte" rows="5" cols="100">{{$tarjetas->descripcion_reporte}}</textarea>
        </div>
      </div>
    </div>


      <button type="button" class="btn btn-default"> Cerrar</button>
      <button type="submit" class="btn btn-primary">Confirmar</button>
          </div>
      </div>
  </div>
  {!!Form::close()!!}
@endsection
