@extends('front.master')

@section('title','Involucrate')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">Involucrate</li>
</ol>
@endsection

@section('content')

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panle-title">Involucrate</h3>
    </div>

    <div class="panel-body">
      <div class="media">

        <div class="media-left">
          <a href="#">
            <img class="media-object" src="{{asset('assets/img/front/hdcp.jpg')}}" alt="Asistencia a Discapacitados" width="64px" />
          </a>
        </div>

        <div class="media-body">
          Somos un equipo de jóvenes emprendedores que integra diversidad de
           esfuerzos y trabaja con empeño por un fin común:  Ofrecer un espacio
           de encuentro para personas con <span class="text-primary">discapacidad</span> y asi canalizar ayudas
           puntuales para los que mas necesitan.
        </div>

      </div>

    </div>
  </div>

@stop
