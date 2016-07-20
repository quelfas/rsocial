<div class="well">
<h4>Amplia tu perfil</h4>
    <form  action="profile" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control">
      </div>

      <div class="form-group">
        <label for="last_name">Apellido</label>
        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control">
      </div>

      <label for="birthdate">Fecha Nacimiento</label>
      <div class="input-group date">
			      <input type="text" name="birthdate" class="form-control" value="{{old('birthdate')}}" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      </div>

      <div class="form-group">
        <label for="gender">Genero</label>
        <select class="form-control" name="gender">
          <option value="femenino">Femenino</option>
          <option value="masculino">Masculino</option>
        </select>
      </div>

      @include('utility.listCountry')

      <div class="form-group">
        <label for="locale">Localidad</label>
        <input type="text" name="locale" value="{{old('locale')}}" class="form-control">
      </div>

      <div class="form-group">
        <label for="phone">Telefono</label>
        <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
      </div>
      {{--espacio para switch--}}
      <div class="form-group">
        <label for="privacy">Control de Privacidad</label>
        <br>
        <div style="height: 35px;">
			<input type="checkbox" name="privacy" id="privacy" checked>
		</div>
      </div>

      {{--espacio para switch--}}

      {{--espacio para switch--}}
      <div class="form-group">
        <label for="connections">Permitir Conexiones</label>
        <br>
        <div style="height: 35px;">
			<input type="checkbox" name="connections" id="connections" checked>
		</div>
      </div>
		
      {{--espacio para switch--}}

	    <div class="form-group">
	      <label for="bio">Algo sobre ti</label>
	      <textarea class="form-control" name="bio" rows="8" cols="40"></textarea>
	    </div>
	    <button type="submit" class="btn btn-default btn-sm">Cargar Perfil</button>
  	</form>
</div>

  <script>
  $(function() {
    $('[type="checkbox"]').bootstrapSwitch();
  })
</script>



<script> $('.input-group.date').datepicker({
	format: "dd/mm/yyyy",
	language: "es"
	});
</script>
