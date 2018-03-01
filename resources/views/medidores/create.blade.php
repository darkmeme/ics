@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-lg-6 col-xs-12 ">
    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!!Form::open(array('url'=>'medidores','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

      <h3 class="header smaller lighter blue">Ingresar Nueva Lectura</h3>
</div>
  </div>

  <div class="container">


<div class="row">
  <div class="col-lg-5">
    <div class="form-group">
      <label for="nombre">Nsd 220</label>
      <input type="text" name="nsd_220" class="form-control"  required>
    </div>

    <div class="form-group">
      <label for="nombre">Nsd 480</label>
      <input type="text" name="nsd_480" class="form-control"  required>
    </div>

    <div class="form-group">
      <label for="nombre">Blanqueo</label>
      <input type="text" name="blanqueo" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Calderas</label>
      <input type="text" name="calderas" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Sulfonacion</label>
      <input type="text" name="sulfonacion" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Oficinas</label>
      <input type="text" name="oficinas" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Daf</label>
      <input type="text" name="daf" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Comby</label>
      <input type="text" name="comby" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Saponificacion</label>
      <input type="text" name="saponificacion" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Enee Principal</label>
      <input type="text" name="enee_principal" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Enee Reactivo</label>
      <input type="text" name="enee_reactivo" class="form-control" placeholder="" required>
    </div>

    <div class="form-group">
      <label for="nombre">Factor de Potencia</label>
      <input type="text" name="fp" class="form-control" placeholder="" required>
    </div>



    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/equipos"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>

  </div>
</div>
    {!!Form::close()!!}
</div>
</div>
</div>
@stop
