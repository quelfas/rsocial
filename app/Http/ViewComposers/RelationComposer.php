<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\UserRelation;
use App\Profile;

class RelationComposer
{

  function compose(View $view)
  {

    $id = Auth::user()->id;


    /**
     * Verificamos si se han confirmado amistad
     */
    $userRelv = array();
    $Relations = UserRelation::where('user_id1', $id)
                      ->orWhere('user_id2', $id)
                      ->where('are_friends', '=', 'StBy')
                      ->get();

    if ($Relations->count() == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  '0'
      ];
    } else {
      
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  $Relations->count()
      ];
    }

    $view->with('UserRelation',$RelationSalida);
  }
}
