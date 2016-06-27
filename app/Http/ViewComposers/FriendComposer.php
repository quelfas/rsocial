<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;
use App\UserRelation;
use App\Profile;

/**
 *
 */
class FriendComposer
{

  function compose(View $view)
  {
    /*-------------------------------------------------
    | consulta de la informacion del perfil de usuario
    /*------------------------------------------------*/
    $id = Auth::user()->id;
    $userRelv = array();
    $id_perfilesA = array();
    $id_perfilesB = array();

    $Recibidos = UserRelation::where('user_id1',$id)
                              ->where('are_friends','Si')
                              ->get();
    $Solicitados = UserRelation::where('user_id2',$id)
                              ->where('are_friends','Si')
                              ->get();

    /*
    * contando ambos lados de las consultamos
    * $Solicitados->count() = $a
    * $Recibidos->count() = $b
    */
    //dd($Solicitados);
    //dd($Recibidos);
    $a = $Solicitados->count();
    $b = $Recibidos->count();
    $ResultSum = $a + $b;

    if ($ResultSum == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Amistades',
        'Contenido' =>  '0'
      ];
      $detalle[] = "S/I";
    } else {
      /*
      * Suma de amistades como cabecera de la lista de amistades
      ** consulta de Amistades
      ** *la miniatura es circular
      ** *deber cargarse en stack
      * creando par de arreglo de id de amigos
      * para consultar perfiles mucho mas facil
      */

      foreach ($Solicitados as $value_Solicitados) {
        $id_perfilesA[] = $value_Solicitados->user_id1;
      }

      foreach ($Recibidos as $value_Recibidos) {
        $id_perfilesB[] = $value_Recibidos->user_id2;
      }

      //dd($id_perfilesA);

      /*
      * Haciendo Merge a lo solicitado y recibido como amistad a+b
      */
      $resultado = array_merge($id_perfilesA,$id_perfilesB);
      //dd($resultado);
      /*
      * **consultando perfiles
      */
      foreach ($resultado as $value) {
        $PerfiAmigo[] = Profile::where('user_id',$value)
                              ->get();
      }

      /*
      * arreglo para salida
      */
      foreach ($resultado as $key => $value) {
        $detalle[] = $PerfiAmigo[$key][0]['user_id']."-".$PerfiAmigo[$key][0]['name']."-".$PerfiAmigo[$key][0]['last_name']."-".$PerfiAmigo[$key][0]['gender'];
      }

      $RelationSalida = [
        'Cabecera'  =>  'Amistades',
        'Contenido' =>  $ResultSum
      ];
    }

    $view->with(['UserFriends'=>$RelationSalida,'friendDetail'=>$detalle]);
  }

}
