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

    {!!Form::open(array('url'=>'equipos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

      <h3 class="header smaller lighter blue">Crear Nuevo Equipo</h3>


    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="equipo" class="form-control" placeholder="Nombre..." required>
    </div>

    <div class="form-group">
      <label class="">Seleccione si es un equipo principal</label>
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" name="combo-padre" value="1" type="checkbox"> Padre
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="nombre">Planta</label>
      <select class="form-control" id="select-planta" name="planta_id" class="form-control">
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Areas</label>
      <select class="form-control" id="select-area" name="area_id" class="form-control">
      {{--se llena automatico desde jquey al seleccionar planta--}}
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Equipo Principal</label>
      <select class="form-control" id="select-create-equipos" name="equipo_id" class="form-control">
      {{--se llena automatico desde jquey al seleccionar planta--}}
      </select>
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
@stop

@section('scripts')
<script src="{{asset('js/combox.js')}}"></script>
@endsection
