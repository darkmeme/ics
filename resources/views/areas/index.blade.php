@extends('layouts.admin')
@section('contenido')



<div class="row">
<div class="col-lg-6 col-xs-12">
  <a href="areas/create"><button class="btn btn-success">Nuevo</button></a>
</div>
</div>

<div class="row">
  <div class="col-xs-12">
    <h3 class="header smaller lighter blue">Listado de Areas</h3>
    <div class="clearfix">
      <div class="pull-right tableTools-container"></div>
    </div>
    <div class="table-header">
      Lista de Areas"
    </div>
      <table class="table table-bordered text-center table-striped table-hover" id="example">
        <thead>
          <th>Id</th>
          <th>Nombre</th>
          <th>Planta</th>
          <th>Opciones</th>
        </thead>

        @foreach ($areas as $are)
        <tr>
          <td>{{$are->id}}</td>
          <td>{{$are->nombre}}</td>
          <td>{{$are->planta->nombre}}</td>
          <td>
            <div class="action-buttons">
              <a class="blue" href="#">
                <i class="ace-icon fa fa-search-plus bigger-200"></i>
              </a>

              <a class="green" href="{{URL::action('AreasController@edit',$are->id)}}">
                <i class="ace-icon fa fa-pencil bigger-200"></i>
              </a>
              @hasanyrole('Administrador|Coordinador')
              <a class="red" href="" data-target="#modal-delete-{{$are->id}}" data-toggle="modal">
                <i class="ace-icon fa fa-trash-o bigger-200"></i>
              </a>
              @else
              @endcan
            </div>
          </td>
        </tr>
@include('areas.modal')
        @endforeach
      </table>

  </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
$(document).ready(function() {
  var table = $('#example').DataTable( {
      lengthChange: false,
      buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
  } );

  table.buttons().container()
      //.appendTo( '#tableTools-container .col-sm-6:eq(0)' );
      .appendTo( '#example_wrapper .col-sm-6:eq(0)' );

      /*serverSide: false,
      initComplete : function () {
          table.buttons().container()
                 .appendTo( $('#example_wrapper .col-sm-6:eq(0)'));}*/

} );
</script>
@endsection
