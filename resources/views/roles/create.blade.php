@extends('layouts.admin')
@section('contenido')

<div class="row">
  <p></p>
</div>
<div class="row">
<div class="col-lg-6 col-xs-12 offset-3">

    {!!Form::open(array('url'=>'roles','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="card">
    <div class="card-header">Agregar Nuevo Rol</div>
    <div class="card-body">
      @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif

    <div class="form-group">
      <label for="nombre">Nombre del Rol</label>
      <input type="text" name="rol" class="form-control" placeholder="Rol...">
    </div>


    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/roles"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>

</div>
</div>
    {!!Form::close()!!}
</div>
</div>
@stop
