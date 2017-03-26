@extends('front.master')

@section('title','Historial de Solicitudes')

@section('breadcrumbs')
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li class="active">Histrial de Solicitudes</li>
</ol>
@endsection

@section('content')
<div class="well">
  <h4>Historial de solicitudes</h4>

  <table class="table table-striped">
    <tr>
      <th>Solicitud No.</th>
      <th>Area</th>
      <th>Solicitud</th>
      <th>Fecha</th>
      <th></th>
    </tr>
    @foreach($creadas as $creada)
    <tr>
      <td>{{ $creada->id }}</td>
      <td>{{ $creada->solicitud }}</td>
      <td>{{ $creada->cod_req }}</td>
      <td>{{ $creada->created_at }}</td>
      <td>
        <form action="#" method="POST">
          {!! csrf_field() !!}
          <input type="hidden" name="_method" value="PATCH">
          <input type="hidden" name="id" value="{{ $creada->id }}">
          <input class="btn btn-default btn-xs" type="submit" value="Finalizar">
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection

@section('sidebar')
  @parent
    @include('utility.perfilControl')
    @include('utility.friendSideBar')
    @include('utility.notifySideBar')
    @include('utility.activityContent')
    @include('utility.listUsers')
    @include('utility.formCondition')
@endsection
