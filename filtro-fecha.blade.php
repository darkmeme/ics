
<form class="form-group" method="GET" action="{{ url('tarjetas-rojas') }}">
{{ csrf_field() }}
<div class="row">
<div class="col-lg-10 col-xs-12 col-md-12 col-sm-12 input-group input-group-sm">
<span class="input-group-addon"><b> Filtrar por fechas por: </b></span>
  <select id="tipo" name="fecha" class="form-control">
  <option value="crea">Creacion</option>
  <option value="fina">Finalizacion</option>
  </select>
  <span class="input-group-addon"><b> Seleccione las fechas </b></span>
  <input id="fini" type="text" name="inicio" class="form-control" value="{{$inicio}}" autocomplete="off" placeholder="fecha inicio.." readonly>
  <span class="input-group-addon"><i class="ace-icon fa fa-chevron-right"></i></span>
  <input id="ffin" type="text" name="fin" class="form-control" value="{{$fin}}" autocomplete="off" placeholder="fecha fin..." readonly>
  <span class="input-group-btn">
       <button type="submit" class="btn btn-link"><i class="ace-icon fa fa-filter bigger-150"></i> </button>             
  </span>
  <span class="input-group-btn">
       <button class="btn btn-link btnban"><i class="ace-icon fa fa-ban bigger-150"></i> </button>             
  </span>

<span class="input-group-addon"><b> Filtrar por Status </b></span>
<select id="combo" name="status" class="form-control">
<option value="def">Todas las Tarjetas</option>
<option value="Asignada">Asignadas</option>
<option value="Reasignada">Reasignadas</option>
<option value="Finalizada">Finalizadas</option>
</select>
  <span class="input-group-btn"> 
       <button class="btn btn-link"><i class="ace-icon fa fa-filter bigger-150"></i> </button>             
  </span>
  <span class="input-group-btn">
       <button class="btn btn-link btnres"><i class="ace-icon fa fa-ban bigger-150"></i> </button>             
  </span>


 <span class="input-group-addon"><b> Filtrar por Prioridad </b></span>
               <select id="combo" name="prioridad" class="form-control">
               <option value="def">Todas las Tarjetas</option>
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="C">C</option>
               </select>
               <span class="input-group-btn"> 
                    <button class="btn btn-link"><i class="ace-icon fa fa-filter bigger-150"></i> </button>             
               </span>
               <span class="input-group-btn">
                    <button class="btn btn-link btnres"><i class="ace-icon fa fa-ban bigger-150"></i> </button>             
               </span>



</div>

</div>
</form>