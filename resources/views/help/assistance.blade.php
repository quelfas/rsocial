@extends('front.master')

@section('title','Accion requiere su confirmacion!!!')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">Reporta una Falla</li>
</ol>
@endsection

@section('content')
<div class="well">
  <h4>Informanos de algun Fallo</h4>
  <form action="">
    {!! csrf_field() !!}
    <div class="form-group">
      <input value="{{ $users->email }}" class="form-control" type="text" name="email" placeholder="Tu Email">
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
          $(".conteo").keyUp(function(){
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
@endsection
