<?php if(!isset($mensaje)){
  $mensaje = null;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  	<meta name="csrf-token" content="{{ csrf_token() }}" />
  	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
  	<link rel="stylesheet" href="{{asset('assets/css/footer.css')}}" />
  	<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/highlight.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-switch.css')}}" />
  	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  	<link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script src="https://use.fontawesome.com/f4157ac849.js"></script><!-- CDN font-Awesome ty <3 -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/locale/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('assets/js/idle.js')}}"></script>
    <script src="{{asset('assets/js/vue/vue.js')}}"></script>
    <link rel="stylesheet" media="screen" src="{{asset('assets/bootstrap2/bootstrap3.css')}}">
    <script src="{{asset('assets/bootstrap2/bootstrap3.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// bootstrap-datepicker3.standalone.min-->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
  </head>
  <body>
    {{--INICIO NavTop--}}

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Vidas Sobre Ruedas</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/somos">Quienes Somos</a></li>
            <li><a href="/contacto">Contactanos</a></li>
            <li><a href="{{isset($useActivo) ? '/user':'/crear'}}">{{isset($useActivo)?'Bienvenido '.$userName : 'Crear una Cuenta'}}</a></li>
            <li><a href="{{isset($useActivo) ? '/salir':'/accesar'}}">{{isset($useActivo)?'Salir':'Acceder'}}</a></li>
          </ul>
        </div><!--/.nav-collapse <a href="/registro">Registro</a>-->
      </div>
    </nav>

    {{--FIN NavTop--}}

    <div class="container">

    {{--INICIO BreadCrumbs--}}

    <div class="row">
      @yield('breadcrumbs')
    </div>

    {{--FIN BreadCrumbs--}}

    {{--INICIO Contenido--}}

      <div class="row">
        <div class="col-md-9">
          @include('errors.errorshtml')
          @include('errors.mensajes')
          @yield('content')
        </div>
        <div class="col-md-3">
        {{--INICIO Barra Lateral--}}
        <p>
          barra lateral
        </p>
          @section('sidebar')
          @show

          <p>
            barra lateral
          </p>
        {{--FIN Barra Lateral--}}
        </div>
      </div>


    {{--FIN Contenido--}}

    </div>

    {{--INICIO Footer--}}

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Una vida sobre Ruedas. It is a development CristalMedia</p>
        <p class "text-muted">Proudly Developed in Laravel</p>
      </div>
    </footer>

    {{--FIN Footer--}}

    <script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
		</script>
  </body>
</html>
