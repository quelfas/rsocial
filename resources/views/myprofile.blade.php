@extends('front.master')
@foreach ($UserProfiles as $UserProfile)
  @section('title','Perfil de '.$UserProfile->name.' '.$UserProfile->last_name)

  @section('breadcrumbs')
  <ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/user">tu Perfil</a></li>
    <li class="active">Perfil de {{ $UserProfile->name }} {{ $UserProfile->last_name }}</li>
  </ol>
  @endsection

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
