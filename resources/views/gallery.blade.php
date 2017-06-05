@extends('front.scaffold')

@section('title','Galeria Multimedia')

@section('content')
<div class="page-header">
    <h2>Galerias <small>Información multimedia</small></h2>
</div>

<h3>Destacado</h3>

<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/iasjtg6G-30"></iframe>
</div>
 <hr>
 <div class="panel panel-default">
  <div class="panel-body">
    <p class="lead">Quieres ayudarnos en esta labor? envianos un mensaje por las <a href="#redes">redes sociales</a> o usa nuestro formulario de contacto.</p>
  </div>
</div>
@endsection

@section('sidebar')
  @parent
  @unless(Auth::check())
    @include('utility.reg')
  @else
    @include('utility.perfilControl')
    @include('utility.notifySideBar')
    @include('utility.listUsers')
  @endunless

@endsection
