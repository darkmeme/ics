@extends('layouts.admin')
@section('contenido')


    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {!!Form::model($user,['method'=>'PATCH','route'=>['users.update',$user->id]])!!}
    {{Form::token()}}
    <div class="row">
      <div class="col col-lg-2 col-lg-offset-1">

      </div>
      <div class="col-lg-6">
        <h3 class="blue">Perfil de Usuario: {{auth::user()->name}}</h3>
      </div>
    </div>
<div class="container-fluid">
<div class="row">
  <div class="col-lg-6 col-xs-12 offset-3">

      <h5><strong>Nombre: </strong><span class="blue">{{ $user->name}}</span></h5>
      <h5><strong>codigo: </strong><span class="blue">{{ $user->codigoempleado}}</span></h5>
      <h5><strong>Email: </strong><span class="blue">{{ $user->email}}</span></h5>
      <h5><strong>Puesto: </strong><span class="blue">{{ $user->puesto->nombre}}</span></h5>
      <br>
      <a href=""data-target="#modal-editar-user" data-toggle="modal"> <button class="btn btn-info">Editar Perfil</button></a>




    <div class="modal fade" id="modal-editar-user" tabindex="-1">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header no-padding">
            <div class="table-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <span class="white">&times;</span>
              </button>
              Editar Perfil de Usuario
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-10">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" name="nombre" class="form-control" value="{{$user->name}}" required>
                </div>

                <div class="form-group">
                  <label for="nombre">Codigo</label>
                  <input type="text" name="codigo" class="form-control" value="{{$user->codigoempleado}}" required>
                </div>

                <div class="form-group">
                  <label for="nombre">Puesto</label>
                  <select class="form-control" name="puesto_id" class="form-control" required>
                    <option value="{{$user->puesto_id}}">{{$user->puesto->nombre}}</option>
                    @foreach($puestos as $p)
                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                   @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                </div>

              </div>
            </div>
          </div>

          <div class="modal-footer no-margin-top">
            <button type="submit" class="btn btn-sm btn-success pull-left">
              <i class="ace-icon fa fa-check"></i>
              Guardar
            </button>
            <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
              <i class="ace-icon fa fa-times"></i>
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
</div>
    {!!Form::close()!!}
</div>
</div>
@endsection
