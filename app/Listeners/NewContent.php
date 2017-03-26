<?php

namespace App\Listeners;

use App\Events\NewVideo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

//Facedes
use Log;

//Models
use App\Contents;
use App\Profile;

class NewContent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewVideo  $event
     * @return void
     */
    public function handle(NewVideo $event)
    {
        //
            //$id = Auth::user()->id;
            $perfiles = Profile::where('user_id',$event->video->user_id)->get();

            foreach ($perfiles as $perfil) {
                $name       = $perfil->name;
                $last_name  = $perfil->last_name;
            }
            
            $content = new Contents;

            $content->user_id       = $event->video->user_id;
            $content->content_type  = 'videos';
            $content->content_id    = $event->video->id;
            $content->privacy       = $event->video->privacy;
            $content->message       = $name.' '.$last_name.' publico un nuevo Video';
            $content->tags          = $event->video->tags;

            $content->save();

        Log::info('funciona el Listener con el registro numero '. $content->id);

        /**
         * Comprobando si el nuevo contenido es publico o privado
         * De ser privado no habra propagacion
         **/

        if($event->video->privacy == 'privado'){
            /**
             * El contenido es privado no habra propagacion
             **/
        }else{

            /**
             * Nueva instancia de Pusher
             **/
            $pusher = App::make('pusher');

            /**
             * Se dispara evento hacia Pusher con lo siguiente:
             * 'emiter'   = Emisor que sera filtrado en el front para que solo los suscritos reciban la emision
             * 'event'    = Evento "mensaje emitido"
             * 'payLoad'  = carga util del evento
             **/

            $pusher->trigger( 
                        'Notify',
                        'NewContent', 
                      array(
                        'emiter'  => $event->video->user_id,
                        'event'   => $name . ' ' . $last_name.' publico un nuevo Video',
                        'payLoad' => 'videos/' . $event->video->id,
                        ));
        }

    }
}
