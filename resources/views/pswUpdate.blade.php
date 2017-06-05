@extends('front.scaffold')
@section('title','Gestion de Cuentas')


@section('content')


<div class="well">

<h4>Gestion de Clave</h4>
<form action="/psw-update" method="post">
  {!! csrf_field() !!}
  <div class="form-group" id="pwd-containerLocal">
    <label for="password">Clave Actual</label>
    <input type="password" class="form-control" name="passwordOld" id="passwordOld" placeholder="Ingrese su clave Actual">
  </div>
  <div class="form-group" id="pwd-container">
    <label for="password">Nueva Clave</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Clave entre 5 y 8 Caracteres">
  </div>
  <div class="form-group">
    <label for="password_confirmation">Repita la Clave</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repita la Clave anterior">
  </div>
  <button type="submit" class="btn btn-default btn-sm">Actualizar</button>
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
@endsection
@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
