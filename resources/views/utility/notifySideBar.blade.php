<div class="panel panel-default">
  <div class="panel-heading">

    <h3 class="panel-title">Notificaciones</h3>

  </div>
  <div class="panel-body">

    <h4>Solicitudes de amistad</h4>
    <ul>

      <li><a href="/relation">{{$UserRelation['Cabecera']}} <sup><span class="badge alert-warning">{{$UserRelation['Contenido']}}</span></sup></a></li>

    </ul>

    <h4>Solicitudes de Ayuda</h4>

    <ul>
        <li><a href="@if($UserRelation['Ayuda'] === 0) /help @else /help-requested @endif">{{$UserRelation['Cabecera']}}<sup><span class="badge alert-warning">{{$UserRelation['Ayuda']}}</span></sup></a></li>
    </ul>

  </div>
</div>
