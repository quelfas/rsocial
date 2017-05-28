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
@section('title','Recupera tu Password')

@section('content')
<div class="row">
	
	<h2>Ingresa tu correo</h2>
	<form class="form-inline" action="/password/email" method="POST">
		{!! csrf_field() !!}
	  <div class="form-group">
	    <label class="sr-only" for="recoverAcount">Email</label>
	    <div class="input-group">
	      <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
              <input type="email" name="email" class="form-control" id="recoverAcount" placeholder="Email" value="{{ old('email') }}">
	      <div class="input-group-addon">1h</div>
	    </div>
	  </div>
	  <button type="submit" class="btn btn-primary">Enviar Link</button>
	</form>
	<br>

	<h3>Recuperación de cuenta</h3>
	<p>
		Enviaremos un vinculo a la dirección correo electrónico que registrastes para que cambies tu password. Recuerda que este vinculo solo dura 1 hora.
		<br>
		Si experimentas dificultades para recuperar tu cuenta, contacta con el equipo de soporte de Una Vida Sobre Ruedas a travez del formulario de contacto explicando el problema que tienes y con gusto te ayudaremos.
	</p>
</div>
@stop