<!-- Modal -->
<div class="modal fade" id="conditionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="/condition" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Establesca su condicion de discapacidad</h4>
      </div>
      <div class="modal-body">

		{!! csrf_field() !!}
			<div class="form-group">
				<label for="condition">Señale su condicion de discapacidad</label>
				<input type="text" name="condition" class="form-control">
			</div>

			<div class="form-grup">
				<label for="condition_extended">Describa brevemente el estado de su condicion</label>
				<textarea name="condition_extended" class="form-control" cols="30" rows="10"></textarea>
			</div>
		
			

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-default" type="submit" value="Enviar">

      </div>
       </form>
    </div>
  </div>
</div>
