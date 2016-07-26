<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\UserRelation;
use App\Profile;


class FriendComposer
{

  function compose(View $view)
  {
    /**
     * Consulta de la informacion del perfil de usuario
     */
    $id = Auth::user()->id;

    /**
     * Uso de 2-way search quedo sin uso por obsoleto y sin sentido
     * mejor opcion orWere() del ORM Eloquent
     */
    
    $relaciones = UserRelation::where('user_id1',$id)
                      ->orWhere('user_id2',$id)
                      ->get();

    
  

    if ($relaciones->count() == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Amistades',
        'Contenido' =>  '0'
      ];
      $detalle[] = "S/I";
    } else {

      /**
      * Suma de amistades como cabecera de la lista de amistades
      * Consulta de Amistades
      * La miniatura es circular
      * Debe cargarse en stack
      */
//dd($relaciones);
      $id_perfiles = array();
      foreach ($relaciones as $relacion) {

        /*----------  excluyendose asi mismo  ----------*/

        if($relacion->user_id1 == $id && $relacion->are_friends == 'Si'){

          $id_perfiles[] = $relacion->user_id2;

        }elseif($relacion->user_id2 == $id && $relacion->are_friends == 'Si'){

          $id_perfiles[] = $relacion->user_id1;
          
        }
       
      }

      //dd($id_perfiles);

      if (count($id_perfiles) == 0) {
        $RelationSalida = [
          'Cabecera'  =>  'Amistades',
          'Contenido' =>  '0'
        ];
      $detalle[] = "S/I";
      } else {
        /**
         * Consultando perfiles
         */

        foreach ($id_perfiles as $value) {
          $PerfiAmigo[] = Profile::where('user_id',$value)
                              ->get();
        }

        /**
         * Arreglo para salida a las vista utility.friendSideBar.blade.php
         */
        foreach ($id_perfiles as $key => $value) {
          $detalle[] = $PerfiAmigo[$key][0]['user_id']."-".$PerfiAmigo[$key][0]['name']."-".$PerfiAmigo[$key][0]['last_name']."-".$PerfiAmigo[$key][0]['gender'];
        }

        $RelationSalida = [
          'Cabecera'  =>  'Amistades',
          'Contenido' =>  count($id_perfiles)
        ];
      }
      
    }

    $view->with(['UserFriends'=>$RelationSalida,'friendDetail'=>$detalle]);
  }

}
