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

    {!!Form::open(array('url'=>'categorias','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
      <h3 class="header smaller lighter blue">Crear Nueva Categoria</h3>

    <div class="card">
    <div class="card-body">

    <div class="form-group">
      <label for="nombre">Categoria</label>
      <input type="text" name="categoria" class="form-control" placeholder="Categoria..." required>
    </div>


    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar
        <i class="fa fa-check"></i>
      </button>
      <a href="/categorias"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>
  </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@stop
