
<div class="modal fade" aria-hidden="true" role="dialog" id="modalCreate">

    {!!Form::open(array('url'=>'areas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Crear Nueva Area
        </div>
      </div>

    <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" placeholder="Nombre..." required maxlength="50">
        
    </div>

    <div class="form-group">
      <label for="nombre">Planta</label>
      <select class="form-control" name="planta_id" id="select-planta" class="form-control" required>
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
        
    </div>

    <div class="form-group">
      <label for="nombre">Sub Area (Si aplica)</label>
      <select class="form-control" name="subArea" class="form-control" id="select-area">
      {{--se llena con jquery--}}
      </select>
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
</div>
    {!!Form::close()!!}
</div>


