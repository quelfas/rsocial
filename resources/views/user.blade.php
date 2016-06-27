@extends('front.master')
@section('title','Bienvenido '.$userName)
@forelse ($UserProfiles as $UserProfile)
@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/salir">Desconectar</a></li>
  <li><a href="/profile/{{ $UserProfile->user_id }}">Perfil</a></li>
</ol>
@endsection

@section('content')



  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Pagina de Inicio <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <div class="panel panel-default">
          <div class="panel-body">

              @include('utility.fileHandler')

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Cuenta <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      estado de la cuenta
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Perfil <span class="glyphicon glyphicon-user" aria-hidden="true"></span>

        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="well">
              <div class="media">
              <div class="media-left">

                <a href="#">
                  <img class="img-circle" width="50" height="50" src="{{asset('assets/img/')}}/{{$UserProfile->gender}}.png" alt="...">
                </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading">{{ $UserProfile->name }} {{ $UserProfile->last_name }}</h4>
                <ul>
                <li>Fecha de Nacimiento: {{ $UserProfile->birthdate->day }}/{{ $UserProfile->birthdate->month }}/{{ $UserProfile->birthdate->year }} ({{ $UserProfile->birthdate->age }} Años)</li>
                <li>Estado del Perfil: <span class="label label-@if($UserProfile->privacy==='privado')success @elseif($UserProfile->privacy==='publico')warning @endif">{{ $UserProfile->privacy }}</span></li>
                <li>Permite Invitaciones: <span class="label label-@if($UserProfile->connections==='Si')success @elseif($UserProfile->connections==='No')warning @endif">{{ $UserProfile->connections }}</span></li>
                </ul>
                <address>
                  <strong>{{ $userEmail }}</strong> <img src="{{asset('assets/img/png/')}}/{{$UserProfile->country}}.png" alt="{{ $UserProfile->country }}" /><br>
                  {{ $UserProfile->locale }}<br>
                  <abbr title="Telefono">Tel:</abbr> {{ $UserProfile->phone }}
                </address>
                <blockquote>
                  <p>{{ $UserProfile->bio }}</p>
                </blockquote>
              </div>
            </div>
          @empty
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
                <input type="checkbox" name="privacy" id="privacy" class="form-control" checked>
              </div>
              {{--espacio para switch--}}

              {{--espacio para switch--}}
              <div class="form-group">
                <label for="connections">Permitir Conexiones</label>
                <br>
                <input type="checkbox" name="connections" id="connections" class="form-control" checked>
              </div>
              {{--espacio para switch--}}

            <div class="form-group">
              <label for="bio">Algo sobre ti</label>
              <textarea class="form-control" name="bio" rows="8" cols="40"></textarea>
            </div>
            <button type="submit" class="btn btn-default btn-sm">Cargar Perfil</button>
            </form>
          @endforelse

        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
  <script>
  $(function() {
    $('[type="checkbox"]').bootstrapSwitch();
  })
  </script>
  <script>
  	$(function () {
  	$('[data-toggle="tooltip"]').tooltip()
  	})
	</script>

	<script> $('.input-group.date').datepicker({
			format: "dd/mm/yyyy",
			language: "es"
		});
	</script>
@stop
@section('sidebar')
  @parent
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
