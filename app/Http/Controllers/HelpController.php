<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use Log;
use DB;

//models
use App\Profile;

class HelpController extends Controller
{


  /**
  *
  **/
  public function assistance()
  {
    $user = Auth::user();
    return view('help.assistance')
      ->with([
        'users'=>$user
      ]);
  }

  /**
  *
  **/
  public function help()
  {
    return view('help.help');
  }

  /**
  * consultas de solicitudes creadas
  * consultas de solicitudes procesadas
  * consultas de solicitudes finalizadas
  **/
  public function helpRequested()
  {

    $user = Auth::user();
    /**
    * consulta de solicitudes creadas
    **/
    $creado     = DB::table('Help')
              ->where('user_id',$user->id)
              ->where('status','Creado')
              ->get();

    /**
    * consulta de solicitudes procesadas
    **/
    $procesado  = DB::table('Help')
              ->where('user_id',$user->id)
              ->where('status','Procesado')
              ->get();

    /**
    * consulta de solicitudes finalizadas
    **/
    $finalizado = DB::table('Help')
              ->where('user_id',$user->id)
              ->where('status','Finalizado')
              ->get();


    return view('help.helplist')
              ->with([
                'creadas'     =>$creado,
                'procesadas'  =>$procesado,
                'finalizadas' =>$finalizado
              ]);
  }

  
  public function storeRequest(Request $request)
  {
    //
    //cargando info del usuario solicitante
    //dd($request->input('recipient'));


    if($request->input('helprequest') == "Otro") {
      $requestHelp = $request->input('customHelp');
      $rules = [
          'customHelp'  => 'required|min:5|max:55',
      ];

      $v = Validator::make($request->all(),$rules);
      if ($v->fails()) {
        return redirect()
          ->back()
          ->withErrors($v->errors());
      }
    } else {
      $requestHelp = $request->input('helprequest');
    }

    $now = Carbon::now();
    $user = Auth::user();
    $getId = DB::table('Help')->insertGetID([
      'user_id'     =>  $user->id,
      'solicitud'   =>  $request->input('recipient'),
      'cod_req'     =>  $requestHelp,
      'created_at'  => $now,
      'updated_at'  => $now
    ]);
    /**
    * Comprobando si su perfil es publico
    **/
    $perfiles = Profile::where('user_id',$user->id)->get();
    foreach ($perfiles as $perfile) {
      if ($perfile->privacy == "privado") {
        DB::table('profiles')
          ->where('user_id', $user->id)
          ->update([
            'privacy'     => "publico"
          ]);
      }
    }

    Log::info("Se ha enviado una nueva solicitud");
    $mensajeSalida = [
            'mensaje'   =>  "Su ". $request->input('recipient') ." tiene el numero ". $getId .". Su perfil ahora es de caracter publico.",
            'class'     =>  'alert-info'
    ];
    return redirect('user')->with('mensaje',$mensajeSalida);
  }
}
