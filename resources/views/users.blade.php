@extends('front.master')
@section('title','Gestion de Cuentas')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">Crear Cuenta</li>
</ol>
@endsection

@section('content')


<div class="well">

<h4>Crea una Cuenta</h4>
<form action="/user-create" method="post">
  {!! csrf_field() !!}
  <div class="form-group">
    <label for="name">Nick Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Nick Name">
  </div>
  <div class="form-group">
    <label for="email">Correo Electronico</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="tu@email.com">
  </div>
  <div class="form-group" id="pwd-container">
    <label for="password">Clave</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Clave entre 5 y 8 Caracteres">
  </div>
  <div class="form-group">
    <label for="password_confirmation">Repita la Clave</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repita la Clave anterior">
  </div>
  <button type="submit" class="btn btn-default btn-sm">Registrar</button>
</form>
<script src="{{asset('assets/js/pwstrength.js')}}" charset="utf-8"></script>
<script type="text/javascript">
        jQuery(document).ready(function () {
            "use strict";
            var options = {};
            options.ui = {
                container: "#pwd-container",
                showStatus: true,
                showProgressBar: true,
                viewports: {
                    verdict: ".pwstrength_viewport_verdict"
                }
            };
            $('#password').pwstrength(options);
        });
    </script>
</div>
@stop
