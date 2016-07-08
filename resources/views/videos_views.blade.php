@extends('front.master')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Videos de '.$UserProfile->name.' '.$UserProfile->last_name)

  @section('breadcrumbs')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/user">tu Perfil</a></li>
    <li><a href="/profile/{{ $UserProfile->id }}">Perfil de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</a></li>
    <li class="active">Videos de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</li>
  </ol>
  @endsection

  @section('content')
  
  <div class="row">

    <table class="table table-striped">
        <tr>
          <th>Creado</th>
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
          <td><i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i> {{ $video->tags }}</td>
          @can('update-content', $UserProfile)
          <td>Editar Eliminar</td>
          @endcan

          @can('superAdmin', $UserProfile)
          <td>Editar Eliminar Desactivar</td>
          @endcan
        </tr>
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