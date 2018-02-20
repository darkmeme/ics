{!! Form::open(array('url'=>'empleados','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
  <div class="input-group">
    <input type="text" class="form-control" name="buscar" placeholder="Buscar...">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary">buscar </button>
    </span>
  </div>
</div>

{{Form::close()}}
