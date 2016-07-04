<div class="panel panel-default">
  <div class="panel-heading">

    <h3 class="panel-title"><img class="img-circle" width="50" height="50" src="{{ asset('assets/img/') }}/{{ $UserProfile->gender }}.png" alt="..."> {{ $UserProfile->name }} {{ $UserProfile->last_name }}</h3>

  </div>
  <div class="panel-body">

    @if($UserProfile->privacy === 'privado')
    <p>
      Este perfil es privado y solo muestra informacion basica.<br>
      <strong>Pais: </strong> <img src="{{ asset('assets/img/png/') }}/{{ $UserProfile->country }}.png" alt="{{ $UserProfile->country }}" /><br>
    </p>

    @else
      <p>Fecha de Nacimiento: {{ $UserProfile->birthdate->day }}/{{ $UserProfile->birthdate->month }}/{{ $UserProfile->birthdate->year }} </p>
      <p>Edad: {{ $UserProfile->birthdate->age }} Años</p>

    <address>
      <strong>Pais</strong>
      <img src="{{ asset('assets/img/png/') }}/{{ $UserProfile->country }}.png" alt="{{ $UserProfile->country }}" />
      <br>
      {{ $UserProfile->locale }}
      <br>
      <abbr title="Telefono">Tel:</abbr> {{ $UserProfile->phone }}
    </address>
    <blockquote>
      <p>{{ $UserProfile->bio }}</p>
    </blockquote>

    @endif

    @foreach($InfoRelations as $InfoRelation)
      <hr>
      <strong>Amigos desde</strong>
      <i class="fa fa-hand-o-right"></i>
      {{ $InfoRelation->created_at->day }}/{{ $InfoRelation->created_at->month }}/{{ $InfoRelation->created_at->year }}
      @if($InfoRelation->created_at->age > 1)
        {{ $InfoRelation->created_at->age }} años.
      @else

      @endif
    @endforeach

  </div>
</div>
