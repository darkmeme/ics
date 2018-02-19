@extends('layouts.admin')
@section('contenido')

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

    {!!Form::open(array('url'=>'prioridades','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="card">
    <div class="card-header">Agregar Nueva Prioridad</div>

    <div class="card-body">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="prioridades" class="form-control" placeholder="Prioridad...">
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/prioridades"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
  </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@stop
