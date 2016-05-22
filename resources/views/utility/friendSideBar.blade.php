<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $UserFriends['Cabecera'] }} 
    <span class="badge alert-warning">{{ $UserFriends['Contenido'] }}</span>
    </h3>
  </div>
  <div class="panel-body">
    @forelse($friendDetail as $detail)
      <?php $detail = explode("-",$detail); ?>

      <a href="/profile/{{$detail[0]}}">

        <img id="{{ $detail[0] }}" 
        class="img-circle" 
        width="30" 
        height="30" 
        src="{{ asset('assets/img/') }}/{{ $detail[3] }}.png" 
        alt="{{ $detail[1] }} {{ $detail[2] }}" 
        data-toggle="tooltip" 
        data-placement="top" 
        title="{{ $detail[1] }} {{ $detail[2] }}">

      </a>
      
        &nbsp;
    @empty
    @endforelse
  </div>
</div>
