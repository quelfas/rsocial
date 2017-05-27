<?php if(!isset($mensaje)){
  $mensaje = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
    <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="//js.pusher.com/3.0/pusher.min.js"></script><!-- CDN PushServices-->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/locale/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('assets/js/idle.js')}}"></script>
    <script src="{{asset('assets/js/vue/vue.js')}}"></script>
    <link rel="stylesheet" media="screen" src="{{asset('assets/bootstrap2/bootstrap3.css')}}">
    <script src="{{asset('assets/bootstrap2/bootstrap3.js')}}"></script>
    <style type="text/css">
    html {
	  position: relative;
	  min-height: 100%;
	}
	body {
	  margin-bottom: 0px;
	  padding-bottom: 0px;
	}

	.shadowText{
    	color: rgba(255,255,255,0.5);
	}

	/* shadowText unvisited link */
	.shadowText a:link {
	    color: rgba(255,255,255,0.5);
	}

	/* shadowText visited link */
	.shadowText a:visited {
	    color: rgba(255,255,255,0.5);
	}

	/* shadowText mouse over link */
	.shadowText a:hover {
	    color: hotpink;
	}

	/* shadowText selected link */
	.shadowText a:active {
	    color: rgba(255,255,255,0.5);
	}
    
    .bannerFront{
		background:url("{{ asset('assets/img/front/discapacidad.jpg') }}");
   		background-size: cover;
   		width: 100%;
		height: auto;
	}

	.bannerMessage{
   		background:url("{{ asset('assets/img/front/') }}/<?php echo isset($imageFront) ? $imageFront : 'deportista-front.jpg'; ?>");
      	background-size: cover;
     	width: 100%;
    	height: auto;
    	padding: 100px 10px 200px 10px;
    	color: rgba(255,255,255,0.5);
  	}

	/*fix image background on top*/
	.navbar{
	    margin-bottom: 40px;
	}

	.contentMidd{
    	background-color: #2a3a46;
    	width: 100%;
    	height: 100px;
    	padding: 10px 10px 10px 10px;
    	color: white;
    	margin-bottom: 18px;
    }
    .mainContent{
    	margin-bottom: 20px;
    	position: relative;
    }

    .myfoot{
    	background-color: #222c34;
    	width: 100%;
    	height: auto;
    	padding: 10px 10px 10px 10px;
    	color: rgba(255,255,255,0.5);
    	left: 0;
        bottom: 0;
        position: relative;
    }

	.alpha60 {
	    /* Fallback for web browsers that don't support RGBa */
	    background-color: rgb(0, 0, 0);
	    /* RGBa with 0.6 opacity */
	    background-color: rgba(0, 0, 0, 0.6);
	    /* For IE 5.5 - 7*/
	    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
	    /* For IE 8*/
	    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
	    color: white;
	    max-width: 460px;
	    padding: 10px 10px 10px 10px;
	    margin: 70px 0px 80px 0px;
	}

	@media only screen and (max-device-width: 430px) {
    	
    	.alpha60 {
		    max-width: 100%;
		    padding: 10px 10px 10px 10px;
		    margin: 5px 0px 30px 0px;
		}

		.contentMidd {
			height: auto;
		}

		.mainContent {
	    	margin-bottom: 30px;
	    }

		.myfoot {
			height: auto;
		}

		.bannerMessage {
			display: none;
		}
    }

	@media only screen and (max-device-width: 640px) {
    	
    	.mainContent{
	    	margin-bottom: 30px;
	    }

	    .bannerMessage {
			display: none;
		}
	}

    </style>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// bootstrap-datepicker3.standalone.min-->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
