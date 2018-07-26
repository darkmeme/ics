
<div class="modal fade" aria-hidden="true" role="dialog" id="modalCreate">

    {!!Form::open(array('url'=>'equipos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Crear Nuevo Equipo
        </div>
      </div>

    <div class="modal-body">
    
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="equipo" class="form-control" placeholder="Nombre..." required maxlength="50">
     
    </div>

    <div class="form-group">
      <label class="">Seleccione si es un equipo principal</label>
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" name="combo-padre" value="1" type="checkbox"> Padre </label>
        </div>
      </div>
    </div>
<br>
    <div class="form-group">
      <label for="nombre">Planta</label>
      <select class="form-control" id="select-planta" name="planta_id" class="form-control" required>
        <option value="">Seleccione Planta</option>
        @foreach($plantas as $p)
        <option value="{{$p->id}}">{{$p->nombre}}</option>
       @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Areas</label>
      <select class="form-control" id="select-area" name="area_id" class="form-control" required>
      {{--se llena automatico desde jquey al seleccionar planta--}}
      </select>
    </div>

    <div class="form-group">
      <label for="nombre">Equipo Principal</label>
      <select class="form-control" id="select-create-equipos" name="equipo_id" class="form-control">
      {{--se llena automatico desde jquey al seleccionar planta--}}
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


