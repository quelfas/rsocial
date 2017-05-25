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

	/*fix image background on top*/
	.navbar{
	    margin-bottom: 0px;
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

		.contentMidd{
			height: auto;
		}

		.mainContent{
	    	margin-bottom: 30px;
	    }
		.myfoot{
			height: auto;
		}
    }

	@media only screen and (max-device-width: 640px) {
    	
    	.mainContent{
	    	margin-bottom: 30px;
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
<header></header>
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
        {{--<li><a href="{{isset($useActivo) ? '/user':'/crear'}}">{{isset($useActivo)?'Bienvenido '.$userName : 'Crear una Cuenta'}}</a></li>--}}
        {{--<li><a href="{{isset($useActivo) ? '/salir':'/accesar'}}">{{isset($useActivo)?'Salir':'Acceder'}}</a></li>--}}
        
      </ul>
    </div><!--/.nav-collapse <a href="/registro">Registro</a>-->
  </div>
</nav>
<section class="bannerFront">
	{{--main banner--}}
	<div class="container">
		<div class="row">
		  <div class="col-md-6">
		  	<br>
		  </div>
		  <div class="col-md-6">
		  	<div class="alpha60">
				<h3>Bienvenidos</h3>
				Al crear un perfil en Una Vida Sobre Ruedas podras solicitar asistencia viable y alcanzable como persona con discapacidad y la Fundación Amigos en Ruedas canalizará mediante padrinos tu requerimiento y así ayudar a mejorar tú nivel de vida. <br> <small class="shadowText">Ciertas condiciones aplican <a id="condiciones" role="button" data-toggle="popover" title="CONDICIÓN ESENCIAL" data-content="Debes disponer de toda la documentación médica que avalen tu condición, así como tu registro CONAPDIS."><i class="fa fa-question-circle" aria-hidden="true"></i></a></small>
				<hr>

				@unless(Auth::check())

				<a class="btn btn-success btn-block" href="/crear" role="button">Crea una Cuenta</a>
				<h3>Ingresa</h3>
				<form action="/accesar" method="post">
				{!! csrf_field() !!}
				  <div class="form-group">
				  	<div class="input-group">
      					<div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
				    		<input type="email" name="EmailLog" class="form-control" id="InputEmail1" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group">
				  	<div class="input-group">
      					<div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
				    		<input type="password" name="PasswordLog" class="form-control" id="InputPassword1" placeholder="Password">
				    </div>
				  </div>
				  <button type="submit" class="btn btn-warning btn-block">Ingresa</button>
				</form>

				@else
					<h3>Bienvenido {{ $userName }}
					<small><?php 
						/**
						 * iterando entre los valores pre-establecidos
						**/
						switch ($userRole) {
							case 'USER':
								echo"Usuario Estandar";
								break;
							case 'WORKER':
								echo"Fundausuario";
								break;
							case 'EDITOR':
								echo"Editor";
								break;
							case 'ADMIN':
								echo"Administrador";
								break;
							default:
								echo"Usuario por Defecto";
								break;
						}
					?></small></h3>
					<br>
					<a class="btn btn-primary btn-lg btn-block" href="/user" role="button">Ir a tu Perfil</a>
					<a class="btn btn-default btn-lg btn-block" href="/salir" role="button">Desconectar</a>
				@endunless
			</div>
		  </div>
		</div>
	</div>
	{{--main banner--}}
</section>
<section class="contentMidd">
	{{--main stats--}}
	<div class="row">
	  <div class="col-md-4">
	  	<p class="text-center">
		  	<i class="fa fa-wheelchair-alt fa-4x"></i>
		  	<br>
		  	Registrados {{ $contados }}
	  	</p>
	  </div>
	  <div class="col-md-4">
	  	<p class="text-center">
		  	<i class="fa fa-heartbeat fa-4x" aria-hidden="true"></i>
		  	<br>
		  	Solicitudes {{ $solicitudes }}
	  	</p>
	  </div>
	  <div class="col-md-4">
		<p class="text-center">
		  	<i class="fa fa-check-square fa-4x" aria-hidden="true"></i>
		  	<br>
		  	Entregados {{ $entregadas }}
	  	</p>
	  </div>
	</div>
	{{--main stats--}}
</section>
<section class="mainContent">
	<div class="container">

		<div class="row">
		  <div class="col-md-8">
		  	<h3>Destacado</h3>
		  	
		  	<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/iasjtg6G-30"></iframe>
			</div>

		  </div>
		  <div class="col-md-4">
			<h3>Eventos</h3>
			<div class="list-group">
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

		  </div>
		</div>
	</div>
</section>
<footer class="myfoot">
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