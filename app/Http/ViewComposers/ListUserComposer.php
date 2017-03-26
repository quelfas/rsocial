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
        "Titulo"    => "Actividades Pendientes",
        "Contenido" => "Crea un Perfil",
        "flag"      => false
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

      $relaciones = UserRelation::where('user_id1',$id)
                      ->orWhere('user_id2',$id)
                      ->get();

      $id_perfiles = array();

      foreach ($relaciones as $relacion) {
        /*----------  excluyendose asi mismo  ----------*/
        if($relacion->user_id1 == $id){

          $id_perfiles[] = $relacion->user_id2;

        }elseif($relacion->user_id2 == $id){

          $id_perfiles[] = $relacion->user_id1;

        }else{
          $id_perfiles[] = null;
        }
       
      }

      /**
       * Consulta de perfiles disponibles
       * excluyendo a los amigos y a si mismo
       */
      

      $array0     = [$id];
      $arrayId    = array_merge($array0, $id_perfiles);
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
