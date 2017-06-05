<?php 
//informacion por defecto
/*$infoBanner = [
  'headerMesagge' =>'',
  'smallHeader'   =>'',
  'mesaggePayLoad'=>''
];

$imageFront = "imagenBanner";
*/
 ?>
@extends('front.scaffold')
<?php $apadrinados = []; ?>
@section('title','Apadrinados')

<style type="text/css">
  #eventos {
    height: 300px;
    overflow: scroll;
  }
</style>


@section('content')

  @forelse($apadrinados as $apadrinado)
  <div class="page-header">
    <h2>Apadrinados <small>Estamos ayudando</small></h2>
  </div>
  @empty
  <div class="page-header">
    <h2>Apadrinados <small>En este momento no tenemos apadrinados</small></h2>
  </div>
  <p>
    Para recibir asistencia y ser un apadrinado primeramente debes <a href="/crear">crear una cuenta</a> en la aplicación Una Vida Sobre Ruedas, luego crear un perfil con tus datos personales y de contacto indicando tu condición de discapacidad la cual debe estar sustentada con toda la documentación medica que avale tu condición, todo esto es obligatorio para solicitar asistencia ya que nuestro equipo de trabajo social verificara toda esta información.
    <br><br>
    Si no dispones de ninguno de lo anterior podras solicitar asistencia legal para que te ayudemos a conseguir lo necesario para lograr esta información, ojo no somos gestores, y no hacemos esta clase de cosas pero si te guiaremos para que puedas disponer de tu información.
  </p>
  @endforelse

@stop


  @section('sidebar')
  @parent
  @unless(Auth::check())


      <h3>Eventos</h3>
      <div id="eventos" class="list-group">
        <a href="#" class="list-group-item active">
          <h4 class="list-group-item-heading">16 de mayo de 2017</h4>
          <p class="list-group-item-text">La empresa venezolana CaracasHosting hace posible que este proyecto inicie su labor al donar un año de servicio de VPS para la aplicación Una Vida Sobre Ruedas.</p>
        </a>

        <a href="#" class="list-group-item">
          <h4 class="list-group-item-heading">3 de diciembre de 2017 <small>Próximo</small></h4>
          <p class="list-group-item-text">Día Internacional de las Personas con Discapacidad. El Decenio había sido un período de toma de conciencia y de medidas orientadas hacia la acción y destinadas al constante mejoramiento de la situación de las personas con discapacidades y a la consecución de la igualdad de oportunidades para ellas</p>

        <a href="#" class="list-group-item">
          <h4 class="list-group-item-heading">3 - 4 de diciembre de 2017 <small>Próximo</small></h4>
          <p class="list-group-item-text">Instalación de mesa de trabajo de la Fundación Amigos en Ruedas en la Ciudad de Maracaibo.</p>
        </a>
      </div>

  @else
    @include('utility.perfilControl')
    @include('utility.notifySideBar')
    @include('utility.listUsers')
  @endunless

@endsection
