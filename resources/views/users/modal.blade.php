<div class="modal fade" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$u->id}}">
  {{Form::open(array('action'=>array('UsersController@destroy',$u->id),'method'=>'delete'))}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header no-padding">

          <div class="table-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <span class="white">&times;</span>
            </button>
            Eliminar Usuario
          </div>
        </div>

        <div class="modal-body">
          <p>Desea eliminar el usuario: <b>{{$u->name}}</b>?</p>
        </div>
        <div class="modal-footer no-margin-top">
          <button type="submit" class="btn btn-sm btn-success pull-left">
            <i class="ace-icon fa fa-check"></i>
            Eliminar
          </button>
          <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
            <i class="ace-icon fa fa-times"></i>
            Cerrar
          </button>
        </div>
      </div>
    </div>
  {{Form::Close()}}
</div>
