@extends('layouts.admin')
@section('contenido')
<br>
    <div class="row">
        <div class="col-xs-12">
                <div class="clearfix">
                  <div class="tableTools-container">
                      <div class="row">
                         <div class="col-lg-2">
                            <button class="btn btn-info"  data-target="#modalCreate" data-toggle="modal">Nueva
                            <i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                   </div>
                 </div>

                 <div class="table-header">
                    Lista de Areas"
                    </div>
                    
                      <table class="table table-striped" id="tablaAreas">
                         <thead>
                           <th class="text-center">Id</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Planta</th>
                            <th class="text-center">Opciones</th>
                         </thead>
                         @foreach ($areas as $a)
                         <tr>
                         <td>{{$a->id}}</td>
                         <td>{{$a->nombre}}</td>
                         <td>{{$a->planta->nombre}}</td>
                         <td>
                              <div class="action-buttons">
                              <a class="green" href="{{URL::action('AreasController@edit',$a->id)}}">
                                <i class="ace-icon fa fa-pencil bigger-200"></i>
                              </a>
                            
                              <a class="red" href="" data-target="#" data-toggle="modal">
                                <i class="ace-icon fa fa-trash-o bigger-200"></i>
                              </a>
                              @can('borrar')
                              @else
                              @endcan
                            </div>
                          </td>
                         </tr>
                         @endforeach
                          </table>          
                     </div>
                  </div>
@include('areas.modalCreate')                 
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/combox.js')}}"></script>
<script type="text/javascript">
//script para cargar estilo y botones de jQuery DataTable
$(document).ready(function() {

  var table = $('#tablaAreas').DataTable({
    "aaSorting": [[ 0, "desc" ]],
  });

  new $.fn.dataTable.Buttons( table, {
      buttons: [
        {
          "extend": "pdf",
          "titleAttr": 'Exportar a PDF',
          "messageTop": 'Reporte de Areas.',
          "filename": 'Reporte de Areas',
          "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": "copy",
          "titleAttr": 'Copiar a Porta Papeles',
          "text": "<i class='fa fa-copy bigger-110 pink'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": "excel",
          "titleAttr": 'Exportar a Excel',
          "text": "<i class='fa fa-file-excel-o bigger-110 green'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": 'print',
          "titleAttr": 'Imprimir Documento',
          "text": "<i class='fa fa-print bigger-110 grey'></i>",
          "className": "btn btn-white btn-primary  btn-bold",
        },
        {
          "extend": 'colvis',
          "titleAttr": 'Ocultar Columnas',
          "text": "ocultar",
          "className": "btn btn-white btn-primary  btn-bold",
        } ]
  } );

  table.buttons().container()
      .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
} );
</script>
@endsection
