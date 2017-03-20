<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use Log;
use DB;


class HelpController extends Controller
{

var $id_u;

  /**
  *
  **/
  public function assistance(){
    $user = Auth::user();
    return view('help.assistance')
      ->with([
        'users'=>$user
      ]);
  }

  /**
  *
  **/
  public function help(){
    return view('help.help');
  }

  /**
  *
  **/
  public function storeRequest(Request $request){
    //
    //cargando info del usuario solicitante
    $user = Auth::user();
    $getId = DB::table('Help')->insertGetID([
      'user_id'=>$user->id,
      'solicitud'=>$request->recipient,
      'cod_req'=>$request->helprequest
    ]);
    Log::info("Se ha enviado una nueva solicitud");
    return view('help.help')
      ->with([
        'blockade'      => $request->recipient,
        'NumberRequest' => $getId,
      ]);
    //dd($request->all());
  }
}
