
<div class="modal fade" aria-hidden="true" role="dialog" id="modalCreateCausa">
      {!!Form::open(array('url'=>'causas','method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}
      <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Crear Nueva Causa
        </div>
      </div>
    
    <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Causa</label>
      <input type="text" name="causa" class="form-control" required placeholder="Causas..." required>
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
    {!!Form::close()!!}
</div>
</div>

