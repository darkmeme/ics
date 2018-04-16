@extends('layouts.admin')
@section('contenido')

<br>
<div class="container">
<div class="col-lg-10 col-xs-12 col-md-10">
  <div class="panel panel-primary">
    <div class="panel-heading">Ingresar Nueva Lectura de Energia</div>
    <br>
    <div class="container">
      <div class="col-lg-9 col-xs-12 col-md-9">
    {!!Form::open(array('url'=>'medidores','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

<div class="row">
  <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('nsd_220') ? ' has-error' : '' }}">
      <label for="nombre">Nsd 220</label>
      <input type="text" name="nsd_220" class="form-control" value="{{old('nsd_220')}}" required>
        @if ($errors->has('nsd_220'))
            <span class="help-block">
                <strong>{{ $errors->first('nsd_220') }}</strong>
            </span>
        @endif
    </div>
  </div>

  <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('nsd_480') ? ' has-error' : '' }}">
      <label for="nombre">Nsd 480</label>
      <input type="text" name="nsd_480" class="form-control" value="{{old('nsd_480')}}" required>
        @if ($errors->has('nsd_480'))
            <span class="help-block">
                <strong>{{ $errors->first('nsd_480') }}</strong>
            </span>
        @endif
    </div>
  </div>

  <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('blanqueo') ? ' has-error' : '' }}">
      <label for="nombre">Blanqueo</label>
      <input type="text" name="blanqueo" class="form-control" value="{{old('blanqueo')}}" required>
        @if ($errors->has('blanqueo'))
            <span class="help-block">
                <strong>{{ $errors->first('blanqueo') }}</strong>
            </span>
        @endif
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('calderas') ? ' has-error' : '' }}">
      <label for="nombre">Calderas</label>
      <input type="text" name="calderas" class="form-control" value="{{old('calderas')}}" required>
        @if ($errors->has('calderas'))
            <span class="help-block">
                <strong>{{ $errors->first('calderas') }}</strong>
            </span>
        @endif
    </div>
  </div>

    <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('sulfonacion') ? ' has-error' : '' }}">
      <label for="nombre">Sulfonacion</label>
      <input type="text" name="sulfonacion" class="form-control" value="{{old('sulfonacion')}}" required>
        @if ($errors->has('sulfonacion'))
            <span class="help-block">
                <strong>{{ $errors->first('sulfonacion') }}</strong>
            </span>
        @endif
    </div>
    </div>

      <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('oficinas') ? ' has-error' : '' }}">
      <label for="nombre">Oficinas</label>
      <input type="text" name="oficinas" class="form-control" value="{{old('oficinas')}}" required>
        @if ($errors->has('oficinas'))
            <span class="help-block">
                <strong>{{ $errors->first('oficinas') }}</strong>
            </span>
        @endif
    </div>
      </div>
</div>

      <div class="row">
        <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('daf') ? ' has-error' : '' }}">
      <label for="nombre">Daf</label>
      <input type="text" name="daf" class="form-control" value="{{old('daf')}}" required>
        @if ($errors->has('daf'))
            <span class="help-block">
                <strong>{{ $errors->first('daf') }}</strong>
            </span>
        @endif
    </div>
        </div>

          <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('comby') ? ' has-error' : '' }}">
      <label for="nombre">Comby</label>
      <input type="text" name="comby" class="form-control" value="{{old('comby')}}" required>
        @if ($errors->has('comby'))
            <span class="help-block">
                <strong>{{ $errors->first('comby') }}</strong>
            </span>
        @endif
    </div>
          </div>

            <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('saponificacion') ? ' has-error' : '' }}">
      <label for="nombre">Saponificacion</label>
      <input type="text" name="saponificacion" class="form-control" value="{{old('saponificacion')}}" required>
        @if ($errors->has('saponificacion'))
            <span class="help-block">
                <strong>{{ $errors->first('saponificacion') }}</strong>
            </span>
        @endif
    </div>
            </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('enee_principal') ? ' has-error' : '' }}">
      <label for="nombre">Enee Principal</label>
      <input type="text" name="enee_principal" class="form-control" value="{{old('enee_principal')}}" required>
        @if ($errors->has('enee_principal'))
            <span class="help-block">
                <strong>{{ $errors->first('enee_principal') }}</strong>
            </span>
        @endif
    </div>
        </div>

          <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('enee_reactivo') ? ' has-error' : '' }}">
      <label for="nombre">Enee Reactivo</label>
      <input type="text" name="enee_reactivo" class="form-control" value="{{old('enee_reactivo')}}" required>
        @if ($errors->has('enee_reactivo'))
            <span class="help-block">
                <strong>{{ $errors->first('enee_reactivo') }}</strong>
            </span>
        @endif
    </div>
          </div>

            <div class="col-lg-4 col-xs-12 col-md-4">
    <div class="form-group{{ $errors->has('fp') ? ' has-error' : '' }}">
      <label for="nombre">Factor de Potencia</label>
      <input type="text" name="fp" class="form-control" value="{{old('fp')}}" required>
        @if ($errors->has('fp'))
            <span class="help-block">
                <strong>{{ $errors->first('fp') }}</strong>
            </span>
        @endif
    </div>
            </div>
      </div>



    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
      <a href="/medidores"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
    </div>

        </div>
  </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
@endsection
