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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-req="infrastructure" data-whatever="Infraestructura">Ayuda Infraestructura</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-req="equipment" data-whatever="Equipo Especial">Ayuda Equipo Especial</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-req="medical" data-whatever="Material Medico y Sanitario">Ayuda Material Medico y Sanitario</button>
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
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-req="legal" data-whatever="Legal">Ayuda Legal</button>
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

      <form action="/request-help" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="req-type" id="req-type" value="">
      <div class="modal-body">
        {{--hack--}}
          <div class="form-group">
            <label for="recipient" class="control-label">Area:</label>
            <input type="text" name="recipient" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <select class="form-control" id="select" name="helprequest">

            </select>
            <br>
            <div>
              {{--caja para video youtube--}}
              <label for="link" class="control-label">Agrega un Video a tu Solicitud:</label>
              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-youtube fa-1x" aria-hidden="true"></i>
                </div>

                <input name="link" v-model="link" type="text" class="form-control" placeholder="Pega tu video">
                <input type="hidden" v-bind:value="link | youtube" name="source">
                <input type="hidden" v-bind:value="link | youtubeName" name="nameId">

              </div>
              <small>Esto ayudara a explicar mejor tu requerimiento</small>
              {{--caja para video youtube--}}
            </div>
            <br>
            <div class="nodo"></div>
          </div>
      </div>

      <div class="modal-footer">
        <button v-on:click="limpiarFormVideo()" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
    $('#select').empty()
    $('#otro').remove()
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var typeReq = button.data('req')
    var infrastructure = [
      "Acondicionamiento de Habitacion",
      "Acondicionamiento para Sala Sanitaria",
      "Rampa de Acceso",
      "Otro"
    ]
    var equipment = [
      "Silla de Ruedas",
      "Andadera",
      "Bastones / Muletas",
      "Kit de Conduccion",
      "Reparacion y Acondicionamiento",
      "Otro"
    ]
    var medical = [
      "Material Medico y Sanitario",
      "Tratamiento",
      "Rehabilitacion",
      "Otro"
    ]
    var legal = [
      "Derechos Humanos",
      "Derechos de Personas Discapacitadas",
      "Conapdis",
      "Otro"
    ]
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('Nueva solicitud de Ayuda para ' + recipient)
    modal.find('#recipient-name').val('Solicitud de Ayuda ' + recipient)
    modal.find('#req-type').val(typeReq)

    if(typeReq == "infrastructure"){
      $.each(infrastructure, function(i, p){
        $('#select').append($('<option></option>').val(p).html(p))
      })
    }else if (typeReq == "equipment") {
      $.each(equipment, function(i, p){
        $('#select').append($('<option></option>').val(p).html(p))
      })
    }else if (typeReq == "medical") {
      $.each(medical, function(i, p){
        $('#select').append($('<option></option>').val(p).html(p))
      })
    }else if(typeReq == "legal") {
      $.each(legal, function(i, p){
        $('#select').append($('<option></option>').val(p).html(p))
      })
    }

    $('#select').change(function(){
      $('#otro').remove()
      if($(this).val()=='Otro'){
        $('.nodo').append('<div id="otro" class="form-group"><label for="otro" class="control-label">Ingrese su Requerimiento:</label><input class="form-control" name="customHelp" type="text" /></div>')
      }else{
        $('#otro').remove()
      }
    })
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
