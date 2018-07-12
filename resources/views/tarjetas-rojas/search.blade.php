{!! Form::open(array('url'=>'tarjetas-rojas','method'=>'GET','autocomplete'=>'off','id'=>'formbusqueda','role'=>'search'))!!}
<div class="row">
<div class="col-lg-2 col-lg-offset-10">
  <div class="input-group">
    <input type="text" class="form-control" id="txtbuscar" name="buscar" value="{{$filtro}}" placeholder="Filtrar Status...">
    <span class="input-group-btn">
      <button type="submit" id="btnbuscar" class="btn btn-primary">buscar </button>
    </span>
  </div>
  </div>
</div>
{{Form::close()}}
