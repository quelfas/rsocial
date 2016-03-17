@extends('front.master')
@section('title','Solicitudes de Amistad')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/salir">Desconectar</a></li>
  <li><a href="/user">Perfil</a></li>
  <li class="active">Solicitudes de Amistad</li>
</ol>
@endsection

@section('content')
<h4>Solicitudes de Amistad</h4>
    <table class="table table-striped">
      <tr>
        <td>
          <strong>Genero</strong>
        </td>
        <td>
          <strong>Nombre</strong>
        </td>
        <td>
          <strong>Localidad</strong>
        </td>
        <td>
          <strong>Acci&oacute;n</strong>
        </td>
      </tr>
      @foreach($recibidos as $recibido)
      <tr>
        <td>
          <img class="img-circle" width="20" height="20" src="{{asset('assets/img/')}}/{{$recibido->gender}}.png" alt="...">
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

@stop

@section('sidebar')
  @parent
    @include('utility.notifySideBar')
    @include('utility.listUsers')
@endsection
