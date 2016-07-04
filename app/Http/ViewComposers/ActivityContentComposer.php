<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\UserRelation;
use App\Subscription;
use App\Contents;

/**
 * Debemos cargar los id de Subscripciones con condicion 'active = Si'
 * Debemos contar la cantidad de subscripciones activas
 * Debemos contar la cantidad de contenido existente
 * Debemos cargar contenido desde modelo Contents
 */
class ActivityContentComposer
{

	function compose(View $view){

		$id = Auth::user()->id;
		$subscripciones = Subscription::where('user_id', $id)
									->where('active',"Si")
									->get();

		//cuenta de subscripciones
		if ($subscripciones->count() == 0) {
			//no existen subscripciones activas

			$SubsSalida = [
				'Cabecera'		=> 'Canales',
				'Contenido' 	=> [],
				'Subscribed' 	=> []
			];

		}else {

			$subscribe_id = array();
			foreach ($subscripciones as $subscription) {

				$subscribe_id[] = $subscription->subscribe_id;

			}

/**
 * Consulta de contenido publico creado a traves de las suscripciones
 **/

			$contenido = Contents::whereIn('user_id',$subscribe_id)
								->where('privacy','publico')
								->orderBy('created_at','desc')
								->take(10)
								->get();

/**
 * Preparando la informacion para enviarla via injeccion de dependencias
 * a la vista "utility.activityContentBlade"
 **/

			$SubsSalida = [
				'Cabecera'		=> 'Canales',
				'Contenido' 	=> $contenido,
				'Subscribed' 	=> $subscribe_id
			];
		}

		$view->with(['Canales' => $SubsSalida]);

	}
}
