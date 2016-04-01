@extends('front.master')

@section('title','Contactanos')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">Contacto</li>
</ol>
@endsection

@section('content')

{{-- inicio de seccion de contato --}}
{{-- secciones agrupadas en tabs [direccion] [formulario] --}}
  {{-- inicio de tabs --}}
    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#ubicanos" aria-controls="ubicanos" role="tab" data-toggle="tab">Estamos Ubicados</a></li>
    <li role="presentation"><a href="#contactanos" aria-controls="contactanos" role="tab" data-toggle="tab">Formulario de Contacto</a></li>
    <li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Redes Sociales</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ubicanos">
      <br>
      <div class="well">
        Estamos ubicados en Maracaibo Estado Zulia [mayor informacion]
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="contactanos">
      <br>
      <div class="well">
        <h4>Deja tu mensaje</h4>
        <form action="">
          {!! csrf_field() !!}
          <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="Tu Email">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="asunto" placeholder="Asunto">
          </div>
          <div class="form-group">

            <textarea class="conteo" name="mensaje" id="post" cols="82" rows="10"></textarea>
            {{-- contador de caracteres --}}
            <br>
            <small><span>Caracteres Restantes: <span id="rem_post" title="1000"></span></span></small>
              <script>
              {{-- agradecimientos a Sk8erPeter [URL:stackexchange.com/users/244701/sk8erpeter] por desarrollar el fragmento de codigo --}}
                $(".conteo").keyup(function(){
                  var cmax = $("#rem_" + $(this).attr("id")).attr("title");
                  if($(this).val().length >= cmax){
                    $(this).val($(this).val().substr(0, cmax));
                  }

                  $("#rem_" + $(this).attr("id")).text(cmax - $(this).val().length);
                });
              </script>
            {{-- contador de caracteres --}}
            <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
          </div>
          <div class="form-group">
            {{-- espacio para recapcha --}}
            <button type="submit" class="btn btn-default btn-sm">Enviar</button>

          </div>
        </form>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="social">...</div>
  </div>

</div>
{{-- fin de seccion de contacto --}}

@stop
