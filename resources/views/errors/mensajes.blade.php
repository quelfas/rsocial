@if(!$mensaje)

@else
  <div class="alert {{ $mensaje['class'] }} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{$mensaje['mensaje']}}
  </div>
@endif
