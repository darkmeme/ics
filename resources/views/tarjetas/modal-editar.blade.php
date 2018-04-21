{{--modal para editar una tarjeta--}}

<style media="screen">
.amarillo{ background-color:yellow;}
.color-etiquetas{ background-color:green;}
</style>

<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" id="edit-tag-{{$t->id}}">
{{Form::open(array('action'=>array('TarjetasController@update',$t->id),'method'=>'PATCH'))}}
  {{Form::token()}}
  <div class="modal-dialog modal-sm">
    <div class="modal-content amarillo">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Editar Tarjeta Amarilla
        </div>
      </div>
      <div class="modal-body">

        <div class="row">

            <div class="col-lg-5 col-xs-12">
              <div class="form-group">
                <label for="equipo">Equipo:</label>
                <select class="form-control" name="equipo_id" id="equipo" class="form-control">

                </select>
              </div>
            </div>


              <div class="col-lg-5 col-xs-6">
                <div class="form-group">
                  <label for="prioridad">Prioridad</label>
                  <select class="form-control prioridad" name="prioridad">
                    {{--se llena auto con peticion ajax--}}
                  </select>
                </div>
              </div>
              </div>

            <div class="row">
            <div class="col-lg-10 offset-1">
              <div class="color-etiquetas text-center">
                <p>DESCRIPCION DE LA ANOMALIA</p>
              </div>
              </div>
              </div>
              <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <textarea name="descripcion_reporte" class="descripcion_reporte" rows="5" cols="30"></textarea>
                </div>
              </div>
            </div>


      </div>

      <div class="modal-footer no-margin-top">
        <button type="submit" class="btn btn-sm btn-success pull-left">
          <i class="ace-icon fa fa-check"></i>
          Editar
        </button>
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    </div>
  </div>
  {{Form::Close()}}
  </div>