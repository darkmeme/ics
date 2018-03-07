@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Eventos</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/eventos/create"><button class="btn btn-info" type="button">Nueva<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Eventos"
    </div>

      <table class="table text-center table-striped table-hover" id="table-eventos">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Opciones</th>
        </thead>

        @foreach ($eventos as $evento)
        <tr>
          <td>{{$evento->id}}</td>
          <td>{{$evento->nombre}}</td>
          <td>

            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('EventosController@edit',$evento->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('borrar')
              <a class="red" href=""data-target="#modal-delete-{{$evento->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
@include('eventos.modal')
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('scripts')

@endsection
