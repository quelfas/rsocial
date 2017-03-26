<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Log;

//Model
use App\Profile;
use App\UserRelation;
use App\Videos;
use App\Discapacidad;
use App\Galery;

class ProfileController extends Controller
{
  var $id_u;

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
     * 'user_id',
     * 'name',
     * 'last_name',
     * 'birthdate',
     * 'gender',
     * 'country',
     * 'locale',
     * 'phone',
     * 'privacy',
     * 'bio'
     */
    public function store(Request $request)
    {
        //

        $this->id_u = Auth::user()->id;

        $rules = [
          'name'      =>'required|min:3|max:80',
          'last_name' =>'required|min:3|max:80',
          'birthdate' =>'required',
          'gender'    =>'required',
          'country'   =>'required',
          'locale'    =>'required|max:100',
          'phone'     =>'required|max:12',
          //'privacy'   =>'required', //Comentado por efectos del control
          //'connections'   =>'required', //Comentado por efectos del control
          'bio'       =>'required|max:1000'
        ];

        $v = Validator::make($request->input(),$rules);

        if ($v->fails()) {

          return redirect()->back()->withErrors($v->errors());

        } else {

          $birthdate    = explode("/",$request->input('birthdate'));
          $birthdate    = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
          $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
          $connections  = ($request->input('connections') == "on") ? "Si" : "No";
          Profile::create([
            'user_id'     => $this->id_u,
            'name'        => ucfirst($request->input('name')),
            'last_name'   => ucfirst($request->input('last_name')),
            'birthdate'   => $birthdate,
            'gender'      => $request->input('gender'),
            'country'     => $request->input('country'),
            'locale'      => ucfirst($request->input('locale')),
            'phone'       => $request->input('phone'),
            'privacy'     => $privacy,
            'connections' => $connections,
            'bio'         => $request->input('bio')
          ]);

          $mensajeSalida = array(
        				'mensaje' => 'Perfil creado, gracias por tomarte este tiempo',
        				'class'   => 'alert-success'
        		);



          return redirect('user')->with('mensaje',$mensajeSalida);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $this->id_u = Auth::user()->id;

        /**
        * Verificar si el perfil es visible
        * Verificar si el usuario que pide el perfil esta vinculado
        **/

        $perfile = Profile::where('user_id',$id)->get();

        //volverlo reutilizable
        if ($perfile->isEmpty()) {
            abort(404, 'Not Found');
        }

        //es requerido una tabla de contenido para llevar control cronologico del contenido creado
        $videos = Videos::where('user_id',$id)
                        ->where('active','Si')
                        ->take(5)
                        ->get();

        $Discapacidad = Discapacidad::where('user_id',$id)
                                    ->get();


        if ($id == $this->id_u) {

          return view('myprofile')->with(
              [
                  'UserProfiles'  => $perfile,
                  'VideoContents' => $videos
              ]);

        } else {

          $photoPerfil = Galery::where('user_id',$id)
                                      ->where('type','perfile-up')
                                      ->get();


            //paso 2. Determinar si son amigos por medio de 2-way search
            /**/
             $Recibidos      = UserRelation::where('user_id1',$id)
                                 ->where('user_id2',$this->id_u)
                                 ->where('are_friends','Si')
                                 ->get();
             $Solicitados    = UserRelation::where('user_id2',$id)
                                  ->where('user_id1',$this->id_u)
                                  ->where('are_friends','Si')
                                  ->get();

             $a          = $Solicitados->count();
             $b          = $Recibidos->count();
             $ResultSum  = $a + $b;

            if($ResultSum == 0){

                $RelationOn = 'No';

                $infoRelation = '';
            }else{

                $RelationOn = 'Si';

                if ($a == 0) {
                    $infoRelation = $Recibidos;
                }

                if ($b == 0) {
                    $infoRelation = $Solicitados;
                }
            }

            return view('profile')->with(
                [
                    'UserProfiles'  => $perfile,
                    'UserRelations' => $RelationOn,
                    'InfoRelations' => $infoRelation,
                    'VideoContents' => $videos,
                    'Discapacidad'  => $Discapacidad,
                    'PhotoPerfil'   => $photoPerfil
                ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Verificando que el id de usuario solicitado
        //sea el mismo que esta autentificado
        $this->id_u = Auth::user()->id;
        if ($this->id_u == $id) {
          //return"es correcto";
          //cargamos la vista con la consulta de los valores
          //para actualizar
          $perfile = Profile::where('user_id',$this->id_u)->get();
          //dd($perfile);

          $photoPerfil = Galery::where('user_id',$this->id_u)
                                      ->where('type','perfile-up')
                                      ->get();
          return view('editBio')->with(
              [
                  'UserProfiles'  => $perfile,
                  'PhotoPerfil'   => $photoPerfil,
              ]);
        } else {
          if (Auth::user()->role == "admin") {
            return"Esta accediendo con derechos de Administrador";
          } else {
            //return"es incorrecto";
            //retorno un recurso al log de operaciones
            $error = "el usuario ID[".$this->id_u."] intento acceder al recurso de edicion del Usuario ID[".$id."]";
            Log::alert($error);
            abort(406,'Not acceptable');
          }
        }


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
        $atencion = ".";
        $rules = [
          'name'      =>'required|min:3|max:80',
          'last_name' =>'required|min:3|max:80',
          'birthdate' =>'required',
          'gender'    =>'required',
          'country'   =>'required',
          'locale'    =>'required|max:100',
          'phone'     =>'required|max:12',
          //'privacy'   =>'required', //Comentado por efectos del control
          //'connections'   =>'required', //Comentado por efectos del control
          'bio'       =>'required|max:1000'
        ];

        $v = Validator::make($request->input(),$rules);

        if ($v->fails()) {

          return redirect()->back()->withErrors($v->errors());

        } else {

          $birthdate    = explode("/",$request->input('birthdate'));
          $birthdate    = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];

          /**
          * Comprobando si tiene solicitudes de ayuda cargadas
          **/
          $this->id_u   = Auth::user()->id;
          $helpRequests = DB::table('Help')
              ->where('user_id',$this->id_u)
              ->where('status',"Creado")
              ->get();
          if (count($helpRequests) == 0) {
            # no posee abierto ningun caso podra actualizar su estado de privacidad
            $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
            $atencion = ". Tiene abierta solicitud(es) de ayuda en este momento su perfil es publico por defecto.";
          } else {
            # posee abierto al menos un caso y no podra actualizar su estado de privacidad
            $privacy      = "publico";
          }


          $connections  = ($request->input('connections') == "on") ? "Si" : "No";

        //
          DB::table( 'profiles' )
            ->where('user_id', $this->id_u)
            ->update([
              'name'        => ucfirst($request->input('name')),
              'last_name'   => ucfirst($request->input('last_name')),
              'birthdate'   => $birthdate,
              'gender'      => $request->input('gender'),
              'country'     => $request->input('country'),
              'locale'      => ucfirst($request->input('locale')),
              'phone'       => $request->input('phone'),
              'privacy'     => $privacy,
              'connections' => $connections,
              'bio'         => $request->input('bio')
            ]);

            //retornamos una vista con mensaje
            $mensajeSalida = [
              'mensaje' => 'Perfil actualizado' . $atencion,
              'class'   => 'alert-success'
            ];



            return redirect('user')->with('mensaje',$mensajeSalida);
        }
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
