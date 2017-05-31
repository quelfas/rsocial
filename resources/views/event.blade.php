@extends('front.scaffold')

@section('title','Eventos')

@section('content')
<div class="page-header">
    <h2>Eventos <small>Próximos eventos</small></h2>
</div>
<p>Estamos trabajando en ello.</p>
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
    @include('utility.notifySideBar')
    @include('utility.listUsers')
  @endunless

@endsection