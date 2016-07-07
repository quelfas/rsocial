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
    $Relations[] = UserRelation::where('user_id1', $id)
                      ->orWhere('user_id2', $id)
                      ->get();

    $amigos = array();
    foreach ($Relations as $key => $value) {
      foreach ($value as $relation) {
        if($relation->are_friends == 'StBy'){
          $amigos[] = 1;
        }
      }
    }

    if (count($amigos) == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  '0'
      ];
    } else {
      
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  count($amigos)
      ];
    }

    $view->with('UserRelation',$RelationSalida);
  }
}
