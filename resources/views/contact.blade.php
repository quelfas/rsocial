@extends('front.scaffold')

@section('title','Contactanos')

@section('content')
<div class="page-header">
    <h2>Contactanos <small>Ubicación y Contacto</small></h2>
</div>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#ubicanos" aria-controls="ubicanos" role="tab" data-toggle="tab">Estamos Ubicados</a></li>
    <li role="presentation"><a href="#contactanos" aria-controls="contactanos" role="tab" data-toggle="tab">Formulario de Contacto</a></li>
    {{--<li role="presentation"><a href="#social" aria-controls="social" role="tab" data-toggle="tab">Redes Sociales</a></li>--}}
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ubicanos">
      <br>
      <div class="well">
        <iframe width="100%" height="450px" frameborder="0" style="border:0"
          src="https://www.google.com/maps/embed/v1/view?key=AIzaSyCE-XNRgXPVLvJrhuOapp8ZhKPYUyIZZOQ&center=10.661111,-71.6475000&zoom=18&maptype=satellite">
        </iframe>
        <br>
        <address>
          <strong>Fundación Amigos en Ruedas (Fundaruedas).</strong><br>
          Sector Amparo, Avenida 29, 57B-382, Diagonal a la Iglesia Divino Niño<br>
          Edificio Venezuela Import Piso 1 Oficina 1 <br>
          Maracaibo, ZU. 4001<br>
          <abbr title="Telefono">TLF:</abbr> +58 (0261) 7325662
        </address>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="contactanos">
      <br>
      <div class="well">
        <h4>Deja tu mensaje</h4>
        <form action="/contact" method="POST">
          {!! csrf_field() !!}
          <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="Tu Email">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="nombre" placeholder="Nombre">
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
              {{-- agradecimientos a Sk8erPeter [URL:stackexchange.com/users/244701/sk8erpeter] por desarrollar este fragmento de codigo --}}
                $(".conteo").keyup(function(event){
                  var cmax = $("#rem_" + $(this).attr("id")).attr("title");
                  if($(this).val().length >= cmax){
                    $(this).val($(this).val().substr(0, cmax));
                  }

                  $("#rem_" + $(this).attr("id")).text(cmax - $(this).val().length);
                });
              </script>
            {{-- contador de caracteres --}}
            <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
          </div>
          <div class="form-group">
            {{-- espacio para recapcha --}}
            <button type="submit" class="btn btn-default btn-sm">Enviar</button>
          </div>
        </form>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="social">
      <p>
        Espacio para Redes Sociales
      </p>
    </div>
  </div>

</div>
{{-- fin de seccion de contacto --}}
 <hr>
 <div class="panel panel-default">
  <div class="panel-body">
    <p class="lead">Quieres ayudarnos en esta labor? envianos un mensaje por las <a href="#redes">redes sociales</a> o usa nuestro formulario de contacto.</p>
  </div>
</div>
@stop

@section('sidebar')
  @parent
  @unless(Auth::check())
    @include('utility.reg')
  @else
    @include('utility.perfilControl')
    @include('utility.notifySideBar')
    @include('utility.listUsers')
  @endunless

@endsection
