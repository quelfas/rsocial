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
@section('title','Cambia tu Password')

@section('content')
<!-- resources/views/auth/reset.blade.php -->
<h3>Recupera tu cuenta.</h3>
    <form method="POST" action="/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Nuevo Password</label>
            <input class="form-control" type="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation"> Confirma el Password</label>
            <input class="form-control" type="password" name="password_confirmation">
        </div>
        <br>

        <button class="btn btn-default" type="submit">
                Reset Password
            </button>
    </form>
<h3>Recomendaciones</h3>
<ul>
    <li>Hacer claves de una longitud mínima de 8 caracteres. Los caracteres vuelven a la contraseña más robusta.</li>
    <li>Realizar combinaciones alfanuméricas. Estas son más difíciles de descubrir, teniendo en cuenta las diversas posibilidades de combinación de los caracteres.</li>
    <li>Utilizar distintas claves para cada servicio. De esta manera, si la contraseña es revelada, será más difícil para el atacante acceder al resto de las plataformas del usuario.</li>
    <li>Evitar palabras comunes. Quienes conocen de informática pueden revelar una clave en cuestión de segundos.</li>
    <li>Tener especial cuidado al elegir la pregunta secreta que solicitan en algunas plataformas. En las redes sociales hay mucha información personal que se vuelve pública y puede ser utilizada para descifrarla.</li>
    <li>Prestar atención cuando se accede a los servicios desde espacios públicos. Existen ciertos programas que facilitan la interferencia de las plataformas y pueden almacenar las pulsaciones del teclado.</li>
    <li>Cambiar periódicamente las claves. Esto aumenta el nivel de seguridad de las credenciales</li>
</ul> 
@stop

@section('sidebar')
    

@endsection