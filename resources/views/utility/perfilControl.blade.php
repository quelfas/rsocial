<div class="panel panel-default">
  <div class="panel-heading">

  <h4>Opciones de cuenta</h4>

  </div>
  <div class="panel-body">


    <ul class="list-group">
    	<li class="list-group-item"><a href="/profile/{{ Auth::user()->id }}/edit">Editar Perfil</a></li>
    	<li class="list-group-item"><a href="/psw-update">Cambiar Contraseña</a></li>
    	<li class="list-group-item"><a href="#">Desactivar cuenta</a></li>
    	<li class="list-group-item"><a href="#">Asistencia Tecnica</a></li>
    	<li class="list-group-item"><a href="#">Ayuda Especializada</a></li>
    </ul>

	<p class="text-right"><a href="/salir">Salir</a></p>

  </div>
</div>
