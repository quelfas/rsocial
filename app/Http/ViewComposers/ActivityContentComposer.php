<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\Subscription;
use App\Contents;

/**
 * Debemos cargar los id de Suscripciones con condicion 'active = Si'
 * Debemos cargar contenido a partir de las suscripcios activas
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
 * Uso de la Clausula avanzada whereIn para procesar el arreglo
 * $subscribe_id[]
 **/

			$contenido = Contents::whereIn('user_id',$subscribe_id)
								->where('privacy','publico')
								->orderBy('created_at','desc')
								->take(10)
								->get();


/**
 * Preparando la informacion para enviarla via injeccion de dependencias
 * a la vista "utility.activityContentBlade"
 * update falta aumentar la vista para cargar las notificaciones de ayuda
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
