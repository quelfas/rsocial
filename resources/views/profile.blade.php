@extends('front.master')
@foreach ($UserProfiles as $UserProfile)
@section('title','Perfil de '.$UserProfile->name.' '.$UserProfile->last_name)

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/user">tu Perfil</a></li>
  <li class="active">Perfil de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</li>
</ol>
@endsection

@section('content')
<div class="well">
      <div class="media">
      <div class="media-left">

        <a href="#">
          <img class="img-circle" width="50" height="50" src="{{ asset('assets/img/') }}/{{ $UserProfile->gender }}.png" alt="...">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">{{ $UserProfile->name }} {{ $UserProfile->last_name }} <small>({{ $UserProfile->birthdate->age }} Años)</small></h4>

        @if($UserProfile->privacy === 'privado')
        <p>
          Este perfil es privado y solo muestra informacion basica.<br>
          <strong>Pais: </strong> <img src="{{ asset('assets/img/png/') }}/{{ $UserProfile->country }}.png" alt="{{ $UserProfile->country }}" /><br>
        </p>

        @else

        <ul>
          <li>Fecha de Nacimiento: {{ $UserProfile->birthdate->day }}/{{ $UserProfile->birthdate->month }}/{{ $UserProfile->birthdate->year }} </li>
          <li>Estado del Perfil: <span class="label label-@if($UserProfile->privacy==='privado')success @elseif($UserProfile->privacy==='publico')warning @endif">{{ $UserProfile->privacy }}</span></li>
          <li>Permite Invitaciones: <span class="label label-@if($UserProfile->connections==='Si')success @elseif($UserProfile->connections==='No')warning @endif">{{ $UserProfile->connections }}</span></li>
        </ul>

        <address>
          <strong>Pais</strong> 
          <img src="{{ asset('assets/img/png/') }}/{{ $UserProfile->country }}.png" alt="{{ $UserProfile->country }}" />
          <br>
          {{ $UserProfile->locale }}
          <br>
          <abbr title="Telefono">Tel:</abbr> {{ $UserProfile->phone }}
        </address>
        <blockquote>
          <p>{{ $UserProfile->bio }}</p>
        </blockquote>

        @endif
    {{-- modificando la plantilla para verificar si son amigos o no --}}

            @if($UserRelations == 'Si')
            {{-- Son Amigos --}}
              @foreach($InfoRelations as $InfoRelation)
                <button type="button" class="btn btn-default btn-xs">Enviar mensaje <i class="fa fa-comments-o" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default btn-xs">Escribir en su muro <i class="fa fa-comment" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default btn-xs">Dejar de seguir <i style="color:red" class="fa fa-times" aria-hidden="true"></i></button>
                <hr>
                <strong>Amigos desde</strong> 
                <i class="fa fa-hand-o-right"></i> 
                {{$InfoRelation->created_at->day}}/{{$InfoRelation->created_at->month}}/{{$InfoRelation->created_at->year}}
                @if($InfoRelation->created_at->age > 1)
                  {{$InfoRelation->created_at->age}} años.
                @else
                   
                @endif
              @endforeach
            @else

            {{-- No son Amigos --}}

            {{--boton para solicitar amistad--}}


                @if($UserProfile->connections==='Si')
                  <form action="/relation" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="user_id2" value="{{ $UserProfile->user_id }}">
                    <button type="submit" class="btn btn-success btn-sm">
                      Agregar a mis Amigos
                    </button>
                  </form>
                @else
                  <p>
                    Este usuario no esta admitiendo solicitudes de amistad
                  </p>
                @endif


            {{--boton para solicitar amistad--}}

            {{-- No son Amigos --}}

            @endif

    {{-- modificando la plantilla para verificar si son amigos o no --}}

      </div>
    </div>
</div>
@stop
  @endforeach
