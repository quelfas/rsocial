<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;
use App\UserRelation;
use App\Profile;

/**
 *
 */
class RelationComposer
{

  function compose(View $view)
  {
    /*-------------------------------------------------
    | consulta de la informacion del perfil de usuario
    /*------------------------------------------------*/
    $id = Auth::user()->id;
    $userRelv = array();
    $Relations = UserRelation::where('user_id2','=',$id)
                              ->where('are_friends','=','StBy')
                              ->get();

    if ($Relations->count() == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  '0'
      ];
    } else {
      $userRelv = $Relations->count();
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  $userRelv
      ];
    }

    $view->with('UserRelation',$RelationSalida);
  }
}
