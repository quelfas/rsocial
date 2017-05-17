<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

//Facades
use Event;

//Evento
use App\Events\NewVideo;

//Models
use App\Videos;
use App\Profile;
use App\UserRelation;

class VideoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //Utilitarios
        Carbon::setLocale('es');
         $now = Carbon::now();
        /**
         * Validaciones
         */
        $pattern = '#((?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9-]*))#i';
        $valid = preg_match($pattern, $request->source);
        if (!$valid) {
            abort(406,"Contenido no aceptable");
        }

        $user = Auth::user()->id;

        $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
        $restringido  = ($request->input('restringido') == "on") ? "Si" : "No";
        //ToDo diccionario de palabras reservadas para evitar abusos
        $tags         = $request->tags;

        /**
         * @Video
         */
        $id_content = DB::table('Videos')->insertGetId(
                    [
                        'user_id'    => $user,
                        'url_frame'  => $request->source,
                        'url_link'   => $request->nameId,
                        'privacy'    => $privacy,
                        'parental'   => $restringido,
                        'tags'       => $tags,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
        
        /**
         * @Contents
         */
        if($id_content){
        
        DB::table('Contents')->insert(
                    [
                      'user_id'        => $user,
                      'content_type'   => "videos",
                      'content_id'     => $id_content,
                      'privacy'        => $privacy,
                      'message'        => "Nuevo Video|Haz cargado un Nuevo Video|Ha cargado nuevo Video",
                      'tags'           => $tags,
                      'active'         => "Si",
                      'created_at'     => $now,
                      'updated_at'     => $now
                    ]
              );
         }
        /**
         * @Event
         */
       // Event::fire(new NewVideo($video));

        $mensajeSalida = array(
              'mensaje' => 'Nuevo contenido guardado',
              'class'   => 'alert-success'
          );

        $videos = Videos::where('user_id', $user)
                              ->where('active','Si')
                              ->take(2)
                              ->get();

        if ($videos->count() == 0) {
          $videoSalida = "";
        } else {
          $videoSalida = $videos;
        }


        return redirect('user')->with([
          'mensaje'=>$mensajeSalida,
          'VideoContents' => $videoSalida
        ]
      );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


      $user = Auth::user()->id;

      $videos = Videos::where('id',$id)->get();

      //volverlo reutilizable
      if ($videos->isEmpty()) {
          abort(404, 'Not Found');
      }

      //cargando el perfil de usuario propietario del Recurso

      foreach ($videos as $video) {
        $propietario = $video->user_id;
      }

      $perfile = Profile::where('user_id',$propietario)->get();

      /**
       * Uso de busqueda en base a orWhere
       */
      $relaciones = UserRelation::where('user_id1', $user)
                                  ->orWhere('user_id2', $user)
                                  ->where('are_friends', 'Si')
                                  ->get();

      if ($relaciones->count() == 0) {

        $RelationOn   = 'No';
        $infoRelation = '';

      } else {

        $RelationOn   = 'Si';
        $infoRelation = $relaciones;

      }


       return view('video_view')->with(
           [
               'UserProfiles'  => $perfile,
               'UserRelations' => $RelationOn,
               'InfoRelations' => $infoRelation,
               'VideoContents' => $videos
           ]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
