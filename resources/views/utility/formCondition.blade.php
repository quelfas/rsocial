<!-- Modal -->
<div class="modal fade" id="conditionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Establesca su condicion de discapacidad</h4>
      </div>
      <div class="modal-body">

      	<form action="/condition" method="post">
		{!! csrf_field() !!}
			<div class="form-group">
				<label for="condition">Señale su condicion de discapacidad</label>
				<input type="text" name="condition" class="form-control">
			</div>

			<div class="form-grup">
				<label for="condition_extended">Describa brevemente el estado de su condicion</label>
				<textarea name="condition_extended" class="form-control" cols="30" rows="10"></textarea>
			</div>
		
			<input class="btn btn-default" type="submit" value="Submit">

		</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Salvar Cambios</button>
      </div>
    </div>
  </div>
</div