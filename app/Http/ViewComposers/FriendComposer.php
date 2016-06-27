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
    $userRelv = array();
    $id_perfilesA = array();
    $id_perfilesB = array();

    $Recibidos    = UserRelation::where('user_id1',$id)
                          ->where('are_friends','Si')
                          ->get();

    $Solicitados  = UserRelation::where('user_id2',$id)
                          ->where('are_friends','Si')
                          ->get();

    /**
     * Contando ambos lados de las consultamos
     * $Solicitados->count() = $a
     * $Recibidos->count() = $b
     */

    
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

      /**
      * Suma de amistades como cabecera de la lista de amistades
      * Consulta de Amistades
      * * La miniatura es circular
      * * Debe cargarse en stack
      * Creando par de arreglo de id de amigos
      * para consultar perfiles mucho mas facil
      */

      foreach ($Solicitados as $value_Solicitados) {
        $id_perfilesA[] = $value_Solicitados->user_id1;
      }

      foreach ($Recibidos as $value_Recibidos) {
        $id_perfilesB[] = $value_Recibidos->user_id2;
      }

      /**
       * Haciendo Merge a lo solicitado y recibido como amistad a+b
       */

      $resultado = array_merge($id_perfilesA,$id_perfilesB);
      
      /**
       * Consultando perfiles
       */
      foreach ($resultado as $value) {
        $PerfiAmigo[] = Profile::where('user_id',$value)
                            ->get();
      }

      /**
       * Arreglo para salida
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
