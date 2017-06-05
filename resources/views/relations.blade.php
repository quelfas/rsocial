@extends('front.scaffold')
@section('title','Solicitudes de Amistad')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Solicitudes de Amistad</h3>
  </div>
  <div class="panel-body">

    <h4>Amistades</h4>
    @if(count($amistades) >= 1)
      <table class="table table-striped">
        <tr>
          <th>Pic</th>
          <th>Nombre</th>
          <th>Localidad</th>
          <th></th>
        </tr>
        @foreach($amistades as $amistad)
        <tr>
          <td><img class="img-circle" width="20" height="20" src="{{ asset('assets/img/') }}/{{ $amistad->gender }}.png" alt="{{ $amistad->name }} {{ $amistad->last_name }}"></td>
          <td><a href="/profile/{{ $amistad->user_id }}">{{ $amistad->name }} {{ $amistad->last_name }}</a></td>
          <td>{{ $amistad->locale }}</td>
          <td>
            <form action="/terminate" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="user_id" value="{{ $amistad->user_id }}">
              <input class="btn btn-default btn-xs" type="submit" value="Dejar de seguir">
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      {{-- agregado paginado --}}
      {!! $amistades->render() !!}
    @else
      <h5>Aun no hay amistades</h5>
    @endif

  <hr>

  <h4>Solicitudes de Amistad</h4>
  @unless($recibidos)
  <h5>No existen solicitudes pendientes</h5>
  @else
      <table class="table table-striped">
        <tr>
          <th>Pic</th>
          <th>Nombre</th>
          <th>Localidad</th>
          <th>Acci&oacute;n</th>
        </tr>
        @foreach($recibidos as $recibido)
        <tr>
          <td>
            <img class="img-circle" width="20" height="20" src="{{asset('assets/img/')}}/{{$recibido->gender}}.png" alt="{{$recibido->name}} {{$recibido->last_name}}">
          </td>
          <td>
            <a href="/profile/{{$recibido->user_id}}">{{$recibido->name}} {{$recibido->last_name}}</a>
          </td>
          <td>
          {{$recibido->locale}}
          </td>
          <td>
            <form class="" action="/relation/{{$recibido->user_id}}" method="POST">
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="_id" value="{{$recibido->user_id}}">

              {!! csrf_field() !!}
              <label class="radio-inline">
                <input type="radio" name="solicitud-{{$recibido->user_id}}" value="SI"><span style="color:green;" class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
              </label>
              <label class="radio-inline">
                <input type="radio" name="solicitud-{{$recibido->user_id}}" value="NO"><span style="color:red;" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
              </label>
              <button id="l{{$recibido->user_id}}" class="btn btn-info btn-xs" disabled="disabled">enviar</button>
            </form>
          </td>
        </tr>
        <script>
          $('input[name=solicitud-{{$recibido->user_id}}]').on('click', function () {
            $('#l{{$recibido->user_id}}').removeAttr('disabled');
          });
          //@ sourceURL=pen.js
        </script>
        @endforeach
      </table>
  @endunless

  <hr>

  <h4>Amistades Solicitadas</h4>
  @unless($enviados)
  <h5>No tienes solicitudes enviadas</h5>
  @else
      <table class="table table-striped">
        <tr>
          <th>Pic</th>
          <th>Nombre</th>
          <th>Localidad</th>
          <th>Solicitud enviada</th>
          <th> </th>
        </tr>
        @foreach($enviados as $enviado)
        <tr>
          <td><img class="img-circle" width="20" height="20" src="{{ asset('assets/img/') }}/{{ $enviado->gender }}.png" alt="{{ $enviado->name }} {{ $enviado->last_name }}"></td>
          <td><a href="/perfile/{{ $enviado->user_id }}">{{ $enviado->name }} {{ $enviado->last_name }}</a></td>
          <td>{{ $enviado->locale }}</td>
          <td>
          <?php
            $date = new DateTime($enviado->created_at);
            echo date_format($date,'d/m/Y');
           ?>
           </td>
          <td>
            <form action="/terminate" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="user_id" value="{{ $enviado->user_id }}">
              <input class="btn btn-default btn-xs" type="submit" value="Cancelar Solicitud">
            </form>
          </td>
        </tr>
        @endforeach
      </table>
  @endunless


  </div>
</div>
@endsection

@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
