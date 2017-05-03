@extends('front.master')

@section('title','Bienvenido')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="crear">Crear Cuenta</a></li>
  <li class="active">Acceso</li>
</ol>
@endsection



@section('content')

{{--INICIO Form Login--}}
<div class="well">
  <h4><strong>Acceso</strong></h4>
  <form action="/accesar" method="post">
    {!! csrf_field() !!}
    <div class="form-group">
      <input class="form-control" type="email" name="EmailLog" placeholder="Email">
    </div>

    <div class="form-group">
      <input class="form-control" type="password" name="PasswordLog" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default btn-sm" value="submit">Sign in</button>
  </form>
</div>

{{--FIN Form Login--}}

@endsection

@section('sidebar')
  
  @include('utility.reg')

@endsection