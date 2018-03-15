<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$t->id}}">
  {{Form::open(array('action'=>array('TarjetasController@destroy',$t->id),'method'=>'delete'))}}
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"
          aria-label="close">
          <span aria-hidden="true"> x </span>
          </button>
          <h4 class="modal-title" Eliminar Tarjetas></h4>
        </div>
        <div class="modal-body">
          <p>Desea eliminar la tarjeta No: <b>{{$t->id}}</b>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </div>
    </div>
  {{Form::Close()}}
</div>
