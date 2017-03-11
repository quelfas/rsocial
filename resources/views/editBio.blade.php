@extends('front.master')

@section('title','Donaciones')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/">Contacto</a></li>
  <li><a href="/">Galeria</a></li>
  <li><a href="/">Eventos</a></li>
  <li class="active">Donaciones</li>
</ol>
@endsection

@section('content')
<div class="well">
<h4>Edita tu perfil</h4>
  @foreach($UserProfiles as $UserProfile)
    <form  action="profile" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{$UserProfile->name}}" class="form-control">
      </div>

      <div class="form-group">
        <label for="last_name">Apellido</label>
        <input type="text" name="last_name" value="{{$UserProfile->last_name}}" class="form-control">
      </div>

      <label for="birthdate">Fecha Nacimiento</label>
      <div class="input-group date">
			      <input type="text" name="birthdate" class="form-control" value="{{$UserProfile->birthdate}}" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
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
        <input type="text" name="locale" value="{{$UserProfile->locale}}" class="form-control">
      </div>

      <div class="form-group">
        <label for="phone">Telefono</label>
        <input type="text" name="phone" value="{{$UserProfile->phone}}" class="form-control">
      </div>
      {{--espacio para switch--}}
      <div class="form-group">
        <label for="privacy">Control de Privacidad</label>
        <br>
        <div style="height: 35px;">
			<input type="checkbox" name="privacy" id="privacy"  @if($UserProfile->privacy === 'privado') checked @else @endif>
		</div>
      </div>

      {{--espacio para switch--}}

      {{--espacio para switch--}}
      <div class="form-group">
        <label for="connections">Permitir Conexiones</label>
        <br>
        <div style="height: 35px;">
			<input type="checkbox" name="connections" id="connections" @if($UserProfile->connections === 'Si') checked @else @endif>
		</div>
      </div>

      {{--espacio para switch--}}

	    <div class="form-group">
	      <label for="bio">Algo sobre ti</label>
	      <textarea class="form-control" name="bio" rows="8" cols="40">{{$UserProfile->bio}}</textarea>
	    </div>
	    <button type="submit" class="btn btn-default btn-sm">Cargar Perfil</button>
  	</form>
  @endforeach
</div>
<script src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
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
@endsection
@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
