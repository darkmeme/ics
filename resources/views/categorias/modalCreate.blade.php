
 <div class="modal fade" aria-hidden="true" role="dialog" id="modalCreateCategoria">

 {!!Form::open(array('url'=>'categorias','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Crear Nueva Categoria
        </div>
      </div>

      <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Categoria</label>
      <input type="text" name="categoria" class="form-control" placeholder="Categoria..." required>
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
      
</div>

{!!Form::close()!!}