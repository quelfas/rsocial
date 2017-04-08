@extends('front.master')

@section('title','Edita tu perfil')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/user">Perfil</a></li>
  <li class="active">Edita tu perfil</li>
</ol>
@endsection

@section('content')
<div class="well">

  @foreach($UserProfiles as $UserProfile)
  {{--imagen--}}
  <div class="panel panel-default">
    <div class="panel-heading">

      <h3 class="panel-title">Actuliza tu imagen</h3>

    </div>
    <div class="panel-body">
      {{----}}
      <div class="media">
      <div class="media-left">

        <a href="#">
          @forelse($PhotoPerfil as $myPhoto)
          <img class="img-circle" width="50" height="50" src="{{ asset('assets/upload/') }}/{{ $myPhoto->image_name }}" alt="...">
          @empty
          <img class="img-circle" width="50" height="50" src="{{ asset('assets/img/') }}/{{ $UserProfile->gender }}.png" alt="...">
          @endforelse
        </a>

      </div>
      <div class="media-body">
        <form class="form-group" action="/photo" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <label class="btn btn-info" for="file">
              <input id="file" type="file" style="display:none;">
              Seleciona de tus Archivos
          </label>
          
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </div>
      {{----}}
    </div>
  </div>
  {{--imagen--}}
  <h4>Edita tu perfil</h4>
    <form  action="/profile/{{$UserProfile->user_id}}" method="post">
      <input type="hidden" name="_method" value="PATCH">
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
			      <input type="text" name="birthdate" class="form-control" value="{{$UserProfile->birthdate->day}}/{{$UserProfile->birthdate->month}}/{{$UserProfile->birthdate->year}}" /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      </div>

      <div class="form-group">
        <label for="gender">Genero</label>
        <select class="form-control" name="gender">
          <option  @if($UserProfile->gender === 'femenino') selected @else @endif  value="femenino">Femenino</option>
          <option  @if($UserProfile->gender === 'masculino') selected @else @endif  value="masculino">Masculino</option>
        </select>
      </div>

      @include('utility.listCountry', ['pais'=>$UserProfile->country])

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
