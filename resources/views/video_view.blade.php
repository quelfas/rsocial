@extends('front.scaffold')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Perfil de '.$UserProfile->name.' '.$UserProfile->last_name)

  @section('content')

  <a class="btn btn-primary btn-xs" href="{{ url('user/' . $UserProfile->user_id . '/videos/ord/up') }}" role="button">Ver videos mas de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</a>

  <br>
  <br>

    @foreach($VideoContents as $VideoContent)
      <div class="well">
        <h3>{{ $VideoContent->created_at->day }}/{{ $VideoContent->created_at->month }}/{{ $VideoContent->created_at->year }} <small>{{ $VideoContent->tags }}</small></h3>
        <div class="embed-container">
          <iframe width="560" height="315" src="{{ $VideoContent->url_frame }}" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>

      <br>

      @can('update-content', $VideoContent)
        @include('utility.editorPanelSite')
      @endcan

      @can('superAdmin', $VideoContent)
        @include('utility.adminPanelSite')
      @endcan

    @endForeach
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
