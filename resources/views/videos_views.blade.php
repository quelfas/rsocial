@extends('front.master')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Videos de '.$UserProfile->name.' '.$UserProfile->last_name)

  @section('breadcrumbs')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/user">tu Perfil</a></li>
    <li class="active">Videos de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</li>
  </ol>
  @endsection

  @section('content')
  
  <div class="row">

    <table class="table table-striped">
        <tr>
          <th>Creado</th>
          <th>Url</th>
          <th>Ver</th>
          <th>Opciones</th>
        </tr>

      @foreach($videos as $video)
        <tr>
          <td>{{$video->created_at}}</td>
          <td>{{$video->url_link}}</td>
          <td><a href="{{ url( 'videos/'. $video->id ) }}">Ver Video</a></td>
          <td></td>
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