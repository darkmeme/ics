{{--modal para editar una tarjeta--}}
<style media="screen">
.amarillo{ background-color:yellow;}
.color-etiquetas{ background-color:green;}
</style>
{!!Form::model($tarjetas,['method'=>'PATCH','route'=>['tarjetas.update',$t->id]])!!}
{{Form::token()}}
<div class="modal fade" id="edit-tag" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content amarillo">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Finalizar Tarjeta
        </div>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-lg-4 col-xs-12">
            <div class="form-group">
              <label for="planta">Planta</label>
              <select class="form-control" name="planta_id" id="planta" class="form-control">

              </select>
            </div>
          </div>

            <div class="col-lg-4 col-xs-12">
              <div class="form-group">
                <label for="area">Area/Linea</label>
                <select class="form-control" name="area_id" id="area" class="form-control">

                </select>
              </div>
            </div>

            <div class="col-lg-4 col-xs-12">
              <div class="form-group">
                <label for="equipo">Equipo:</label>
                <select class="form-control" name="equipo_id" id="equipo" class="form-control">

                </select>
              </div>
            </div>

            </div>
            <div class="row">
            <div class="col-lg-4 col-xs-12 offset-1">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <select class="form-control" name="user_id" id="user" class="form-control">

                </select>
              </div>
              </div>
              <div class="col-lg-4 col-xs-12">
                <div class="form-group">
                  <label for="turno">Turno</label>
                  <select class="form-control" id="turno" name="turno">

                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <div class="form-group">
                  <label for="prioridad">Prioridad</label>
                  <select class="form-control" id="prioridad" name="prioridad">

                    
                    <option value="B">B</option>
                    <option value="C">C</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-lg-4 col-xs-6">
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="categoria" name="categoria">

                </select>
              </div>
            </div>



            <div class="col-lg-4 col-xs-6">
              <div class="form-group">
                <label for="evento">Evento</label>
                <select class="form-control" id="evento" name="evento">

                </select>
              </div>
            </div>
            <div class="col-lg-4 col-xs-6">
              <div class="form-group">
                <label for="nombre">Causa del evento</label>
                <select class="form-control" id="causa" name="causa">

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
                  <textarea name="descripcion_reporte" id="descripcion_reporte" rows="5" cols="50"></textarea>
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
</div>
  {{Form::Close()}}
