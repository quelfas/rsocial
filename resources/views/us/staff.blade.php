@extends('front.scaffold')

@section('title','Nuestro equipo')


@section('content')
<div class="page-header">
    <h2>Fundación Amigos en Ruedas <small>Fundaruedas</small></h2>
</div>
<p>Inicialmente estamos constituidos en una fundación sin fines de lucros de formación reciente, enfocados en dar prioridad a las personas con condicion de discapacidad</p>
<h4>Organización</h4>
<p>
    <strong>Sr. Omer Luzardo</strong> - Presidente<br>
    Registro Conapdis: D-169418
    <br>
    <br>
    <strong>Sra. Yuselis Fereira</strong> - Vicepresidente<br>
    <br>
    <br>
    <strong>Sr. Gilberson Luzardo</strong> - Director Principal<br>
    <br>
    <br>
    <strong>Srta. Gilbelys Luzardo</strong> - Tesorera<br>
    <br>
    <br>
    <strong>Sr. Carlos Guillen</strong> - Dirección de Sistemas<br>
    <br>
    <br>
    <strong>Dr. José Felix Martinez</strong> - Departamento Legal<br>
    <br>
    <br>
</p>

@stop

@section('sidebar')
  @parent
  @unless(Auth::check())
    @include('utility.reg')
  @else
    @include('utility.notifySideBar')
    @include('utility.listUsers')
  @endunless

@endsection