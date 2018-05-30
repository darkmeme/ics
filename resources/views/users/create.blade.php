@extends('layouts.admin')
@section('contenido')
<br>
    
    <form class="form-group" method="POST" action="{{ url('users') }}">
    {{ csrf_field() }}
    <div class="col col-lg-9 col-md-9 col-sm-9 col-lg-offset-1 col-sm-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">Agregar Nuevo Usuario</div>
            <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-xs-12 col-sm-6 col-lg-offset-1 col-sm-offset-1">

                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Empleado..." value="{{old('nombre')}}">
                      @if ($errors->has('nombre'))
                      <span class="help-block">
                      <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    </div>

                    <div class="form-group {{ $errors->has('codigo') ? ' has-error' : '' }}">
                      <label for="nombre">Codigo</label>
                      <input type="text" name="codigo" class="form-control" placeholder="Codigo..." value="{{old('codigo')}}" required>
                      @if ($errors->has('codigo'))
                      <span class="help-block">
                      <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                    @endif
                    </div>

                    <div class="form-group">
                      <label for="nombre">Puesto</label>
                      <select class="form-control" name="puesto_id" class="form-control" required>
                        <option value="">Seleccione Puesto</option>
                        @foreach($puestos as $p)
                        <option value="{{$p->id}}">{{$p->nombre}}</option>
                      @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="nombre">Roles</label>
                      <select class="form-control" name="rol_id" class="form-control" >
                        <option value="">Seleccione Rol</option>
                        @foreach($roles as $r)
                        <option value="{{$r->id}}">{{$r->name}}</option>
                      @endforeach
                      </select>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Email..." value="{{old('email')}}">
                      @if ($errors->has('email'))
                      <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">Contraseña</label>
                      <input type="password" name="password" class="form-control" placeholder="Contraseña..." required>
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>

                    <div class="form-group">
                      <label for="password">Confirmar Contraseña</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña..." required>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
                      <a href="/users"><button class="btn btn-danger" type="button">Cancelar<i class="fa fa-times"></i></button></a>
                    </div>
                    </div>
                  </form>
                </div>
             </div>
            </div>
            </div>
@endsection
