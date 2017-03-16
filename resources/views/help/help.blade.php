@extends('front.master')

@section('title','Ayudas')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/user">Perfil</a></li>
  <li class="active">Ayuda</li>
</ol>
@endsection

@section('content')
<h4>Solicitud de Ayuda</h4>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingOne">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Infraestructura
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
          <ul>
            <li>Acondicionamiento de Habitacion</li>
            <li>Acondicionamiento para Sala Sanitaria</li>
            <li>Rampa de Acceso</li>
          </ul>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingTwo">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Mobiliario y Enseres Especiales
      </a>
    </h4>
  </div>
  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
      <ul>
        <li>Silla de Ruedas</li>
        <li>Andadera</li>
        <li>Bastones / Muletas</li>
        <li>Kit de Conduccion</li>
        <li>Reparacion y Acondicionamiento</li>
      </ul>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingThree">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Equipo Medico y Tratamientos
      </a>
    </h4>
  </div>
  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
      <ul>
        <li>Material Medico y Sanitario</li>
        <li>Tratamiento</li>
        <li>Rehabilitacion</li>
      </ul>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingFour">
    <h4 class="panel-title">
      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
        Ayuda Legal
      </a>
    </h4>
  </div>
  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="panel-body">
      <ul>
        <li>Derechos Humanos</li>
        <li>Derechos de Personas Discapacitadas</li>
        <li>Conapdis</li>
      </ul>
    </div>
  </div>
</div>
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