</head>
<body>
 {{--INICIO NavTop--}}

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Una Vida Sobre Ruedas</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quienes Somos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/sponsored">Apadrinados</a></li>
                <li><a href="/godparents">Padrinos</a></li>
                <li><a href="/supportUs">Nos Apoyan</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/staff">El Staff</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/joinUs">Unete</a></li>
              </ul>
            </li>
            <li><a href="/donations">Donaciones</a></li>
            <li><a href="/gallery">Galerias</a></li>
            <li><a href="events">Eventos</a></li>
            <li><a href="/contact">Contactanos</a></li>
            <li><a href="{{isset($useActivo) ? '/user':'/crear'}}">{{isset($useActivo)?'Bienvenido '.$userName : 'Crear una Cuenta'}}</a></li>
            <li><a href="{{isset($useActivo) ? '/salir':'/accesar'}}">{{isset($useActivo)?'Salir':'Acceder'}}</a></li>
          </ul>
        </div><!--/.nav-collapse <a href="/registro">Registro</a>-->
      </div>
    </nav>

    {{--FIN NavTop--}}

<section class="mainContent">
	{{--INICIO Contenido--}}

<div class="container">
  <div class="row">
    <div class="col-md-9">
      @include('errors.errorshtml')
      @include('errors.mensajes')
      @yield('content')
    </div>
    <div class="col-md-3">
    {{--INICIO Barra Lateral--}}


      @section('sidebar')
      @show
    {{--FIN Barra Lateral--}}
    </div>
  </div>
</div>

    {{--FIN Contenido--}}
</section>

<section class="bannerMessage">
	<div class="container">
	  <div class="row">
	    <div class="col-md-9">
	    <h3><?php echo isset($infoBanner) ? $infoBanner['headerMessage'] .'<small>'.$infoBanner['smallHeader'].'</small>':'Juan Valladares <small>Deportista Paralímpico</small>'; ?></h3>
	    	<p><?php echo isset($infoBanner) ? $infoBanner['mesaggePayLoad'] : 'Orgullo venezolano y ejemplo de una persona con discapacidad pero no discapacitado.'; ?></p>
	    </div>
	    <div class="col-md-3">
	    <br>
	    </div>
	  </div>
	</div>
</section>

<footer class="myfoot">
<a name="redes" id="a"></a>
	{{--main footer--}}
	<div class="container">
		<div class="row">
		<p class="text-center">
			<a href="https://www.facebook.com/Fundaruedas-1098316513645547/"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a href="https://www.instagram.com/fundaruedas/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a href="https://twitter.com/fundaruedas"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
			<a href="#"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>
		</p>
		</div>
		<div class="row">
		  <div class="col-md-4">
		  	<h4>Una Vida Sobre Ruedas</h4>
		  	<p>Es una aplicación web para recolectar información sobre necesidades de personas con discapacidad para canalizar ayudas puntuales y alcanzables en Venezuela.</p>
		  </div>
		  <div class="col-md-4">
			<h4>Nuestro Proyecto</h4>
		  	<ul class="list-unstyled">
		  		<li>El Equipo</li>
		  		<li>Los Objetivos</li>
		  		<li>Nuestra Acción</li>
			  	<li>Nos Apoyan</li>
				<li>Lo que Viene</li>
			</ul>
		  </div>
		  <div class="col-md-4">
		  	<h4>Contactanos</h4>
            <p><i class="fa fa-home" aria-hidden="true"></i> Av 29 sector amparo Maracaibo, ZU 4001 - VE</li></p>
            <p><i class="fa fa-phone" aria-hidden="true"></i> [58] 261 7563134</li></p>
            <p><a href="mailto:proyecto.uvsr@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> proyecto.uvsr[at]gmail.com</a></p>
            <p>&copy; <?php echo date('Y');?> Fundación Amigos en Ruedas J-40937333-9</p>
		  </div>
		</div>
	</div>
	{{--main footer--}}

</footer>
 <script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})

	$(document).ready(function(){
	    $('[data-toggle="popover"]').popover();
	});
</script>
<script src="{{asset('assets/js/vue/yb.js')}}"></script>
</body>
</html>