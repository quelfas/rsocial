@extends('front.scaffold')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Perfil de '.$UserProfile->name.' '.$UserProfile->last_name)

  @section('content')
    @foreach($VideoContents as $VideoContent)
      <div class="well">
        <h3>{{ $VideoContent->created_at->day }}/{{ $VideoContent->created_at->month }}/{{ $VideoContent->created_at->year }} <small>{{ $VideoContent->tags }}</small></h3>
        <div class="embed-container">
          <iframe width="560" height="315" src="{{ $VideoContent->url_frame }}" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    @endForeach
  @endsection

@endforeach

@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
@endsection
