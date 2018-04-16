@extends('layouts.admin')
@section('contenido')

<div class="row">
<div class="col-lg-6 col-xs-12 offset-3">

    {!!Form::open(array('url'=>'areas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <h3 class="header smaller lighter blue">Crear Nueva Area</h3>

    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group {{ $errors->has('planta_id') ? ' has-error' : '' }}">
      <label for="nombre">Planta</label>
      <select class="form-control" name="planta_id" id="select-planta" class="form-control" placeholder="Planta...">
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
        @if ($errors->has('planta_id'))
            <span class="help-block">
                <strong>{{ $errors->first('planta_id') }}</strong>
            </span>
        @endif
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
