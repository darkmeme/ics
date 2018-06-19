@extends('layouts.admin')
@section('contenido')
<div class="row" id="Equipos">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Equipos</h3>
    <div class="clearfix">
      <div class="tableTools-container">
        <div class="row">
        <div class="col-lg-2">
          <a href="/equipos/create"><button class="btn btn-info" type="button">Nuevo<i class="fa fa-plus"></i></button></a>
        </div>
        </div>
      </div>
    </div>

    <div class="table-header">
      Lista de Equipos"
    </div>

<div class="table-responsive">
      <table class="table text-center table-striped table-hover" id="table-equipos">
        <thead>
          <th class="text-center">Id</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Area</th>
          <th class="text-center">Padre</th>
          <th class="text-center" WIDTH="100">Opciones</th>
        </thead>

        
        <tr v-for="e in equipos">
          <td>@{{e.id}}</td>
          <td>@{{e.nombre}}</td>
          <td>@{{e.area.nombre}}</td>
          <td>
            <div class="action-buttons">
              <a class="green">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @can('Borrar')
              <a class="red" href="" v-on:click.prevent="deleteEquipos"(e)>
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
      </table>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script src="{{asset('js/app.js')}}">//script para llamar a vue js</script>
@endsection
