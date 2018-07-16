<div class="modal fade" aria-hidden="true" role="dialog" id="crear-tarjetar">

<div class="modal-dialog">
  <div class="modal-content amarillo">
    <div class="modal-header no-padding">
      <div class="table-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <span class="white">&times;</span>
        </button>
        Crear Tarjeta Roja
      </div>
    </div>
    <div class="modal-body">
    {!!Form::open(array('url'=>'tarjetas-rojas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
      
<div class="row">
<div class="col-lg-6 col-md-4 col-xs-12">
<div class="form-group">
  <label for="nombre">Planta</label>
  <select class="form-control" id="select-planta" required name="planta_id">
    <option value="">Seleccione Planta</option>
    @foreach($plantas as $p)
    <option value="{{$p->id}}">{{$p->nombre}}</option>
    @endforeach
  </select>
</div>
</div>

<div class="col-lg-6 col-md-10 col-xs-12">
<div class="form-group">
<label for="nombre">Area/Linea</label>
<select class="form-control" id="select-area" name="area_id" required>
  {{--Este select se llena automatico desde jquery--}}
</select>
</div>
</div>
</div>

<div class="row">
       <div class="col-lg-4 col-md-4 col-xs-12">
       <div class="form-group">
       <label for="nombre">Equipo</label>
       <select class="form-control" id="select-equipos" name="equipo_id" required>
       
       {{--Este select se llena automatico desde jquery--}}
       </select>
       </div>
       </div>

    <div class="col-lg-5 col-md-5 col-xs-12">
       <div class="form-group">
       <label for="nombre">Nombre:</label>  
       <div class="input-group">
       
       <input id="txtfiltrar" type="text" value="{{ Auth::user()->name }}" class="form-control" readonly>
       <span class="input-group-btn">
       <button class="btn btn-link btnUser"><i class="ace-icon fa fa-search bigger-150"></i> </button>             
       </span>

       </div>                
           <input class="txtHidden" type="text" name="empleado_id" value="{{ Auth::user()->id }}" hidden>
      
       </div>
       
    </div>

</div>



<div class="row">

<div class="col-lg-4 col-md-4 col-xs-12">
<div class="form-group">
<label for="nombre">Turno</label>
<select class="form-control" name="turno" required placeholder="1">
  <option value="">Seleccione Turno</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
</select>
</div>
</div>
<div class="col-lg-4 col-md-4 col-xs-12">
<div class="form-group">
<label for="nombre">Prioridad</label>
<select class="form-control" name="prioridad" required placeholder="1">
  <option value="">Seleccione Prioridad</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
</select>
</div>
</div>
</div>


<div class="row">
<div class="col-lg-10 col-xs-12 offset-1">
<p><b> DESCRIPCION DE LA ANOMALIA</p></b>
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
    <button class="btn btn-primary" type="submit">Guardar<i class="fa fa-check"></i> </button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">Regresar<i class="fa fa-times"></i></button>    
    </div>
    {!!Form::close()!!}
  </div>
</div>
</div>

{{--modal para busqueda de usuarios y llenar tarjeta--}}
<div class="modal fade" id="modal-usuario" tabindex="-1">
  <div class="modal-right">
    <div class="modal-content modal-sm">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Busqueda de Usuarios
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">

            <div class="input-group">
              <span class="input-group-addon">Buscar</span>
              <input id="busqueda" type="text" class="form-control" placeholder="">
            </div>

            <table id="tabla" class="table">
             <thead>
              <tr>
               <th>Codigo</th>
               <th>Nombre</th>
              </tr>
             </thead>
             <tbody class="buscar" id="contenido">
               {{--se llena automatico desde jquery con peticiones ajax--}}
             </tbody>
            </table>

          </div>
        </div>
      </div>

      <div class="modal-footer no-margin-top">
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    </div>
  </div>

</div>
