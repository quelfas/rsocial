<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;
use DB;

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

    /**
  	 * Consulta de Solicitudes de Ayuda realizadas
  	 *
  	 **/

  			 $helpRequests = DB::table('Help')
  									->where('user_id',$id)
  									->whereIn('status',["Creado","Procesado"])
  									->get();

  									//dd($helpRequests);
  			if (count($helpRequests)== 0) {
  				# Nunca ha realizado una solicitud de Ayuda
  				$helpRequests = 0;
  			}else{
          $helpRequests = count($helpRequests);
        }


  /**
   * Preparando la informacion para enviarla via injeccion de dependencias
   * a la vista "utility.notifySideBar.Blade"
   * update falta aumentar la vista para cargar las notificaciones de ayuda
   **/

    if (count($amigos) == 0) {
      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  '0',
        'Ayuda'     => $helpRequests
      ];
    } else {

      $RelationSalida = [
        'Cabecera'  =>  'Solicitudes Pendientes',
        'Contenido' =>  count($amigos),
        'Ayuda'     => $helpRequests
      ];
    }

    $view->with('UserRelation',$RelationSalida);
  }
}
