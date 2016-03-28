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
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Estamos Ubicados</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Formulario de Contacto</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Redes Sociales</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      Estamos ubicados en Maracaibo Estado Zulia [mayor informacion]
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
      <form action="">
        {!! csrf_field() !!}
        <div class="form-group">

          <label class="form-control">Su Email</label>
          <input type="text" name="email">

        </div>
        <div class="form-group">

          <label class="form-control">Asunto</label>
          <input type="text" name="asunto">

        </div>
        <div class="form-group">

          <label class="form-control">Mensaje</label>
          <textarea name="mensaje" id="" cols="30" rows="10"></textarea>

        </div>
        <div class="form-group">
          {{-- espacio para recapcha --}}
          <button type="submit" class="btn btn-default btn-sm">Enviar</button>

        </div>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">...</div>
  </div>

</div>
{{-- fin de seccion de contacto --}}

@stop