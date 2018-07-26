<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit">  
    
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
           Editar Equipo
        </div>
      </div>
      <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input id="nombre" type="text" class="form-control" required maxlength="50">
    </div>

    <div class="form-group">
      <label for="nombre">Areas</label>
      <select class="form-control comboA" required>
      @foreach($areas as $a)
        <option value="{{$a->id}}">{{$a->nombre}}</option>
      @endforeach
      </select>
    </div>
    </div>
    <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-success pull-left edit">
          <i class="ace-icon fa fa-check"></i>
          Editar
        </button>
        <button class="btn btn-sm btn-info pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    
      </div>
  </div>
</div>

