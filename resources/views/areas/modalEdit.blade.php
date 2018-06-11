<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$a->id}}"> 
    {!!Form::model($areas,['method'=>'PATCH','route'=>['areas.update',$a->id]])!!}
    {{Form::token()}}
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
           Editar Area
        </div>
      </div>
      <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{$a->nombre}}">
    </div>

    <div class="form-group">
      <label for="Planta">Planta</label>
      <select class="form-control" name="planta_id" class="form-control">
        <option value="{{$a->planta_id}}">{{$a->planta->nombre}}</option>
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

