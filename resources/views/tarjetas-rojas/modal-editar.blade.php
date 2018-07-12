{{--modal para editar una tarjeta roja--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" id="edit-tarjeta">

  <div class="modal-dialog modal-sm">
    <div class="modal-content amarillo">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Editar Tarjeta Roja
        </div>
      </div>
      <div class="modal-body">

        <div class="row">

          {{--  <div class="col-lg-5 col-xs-12">
              <div class="form-group">
                <label for="equipo">Equipo:</label>
                <select class="form-control" name="equipo_id" id="equipo" class="form-control">

                </select>
              </div>
            </div> --}}


              <div class="col-lg-5 col-xs-6">
                <div class="form-group">
                  <label for="prioridad">Prioridad</label>
                  <select id="prioridad" class="form-control" name="prioridad">
                  <option value ="A">A</option>
                  <option value ="B">B</option>
                  <option value ="C">C</option>
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
                  <textarea name="descripcion_reporte" class="descripcion" rows="5" cols="30"></textarea>
                </div>
              </div>
            </div>


      </div>

      <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-success pull-left editar">
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
  </div>