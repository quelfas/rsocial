<div class="well">
	<h4>Establesca su condicion de discapacidad</h4>
	<form action="/condition" method="post">
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