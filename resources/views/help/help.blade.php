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
<h4><strong>Solicitud de Ayuda</strong></h4>

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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Infraestructura">Ayuda Infraestructura</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Equipo Especial">Ayuda Equipo Especial</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Material Medico y Sanitario">Ayuda Material Medico y Sanitario</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Legal">Ayuda Legal</button>
    </div>
  </div>
</div>
</div>
<div class="well">
  <h4><strong>Condiciones</strong></h4>
  Para que tu solicitud sea valida es necesario que cuentes con toda tu documentacion medica que avale tu condicion de discapacidad.
  <ul>
    <li>Copia Informe medico emanado por un especialista</li>
    <li>Copia Carnet o registro Conapdis</li>
    <li>Copia RIF actualizado del solicitante o del representante</li>
    <li>Copia Cedula o Pasaporte vigente del solicitante o del representante</li>
  </ul>
  Enviar al casillero Zoom MAR6540 Maracaibo, Edo. Zulia
</div>

{{--modal--}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Area:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Mensaje:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>
<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Nueva solicitud de Ayuda para ' + recipient)
  modal.find('.modal-body input').val('Solicitud de Ayuda ' + recipient)
  })

</script>
{{--modal--}}

@endsection
@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
