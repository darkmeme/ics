<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$equipo->id}}">  
    {!!Form::model($equipos,['method'=>'PATCH','route'=>['equipos.update',$equipo->id]])!!}
    {{Form::token()}}
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
      <input type="text" name="nombre" class="form-control" value="{{$equipo->nombre}}" required maxlength="50">
    </div>

    <div class="form-group">
      <label for="nombre">Areas</label>
      <select class="form-control" name="area_id" class="form-control" required>
        <option value="{{$equipo->area_id}}">{{$equipo->area->nombre}}</option>
      </select>
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
    {!!Form::close()!!}
  </div>
</div>

