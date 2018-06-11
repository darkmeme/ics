
<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$cat->id}}">  
    {!!Form::model($categorias,['method'=>'PATCH','route'=>['categorias.update',$cat->id]])!!}
    {{Form::token()}}
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
           Editar Categoria
        </div>
      </div>

      <div class="modal-body">
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="{{$cat->nombre}}">
    </div>
    </div>

    <div class="modal-footer no-margin-top">
        <button type="submit" class="btn btn-sm btn-success pull-left">
          <i class="ace-icon fa fa-check"></i>
          Editar
        </button>
        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
          <i class="ace-icon fa fa-times"></i>
          Cerrar
        </button>
      </div>
    
    </div>
    {!!Form::close()!!}
  </div>
</div>

