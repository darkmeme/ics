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


    {!!Form::open(array('url'=>'areas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <h3 class="header smaller lighter blue">Crear Nueva Area</h3>

    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="areas" class="form-control" placeholder="Nombre..." required>
    </div>

    <div class="form-group">
      <label for="nombre">Planta</label>
      <select class="form-control" name="planta_id" id="select-planta" class="form-control" placeholder="Planta..." required>
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Sub Area</label>
      <select class="form-control" name="subArea" class="form-control" id="select-area">


      </select>
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/areas"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/combox.js')}}"></script>
@endsection


{{--
formulario con html
<form action="lists" method="post" id="store-form">

</form>
--}}
