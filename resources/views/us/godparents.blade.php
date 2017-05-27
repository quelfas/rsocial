@extends('front.scaffold')

@section('title','Padrinos')


@section('content')
  <h3>Padrinos Honorarios</h3>
  <div class="media">
    <div class="media-left media-middle">
      <a href="http://www.caracashosting.com/">
        <img class="media-object" src="{{ asset('assets/img/award-first.png') }}" alt="Primer Padrino" style="width: 64px; height: 64px;">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">CaracasHosting, C.A.</h4>
      El primer Gran Padrino de este proyecto. Gracias a CaracasHosting por su incalculable donacion de un año de servicio de VPS para la Aplicación Web Una Vida Sobre Ruedas y darle un espacio a esta labor.
    </div>
  </div>

  <div class="media">
    <div class="media-left media-middle">
      <a href="https://pushingcode.github.io/">
        <img class="media-object" src="{{ asset('assets/img/award-second.png') }}" alt="Segundo Padrino" style="width: 64px; height: 64px;">
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">PushingCode</h4>
      El segundo Gran Padrino de este proyecto. Gracias por darle vida y presencia con el desarrollo despliegue y mantenimiento de esta aplicación.
    </div>
  </div>

  <hr>
  <div class="panel panel-default">
  <div class="panel-body">
    <p class="lead">Quieres ayudarnos en esta labor? envianos un mensaje por las <a href="#redes">redes sociales</a> o usa nuestro formulario de contacto.</p>
  </div>
</div>
@stop
