<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

//Facades
use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\UserRelation;
use App\Profile;
use App\Subscription;

class RelationController extends Controller
{
    var $id;
    $this->id = Auth::user()->id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultamos los user_id2 ya que esta columna es de Solicitudos

        $solicitudesRecibidas = DB::table('profiles')
        ->join('UserRelation', function($join){
          $join->on('profiles.user_id', '=', 'UserRelation.user_id1')
          ->where('UserRelation.user_id2', '=', $this->id)
          ->where('are_friends', '=', 'StBy');
        })->get();
        //dd($solicitudesRecibidas);
        if (!empty($solicitudesRecibidas)) {
          return view('relations')->with('recibidos',$solicitudesRecibidas);
        } else {
          return redirect('/');
        }

        //dd($solicitudesRecibidas);
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
        //dd($request->input());
        $this->id = Auth::user()->id;
        UserRelation::create([
          'user_id1'    =>$this->id,
          'user_id2'    =>$request->input('user_id2'),
          'are_friends' =>'StBy'
        ]);

        /*
        * Estableciendo la subscripcion a los eventos
        * Convencion de consultas
        * 'id', -> id de registro
        * 'user_id', -> usuario que solicita la subscripcion
        * 'subscribe_id', -> usuario al que se le consultara su canal o canales
        * 'active', -> No hasta que se acepte la solicitud
        */

        $subscribe = new Subscription;

        $subscribe->user_id       = $this->id;
        $subscribe->subscribe_id  = $request->input('user_id2');
        $subscribe->active        = "No";

        $subscribe->save();

        $users = Profile::where('user_id',$request->input('user_id2'))->get();

        foreach ($users as $user) {
          $user = $user->name.' '.$user->last_name;
        }

        $mensajeSalida = array(
              'mensaje' => 'Solicitud de Amistad enviada a '.$user,
              'class'   => 'alert-success'
          );



        return view('user')->with('mensaje',$mensajeSalida);
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
        //dd($request->input("solicitud-".$request->input("_id")));

        $this->id = Auth::user()->id;
        DB::table( 'UserRelation' )
            ->where( 'user_id2', $this->id )
            ->where( 'user_id1', $request->input("_id") )
            ->update([
              'are_friends' => $request->input("solicitud-".$request->input("_id"))
            ]);

      if ($request->input( "solicitud-".$request->input("_id") ) == "SI") {
        $respuesta  = "aceptada";
        $style      = "success";

        /*
        * Actualizando la subscripcion generada
        * cuando se creo la solicitud de amistad
        */

        DB::table( 'Subscription' )
            ->where( 'user_id', $request->input("_id") )
            ->update([
              'active' => "Si"
            ]);

        /**
        * Estableciendo la subscripcion a los eventos
        * Convencion de consultas
        * 'id', -> id de registro
        * 'user_id', -> usuario que solicita la subscripcion
        * 'subscribe_id', -> usuario al que se le consultara su canal o canales
        * 'active', -> por defecto SI
        **/

        $subscribe = new Subscription;

        $subscribe->user_id       = $this->id;
        $subscribe->subscribe_id  = $request->input("_id");

        $subscribe->save();

      }else {
        $respuesta  = "rechazada";
        $style      = "warning";
      }

        $mensajeSalida = array(
              'mensaje' => 'Solicitud de Amistad '.$respuesta,
              'class'   => 'alert-'.$style
          );



        return view('relations')->with(['recibidos'=>"",'mensaje'=>$mensajeSalida]);
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
