@extends('layouts.admin')
@section('contenido')

<div class="row">
  <p></p>
</div>

<div class="row">
<div class="col-lg-6 col-xs-12 offset-3">
    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!!Form::open(array('url'=>'empleados','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="card">
    <div class="card-header">Agregar Nuevo Empleado</div>
    <div class="card-body">

    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="empleado" class="form-control" placeholder="Empleado..." required>
    </div>

    <div class="form-group">
      <label for="nombre">Codigo</label>
      <input type="text" name="codigo" class="form-control" placeholder="Codigo..." required>
    </div>

    <div class="form-group">
      <label for="nombre">Puesto</label>
      <select class="form-control" name="puesto_id" class="form-control" required>
        <option value="">Seleccione Puesto</option>
        @foreach($puestos as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Roles</label>
      <select class="form-control" name="rol_id" class="form-control" >
        <option value="">Seleccione Rol</option>
        @foreach($roles as $r)
        <option value="{{$r->id}}">{{$r->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" class="form-control" placeholder="Email..." required>
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="text" name="password" class="form-control" placeholder="Contraseña..." required>
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/empleados"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>
    </div>
  </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@stop
