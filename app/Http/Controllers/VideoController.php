<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Videos;
use Auth;

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
        //Falta validar Request

        $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
        $restringido  = ($request->input('restringido') == "on") ? "Si" : "No";

        $video = new Videos;

        $video->user_id   = Auth::user()->id;
        $video->url_frame = $request->source;
        $video->url_link  = $request->link;
        $video->privacy   = $privacy;
        $video->parental  = $restringido;
        $video->tags      = $request->tags;

        $video->save();

        $mensajeSalida = array(
              'mensaje' => 'Nuevo contenido guardado',
              'class'   => 'alert-success'
          );

        $videos = Videos::where('user_id',$id)
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
