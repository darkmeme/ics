{!! Form::open(array('url'=>'tarjetas','method'=>'GET','autocomplete'=>'off','id'=>'formbusqueda','role'=>'search'))!!}
<div class="row">
<div class="col-lg-10">
  <div class="input-group">
    {{--<input type="text" class="form-control" id="txtbuscar" name="buscar" value="{{$filtro}}" placeholder="Filtrar Status...">--}}
    <select style="visibility" class="form-control" value="{{$filtro}}" form="formbusqueda" name="comboBuscar">
              <option value="todas">Todas</option>
              <option value="Asignada">Asignada</option>
              <option value="Reasignada">Reasignada</option>
              <option value="Finalizada">Finalizada</option>
            </select>
    <span class="input-group-btn">
      <button type="submit" id="btnbuscar" class="btn btn-primary">Filtrar </button>
    </span>
  </div>
  </div>

</div>

{{Form::close()}}
