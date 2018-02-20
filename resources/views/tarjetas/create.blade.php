<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="1" id="modal-create-tarjeta">

{!!Form::open(array('url'=>'tarjetas','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="modal-dialog modal-lg">
  <div class="modal-content amarillo">
    <div class="modal-body">

<div class="row">
      <div class="col-lg-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Planta</label>
          <select class="form-control" id="select-planta" required name="planta_id" class="form-control">
            <option value="">Seleccione Planta</option>
            @foreach($plantas as $p)
            <option value="{{$p->id}}">{{$p->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Area/Linea</label>
        <select class="form-control" id="select-area" name="area_id" required class="form-control">
          {{--Este select se llena automatico desde jquery--}}
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Equipo</label>
        <select class="form-control" id="select-equipos" name="equipo_id" required class="form-control">

      {{--Este select se llena automatico desde jquery--}}
        </select>
      </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <select class="form-control" name="empleado_id" required class="form-control">
          <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
          @foreach($users as $u)
          <option value="{{$u->id}}">{{$u->name}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Turno</label>
        <select class="form-control" name="turno" class="form-control" required placeholder="1">
          <option value="">Seleccione Turno</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Prioridad</label>
        <select class="form-control" name="prioridad" class="form-control" required placeholder="1">
          <option value="">Seleccione Prioridad</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
        </select>
      </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-4 col-xs-12">
      <div class="form-group">
        <label for="nombre">Categoria:</label>
        <select class="form-control" name="categoria_id" required class="form-control">
          <option value="">Seleccione Categoria</option>
          @foreach($categorias as $c)
          <option value="{{$c->id}}">{{$c->nombre}}</option>
         @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="form-group">
          <label for="nombre">Evento:</label>
          <select class="form-control" name="evento_id" required class="form-control">
            <option value="">Seleccione Evento</option>
            @foreach($eventos as $v)
            <option value="{{$v->id}}">{{$v->nombre}}</option>
           @endforeach
          </select>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="form-group">
          <label for="nombre">Causa:</label>
          <select class="form-control" name="causa_id" required class="form-control">
            <option value="">Seleccione causa</option>
            @foreach($causas as $v)
            <option value="{{$v->id}}">{{$v->nombre}}</option>
           @endforeach
          </select>
      </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-10 col-xs-12 offset-1">
      <div class="color-etiquetas text-center">
        <p>DESCRIPCION DE LA ANOMALIA</p>
      </div>
      </div>
      </div>

      <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="form-group">
          <textarea class="form-control" name="descripcion_reporte" rows="3" required cols="50"></textarea>
        </div>
      </div>
        </div>

    </div>
    <div class="modal-footer no-margin-top">
      <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
        <i class="ace-icon fa fa-times"></i>
        Cerrar
      </button>
      <button type="submit" class="btn btn-sm btn-success pull-left">
        <i class="ace-icon fa fa-check"></i>
        Crear Tarjeta
      </button>
    </div>
  </div>
</div>
  {!!Form::close()!!}
</div>
