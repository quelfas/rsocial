@extends('front.scaffold')

@section('title','Involucrate')


@section('content')
<div class="page-header">
    <h2>Unete <small>Quieres ayudarnos hacer posible esta labor</small></h2>
</div>

<h3>10 Valores que hacen falta para participar</h3>

<p>El AMOR que es lo primordial para hacer las cosas, es una virtud que representa toda la bondad, compasión y  afecto del ser humano hacia otras personas.</p>

<p>EL RESPETO un valor que tenemos que tener siempre presente en nuestra vida. Al dirigirnos hacia las otras personas en nuestro trabajo o en cualquier lugar  donde nos encontremos,  respetar las decisiones de los demás...  el respeto nos ayuda a  crecer como mejor persona.</p>

<p>SOLIDARIDAD ayudar a las otras personas de cualquier manera  sin importa religiones, políticas culturas. Tenderle la mano al más necesitado sin esperar nada a cambio.</p>

<p>LA AMISTAD valor imprescindible en nuestras vida y en todo momentos ya sean  malos o buenos, la amistad siempre está basada en la confianza, fidelidad.</p>

<p>EQUIDAD últimamente en nuestra sociedad se menosprecia a las persona por no poseer un titulo, o por ser de  diferentes  clases sociales. Si rescatamos este valor dejaremos de mirar de lado a los personas que no tienen un título o una buena posición económica y así sabremos valorar a las personas por lo que son y no por lo que tienen.</p>

<p>LA RESPONSABILIDAD es un valor que debemos de tener siempre en cuenta a  hora de realizar nuestras actividades laboral, académicas o ya sea en el hogar. Ser  puntual  esto nos ayudara  a ser una persona ordenada.</p>

<p>SINCERIDAD siempre hay que hablar con la verdad y toda la sinceridad de mundo para no lastimarnos la sinceridad es la base fundamentar de todo.</p>

<p>PERSEVERANCIA es un valor que siempre lo tenemos que tener en cuenta a la hora de fijar una meta, lograr lo que nos proponemos. No decaer en la lucha  de algo que queremos lograr por eso se dice que el que persevera vence.</p>

<p>LA TOLERANCIA un valor muy importante, es indispensable para poder mantener relaciones con los demás. Es por la falta de tolerancia que los matrimonios se disuelven, las empresas no funcionan y las amistades son cada día más difíciles de mantener.</p>

<p>VALENTIA un Valor Excepcional para Admitir nuestros errores  y ratificarlos  así podremos comenzar con el proceso de cambio para ser mejor personas y por lo tanto hacia una mejor sociedad.</p>
<hr>
 <div class="panel panel-default">
  <div class="panel-body">
    <p class="lead">Quieres ayudarnos en esta labor? envianos un mensaje por las <a href="#redes">redes sociales</a> o usa nuestro formulario de contacto.</p>
  </div>
</div>

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
