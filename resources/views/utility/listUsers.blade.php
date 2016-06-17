<div class="panel panel-default">
	<div class="panel-heading">
	  <h3 class="panel-title">{{$UsersList['Titulo']}}</h3>
	</div>
	<div class="panel-body">
	  @if($UsersList['flag'] === false)
	    {{$UsersList['Contenido']}}
	  @else
	    @foreach ($UsersList['Contenido'] as $user)
	    <p><a href="{{url('profile', [$user->user_id])}}">{{ $user->name }} {{ $user->last_name }}</a></p>
	    @endforeach
	  @endif

	</div>
</div>