@extends('layouts.admin')
@section('contenido')


    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!!Form::open(array('url'=>'users','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="row">
      <div class="col col-lg-3 col-lg-offset-1">

      </div>
      <div class="col-lg-3">
        <h3 class="blue">Agregar Nuevo Usuario</h3>
      </div>
    </div>
<div class="container-fluid">
<div class="row">
  <div class="col-lg-6 col-xs-12 offset-3">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" placeholder="Empleado..." required>
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
        <option value="{{$r->id}}">{{$r->name}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email..." required>
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" name="password" class="form-control" placeholder="Contraseña..." required>
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/users"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@endsection
