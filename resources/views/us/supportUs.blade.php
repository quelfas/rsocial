@extends('front.scaffold')

@section('title','Nos Apoyan')

@section('content')
    <div class="page-header">
     <h2>Nos Apoyan <small>Empresas y Servicios</small></h2>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="{{ asset('assets/img/sparkpost.jpg') }}" alt="SparkPost">
          <div class="caption">
            <h3>SparkPost</h3>
            <p>Nuestros mensajes de correo son entregados por SparkPost.</p>
            <p><a href="https://www.sparkpost.com/" class="btn btn-primary" role="button">Visitar</a></p>
          </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="{{ asset('assets/img/caracashosting.jpg') }}" alt="CaracasHosting">
          <div class="caption">
            <h3>CaracasHosting</h3>
            <p>Nuestro servicio de alojamiento es provisto por CaracasHosting CA.</p>
            <p><a href="http://www.caracashosting.com/" class="btn btn-primary" role="button">Visitar</a></p>
          </div>
        </div>
  </div>

<div class="col-sm-6 col-md-4">   
        <div class="thumbnail">
          <img src="{{ asset('assets/img/font-awesome.png') }}" alt="CaracasHosting">
          <div class="caption">
            <h3>CaracasHosting</h3>
            <p>Nuestra Iconografia es gracias al servicio de Font Awesome</p>
            <p><a href="http://fontawesome.io/" class="btn btn-primary" role="button">Visitar</a></p>
          </div>
        </div>
  </div>
@stop
