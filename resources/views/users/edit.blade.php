@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-6 col-xs-12">
    <h3>Editar Categoria: {{$empleados->Nombre}}</h3>

    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!!Form::model($empleados,['method'=>'PATCH','route'=>['empleados.update',$empleados->id]])!!}
    {{Form::token()}}
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{$empleados->nombre}}">
    </div>

    <div class="form-group">
      <label for="descripcion">Codigo Empleado</label>
      <input type="text" name="codigo" class="form-control" value="{{$empleados->codigoempleado}}">
    </div>

    <div class="form-group">
      <label for="descripcion">Puesto</label>
      <input type="text" name="puesto" class="form-control" value="{{$empleados->puesto}}">
    </div>

    <div class="form-group">
      <label for="descripcion">Rol</label>
      <select class="form-control" name="rol_id" class="form-control">
      <option value="{{$empleados->rol_id}}">{{$empleados->rol->nombre}}</option>
      </select>
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <button class="btn btn-danger" type="cancel">Cancelar</button>
    </div>

    {!!Form::close()!!}
  </div>
</div>
@stop
