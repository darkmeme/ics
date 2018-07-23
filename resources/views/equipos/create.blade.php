@extends('layouts.admin')
@section('contenido')
<br>
<div class="container">
<br>
<div class="col-lg-8 col-xs-12 col-md-8 col-lg-offset-1 col-md-offset-1">
    <div class="panel panel-primary">
    <div class="panel-heading">Crear Nuevo Equipo</div>
    <div class="container">
    <div class="col-lg-6 col-xs-12 col-md-6 col-sm-8 col-lg-offset-0">
    {!!Form::open(array('url'=>'equipos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="form-group{{ $errors->has('equipo') ? ' has-error' : '' }}">
      <label for="nombre">Nombre</label>
      <input type="text" name="equipo" value="{{old('nsd_220')}}" class="form-control" placeholder="Nombre..." required>
      @if ($errors->has('equipo'))
            <span class="help-block">
                <strong>{{ $errors->first('equipo') }}</strong>
            </span>
        @endif
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
<br>
    <div class="form-group">
      <label for="nombre">Planta</label>
      <select class="form-control" id="select-planta" name="planta_id" class="form-control" required>
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Areas</label>
      <select class="form-control" id="select-area" name="area_id" class="form-control" required>
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
      </div>
    </div>
  </div>
    {!!Form::close()!!}
@endsection

@section('scripts')
<script src="{{asset('js/combox.js')}}"></script>
@endsection
