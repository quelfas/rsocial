@extends('front.scaffold')
@section('title','Bienvenido '.$userName)
@forelse ($UserProfiles as $UserProfile)

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
      {{$estado}}
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Perfil <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          @forelse($conditions as $condition)
          @empty
          <a style="color: red" id="condiciones" role="button" data-toggle="popover" title="CONDICIÓN ESENCIAL" data-content="Debes Ingresar tu Discapacidad."><i class="fa fa-wheelchair-alt" aria-hidden="true"></i></a>
          @endforelse

        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="well">
              <div class="media">
              <div class="media-left">

                <a href="#">
                  @forelse($PhotoPerfil as $myPhoto)
                  <img class="img-circle" width="50" height="50" src="{{ asset('assets/upload/') }}/{{ $myPhoto->image_name }}" alt="...">
                  @empty
                  <img class="img-circle" width="50" height="50" src="{{ asset('assets/img/') }}/{{ $UserProfile->gender }}.png" alt="Default">
                  @endforelse
                </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading">{{ $UserProfile->name }} {{ $UserProfile->last_name }}</h4>
                <ul>
                <li>Fecha de Nacimiento: {{ $UserProfile->birthdate->day }}/{{ $UserProfile->birthdate->month }}/{{ $UserProfile->birthdate->year }} ({{ $UserProfile->birthdate->age }} Años)</li>
                <li>Estado del Perfil: <span class="label label-@if($UserProfile->privacy === 'privado')success @elseif($UserProfile->privacy === 'publico')warning @endif">{{ $UserProfile->privacy }}</span></li>
                <li>Permite Invitaciones: <span class="label label-@if($UserProfile->connections === 'Si')success @elseif($UserProfile->connections === 'No')warning @endif">{{ $UserProfile->connections }}</span></li>
                </ul>
                <address>
                  <strong>{{ $userEmail }}</strong> <img src="{{ asset('assets/img/png/') }}/{{ $UserProfile->country }}.png" alt="{{ $UserProfile->country }}" /><br>
                  {{ $UserProfile->locale }}<br>
                  <abbr title="Telefono">Tel:</abbr> {{ $UserProfile->phone }}
                </address>
                <blockquote>
                  <p>{{ $UserProfile->bio }}</p>
                </blockquote>

                <hr>
                @forelse ($conditions as $condition)
                <h4>Condicion: {{ $condition->discapacidad }}</h4>
                    <p>Reseña:</p>
                    <p>{{ $condition->resena }}</p>

                @empty

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#conditionForm">
                      Ingrese su discapacidad <i class="fa fa-wheelchair" aria-hidden="true"></i>
                    </button>

                @endforelse
              </div>
            </div>
            </div>
      </div>
    </div>
  </div>
  </div>
  @endsection
@empty

  @section('content')

    @include('utility.formBio')
    <script src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
  @endsection

@endforelse

  <script>
  	$(function () {
  	$('[data-toggle="tooltip"]').tooltip()
  	})
	</script>

@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
    @include('utility.formCondition')
@endsection
