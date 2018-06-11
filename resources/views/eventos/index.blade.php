@extends('layouts.admin')
@section('contenido')
<br>
<div class="row">
  <div class="col-xs-12">
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
        <button class="btn btn-info"  data-target="#modalCreateEvento" data-toggle="modal">Nueva
            <i class="fa fa-plus"></i></button>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Eventos"
    </div>

      <table class="table text-center table-striped table-hover" id="table-eventos">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </thead>

        @foreach ($eventos as $e)
        <tr>
          <td>{{$e->id}}</td>
          <td>{{$e->nombre}}</td>
          <td>

            <div class="action-buttons">
              <a class="green" data-target="#modal-edit-{{$e->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red" href=""data-target="#modal-delete-{{$e->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
@include('eventos.modalBorrar')
@include('eventos.modalEdit')
        @endforeach
      </table>
    </div>
  </div>
  @include('eventos.modalCreate')
 
@endsection

@section('scripts')

@endsection
