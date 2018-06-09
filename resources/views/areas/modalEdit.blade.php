
<div class="row">
  <div class="col-lg-6 col-xs-12">

    {!!Form::model($areas,['method'=>'PATCH','route'=>['areas.update',$areas->id]])!!}
    {{Form::token()}}
    <h3 class="header smaller lighter blue">Editar Area</h3>
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{$areas->nombre}}">
    </div>

    <div class="form-group">
      <label for="Planta">Planta</label>
      <select class="form-control" name="planta_id" class="form-control">
        <option value="{{$areas->planta_id}}">{{$areas->planta->nombre}}</option>
      </select>
    </div>

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i></button>
      <button class="btn btn-danger" type="reset">Cancelar<i class="fa fa-times"></i></button>
    </div>

    {!!Form::close()!!}
  </div>
</div>

