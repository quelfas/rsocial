<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\Profile;
use App\UserRelation;


class ListUserComposer
{

  function compose(View $view)
  {
    /**
     * consulta de la informacion del perfil de usuario
     */
    $id = Auth::user()->id;

    $UserPerfil = Profile::where('user_id',$id)
                  ->get();
    $ShowCount = $UserPerfil->count(); //verificar si el perfil esta creado

    if ($UserPerfil->count() == 0) {
      $ContentSalida = [
        "Titulo"    =>"Actividades Pendientes",
        "Contenido" =>"Crea un Perfil",
        "flag"      =>false
      ];
    } else {

      /**
       * Perfil creado!
       * consultando en funcion del pais
       */

      foreach ($UserPerfil as $UserDetail) {
        $pais = $UserDetail->country;
      }

      /**
       * Consulta de la lista de amigos para no ser incluidos en la lista para nuevos amigos
       */

      $LtR = UserRelation::where('user_id1',$id)
                  ->get();

      $array1     = array();
      foreach ($LtR as $value) {
        $array1[] = $value->user_id2;
      }

      $RtL = UserRelation::where('user_id2',$id)
                  ->get();

      $array2     = array();
      foreach ($RtL as $value) {
        $array2[] = $value->user_id1;
      }

      $array0     = [$id];
      $arrayId    = array_merge($array0,$array1,$array2);
      $UsersList  = Profile::where('country',$pais)
                      ->whereNotIn('user_id',$arrayId)
                      ->get();

      if ($UsersList->count() == 0) {
        $ContentSalida = [
          "Titulo"    =>"Como Podemos Ayudar",
          "Contenido" =>"Ayudamos donando y haciendole publicidad a este proyecto",
          "flag"      =>false
        ];
        
      } else {
        $ContentSalida = [
          "Titulo"    =>"Personas para Conectar",
          "Contenido" =>$UsersList,
          "flag"      =>true
        ];
      }



    }

    /**
     * $perfile = 'lista de usuarios desde el proveedor de servicios';
     */

    $view->with('UsersList',$ContentSalida);
  }
}
