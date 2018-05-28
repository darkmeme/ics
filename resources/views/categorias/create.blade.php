@extends('layouts.admin')
@section('contenido')
<br>
<div class="container">
<br>
  <div class="col-lg-8 col-xs-12 col-md-8 col-lg-offset-2 col-md-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">Crear Nueva Categoria</div>
          <div class="container">
            <div class="col-lg-6 col-xs-12 col-sm-6 col-md-6">

 {!!Form::open(array('url'=>'categorias','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <br>
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
    {!!Form::close()!!}
           </div>
          </div>
        </div>
      </div>
  </div>
@endsection
