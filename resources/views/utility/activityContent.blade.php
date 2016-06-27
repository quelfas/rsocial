<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $Canales['Cabecera'] }} <i class="fa fa-rss" aria-hidden="true"></i></h3>
  </div>
  <div class="panel-body">

    <script>
  		var pusher = new Pusher('10a2c2c5c95d816e54cf');
  		var channel = pusher.subscribe('Notify');
  		channel.bind('NewContent', function(data){
  			//console.log('nuevo evento '+ data.message);
  			$("#events ul").prepend('<li>' + data.event + '</li>');
  		});

  	</script>

  	<div id="events">
  		<ul>
        @forelse($Canales['Contenido'] as $contenido)
          @foreach($contenido as $contenido)
            <li><small><a href="/{{ $contenido->content_type}}/{{ $contenido->content_id }}">{{ $contenido->message }}</a></small></li>
          @endforeach
        @empty
        @endforelse
  			<li><small>Acceso Correcto</small></li>
  		</ul>
  	</div>

  </div>
</div>
