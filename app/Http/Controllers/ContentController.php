<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DB;
use Log;

//models
use App\Galery;
use App\Contents;

class ContentController extends Controller
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
        //
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
        //confirmando que el contenido esta "no activo"
        $models = Contents::where('id',$id)
                          ->get();
        foreach($models as $model){
            if($model->active == "Si"){
                //
                $mensajeSalida = [
    						'mensaje'=>'Se procede a borrar la galeria ' . $model->tags,
    						'class'=>'alert-success'
    				];
                DB::table('Contents')
                    ->where('id',$id)
                    ->update(['active'=>'No']);
            } else {
                //
                $mensajeSalida = [
    						'mensaje'=>'La Galeria ' . $model->tags . ' no esta disponible',
    						'class'=>'alert-info'
    				];
            }
        }
        //return $mensaje;
        return view('cautivo')->with('mensaje',$mensajeSalida);
    }

    /**
     * change the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchPrivacy($id)
    {
        //
        $models = Contents::where('id',$id)
                          ->get();

        foreach($models as $model){
            if($model->privacy == "privado"){
                //
                $mensajeSalida = [
    						'mensaje'   =>'La galeria ' . $model->tags . ' ahora es publica',
    						'class'     =>'alert-info'
    				];
                DB::table('Contents')
                    ->where('id',$id)
                    ->update(['privacy' =>'publico']);
            } else {
                //
                $mensajeSalida = [
    						'mensaje'   =>'La galeria ' . $model->tags . ' ahora es privada',
    						'class'     =>'alert-info'
    				];
                DB::table('Contents')
                    ->where('id',$id)
                    ->update(['privacy' =>'privado']);
            }
        }
        //return $mensaje;
        return view('cautivo')->with('mensaje',$mensajeSalida);
    }
}
