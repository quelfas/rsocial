<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Facades
use Event;

//Evento
use App\Events\NewVideo;

//Models
use App\Videos;

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
        var $id_u;

        //Falta validar Request

        $this->id_u = Auth::user()->id;

        $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
        $restringido  = ($request->input('restringido') == "on") ? "Si" : "No";
        //ToDo diccionario de palabras reservadas para evitar abusos
        $tags         = $request->tags;

        $video = new Videos;

        $video->user_id   = $this->id_u;
        $video->url_frame = $request->source;
        $video->url_link  = $request->link;
        $video->privacy   = $privacy;
        $video->parental  = $restringido;
        $video->tags      = $tags;

        $video->save();

        //Fire event
        Event::fire(new NewVideo($video));

        $mensajeSalida = array(
              'mensaje' => 'Nuevo contenido guardado',
              'class'   => 'alert-success'
          );

        $videos = Videos::where('user_id', $this->id_u)
                              ->where('active','Si')
                              ->take(2)
                              ->get();

        if ($videos->count() == 0) {
          $videoSalida = "";
        } else {
          $videoSalida = $videos;
        }


        return redirect('user')->with(
        [
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
        //
        
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
