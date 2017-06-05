<div class="panel panel-default">
  <div class="panel-heading">

  <h4>Opciones de cuenta</h4>

  </div>
  <div class="panel-body">


    <ul class="list-group">
    	<li class="list-group-item"><a href="/profile/{{ Auth::user()->id }}/edit">Editar Perfil</a></li>
    	<li class="list-group-item"><a href="/psw-update">Cambiar Contraseña</a></li>
    	{{--<li class="list-group-item"><a href="#">Desactivar cuenta</a></li>--}}
        @forelse ($conditions as $condition)
        <li class="list-group-item"><a href="/help">Ayuda Especializada</a></li>
        @empty
        <li class="list-group-item">Ayuda Especializada <a id="condiciones" role="button" data-toggle="popover" title="CONDICIÓN ESENCIAL" data-content="Debes Ingresar tu Discapacidad."><i class="fa fa-question-circle" aria-hidden="true"></i></a></li>
        @endforelse
    	<li class="list-group-item"><a href="/assistance">Asistencia Tecnica</a></li>
    </ul>

	<p class="text-right"><a href="/salir">Salir</a></p>

  </div>
</div>
