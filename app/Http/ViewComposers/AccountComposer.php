<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;

/**
 * models
 */
use Auth;
use DB;
class AccountComposer
{

  public function compose(View $view)
  {
    if (Auth::check()) {
      //dd(Auth::user()->profile);
      /*----------------------------------------------------------------------/*
      | Se verifica que el usuario este logeado
      | luego se envian los datos basico de cuenta
      | Se envia el Rol
      ------------------------------------------------------------------------*/
      $userId       = Auth::user()->id;
      $userName     = (Auth::user()->role == "user") ? "". Auth::user()->name : "[" . strtoupper(Auth::user()->role) . "]" . Auth::user()->name;
      $userEmail    = Auth::user()->email;
      $useActivo    = True;
      $userRole     = strtoupper(Auth::user()->role);
    } else {
      $userId     = null;
      $userName   = null;
      $userEmail  = null;
      $useActivo  = null;
      $userRole   = null;
    }

    //contando los usurios registrados en la plataforma

    $contados     = DB::table('users')->where('active','Y')->count();
    $solicitudes  = DB::table('Help')->where('status','Creado')->count();
    $entregadas   = DB::table('Help')->where('status','Procesado')->count();

    $view->with([
      'userId'      => $userId,
      'userName'    => $userName,
      'userEmail'   => $userEmail,
      'useActivo'   => $useActivo,
      'userRole'    => $userRole,
      'contados'    => $contados,
      'solicitudes' => $solicitudes,
      'entregadas'  => $entregadas
    ]);

  }
}
