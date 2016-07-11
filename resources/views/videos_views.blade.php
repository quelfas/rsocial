@extends('front.master')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Videos de '.$UserProfile->name.' '.$UserProfile->last_name)
  @section('breadcrumbs')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/user">tu Perfil</a></li>
    <li><a href="/profile/{{ $UserProfile->user_id }}">Perfil de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</a></li>
    <li class="active">Videos de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</li>
  </ol>
  @endsection
  @section('content')
  
  <div class="row">

    <table class="table table-striped">
        <tr>
          <th><a href="/user/{{ $UserProfile->user_id }}/videos/ord/{{ ($orden == 'up')? 'down':'up' }}">Creado <i class="fa fa-caret-{{ ($orden == 'up')? 'down':'up' }}" aria-hidden="true"></i></a></th>
          <th>titulo</th>
          @can('update-content', $UserProfile)
          <th>Opciones</th>
          @endcan

          @can('superAdmin', $UserProfile)
          <th>Opciones de Administrador</th>
          @endcan
        </tr>

      @foreach($videos as $video)
        <tr>
          <td>{{ $video->created_at->day }} / {{ $video->created_at->month }} / {{ $video->created_at->year }}</td>
          <td><i class="fa fa-youtube-play" aria-hidden="true" style="color:red"></i><a href="#" data-toggle="modal" data-target=".bs-{{ $video->id }}-modal-lg">{{ $video->tags }}</a></td>
          @can('update-content', $UserProfile)
          <td>Editar Eliminar</td>
          @endcan

          @can('superAdmin', $UserProfile)
          <td>Editar Eliminar Desactivar</td>
          @endcan
        </tr>

        <div id="bs-{{ $video->id }}" class="modal fade bs-{{ $video->id }}-modal-lg" tabindex="-1" role="dialog" aria-labelledby="{{ $video->tags }}">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="embed-container">
                <iframe id="player-{{ $video->id }}" width="560" height="315" src="{{ $video->url_frame }}?enablejsapi=1&origin=http://uvsr.app&playerapiid=player-{{ $video->id }}" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>

        <script>

          $('#bs-{{ $video->id }}').on('hidden.bs.modal', function(e){
            /*----------  Salida de la consola para prueba  ----------*/
            //console.log('se disparo stopVideo para bs-{{ $video->id }}');
            
            $('#player-{{ $video->id }}')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
            
          });

        </script>

      @endforeach

    </table>

  </div>

  {!! $videos->render() !!}
  
  @endsection

@endforeach

@section('sidebar')
  @parent
    @include('utility.perfileSideBar')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection