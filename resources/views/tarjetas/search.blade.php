{!! Form::open(array('url'=>'tarjetas','method'=>'GET','autocomplete'=>'off','id'=>'formbusqueda','role'=>'search'))!!}
<div class="row">
<div class="col-lg-10">
  <div class="input-group">
    <input type="text" class="form-control" id="txtbuscar" name="buscar" value="{{$filtro}}" placeholder="Filtrar por Status...">
    <span class="input-group-btn">
      <button type="submit" id="btnbuscar" class="btn btn-primary">Filtrar </button>
    </span>
  </div>
  </div>

</div>

{{Form::close()}}
