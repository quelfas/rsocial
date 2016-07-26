<div class="panel panel-default">
  <div class="panel-heading">

  @forelse($UserProfiles as $UserProfile)
    {{ $UserProfile->name }} {{ $UserProfile->last_name }}
  @empty
    Crea un Prefil
  @endforelse

  </div>
  <div class="panel-body">
    
    <h4>Opciones de cuenta</h4>
    <ul class="list-group">
    	<li class="list-group-item"><a href="#">Editar Perfil</a></li>
    	<li class="list-group-item"><a href="#">Cambiar Contraseña</a></li>
    	<li class="list-group-item"><a href="#">Desactivar cuenta</a></li>
    </ul>

    <h4>Requerimientos</h4>
    <ul class="list-group">
    	<li class="list-group-item"><a href="#">Asistencia Tecnica</a></li>
    	<li class="list-group-item"><a href="#">Ayuda Especializada</a></li>
    </ul>
    
	<p class="text-right"><a href="/salir">Salir</a></p>

  </div>
</div>