<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\UserRelation;
use App\Videos;

class ProfileController extends Controller
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
        //dd($request->all());
        $rules = [
          'name'      =>'required|min:3|max:80',
          'last_name' =>'required|min:3|max:80',
          'birthdate' =>'required',
          'gender'    =>'required',
          'country'   =>'required',
          'locale'    =>'required|max:100',
          'phone'     =>'required|max:12',
          //'privacy'   =>'required', Comentado por efectos del control
          //'connections'   =>'required',Comentado por efectos del control
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
            'user_id'     => Auth::user()->id,
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
        //

        $user_id = Auth::user()->id;
        //paso 1. Determinar si el $ID es Publico o Privado
        $perfile = Profile::where('user_id',$id)->get();

        //es requerido una tabla de contenido para llevar control cronologico del contenido creado
        $videos = Videos::where('user_id',$id)
                            ->where('active','Si')
                            ->take(5)
                            ->get();

        if ($id == $user_id) {

          return view('myprofile')->with(
              [
                  'UserProfiles'  => $perfile,
                  'VideoContents' => $videos
              ]);

        } else {


            //paso 2. Determinar si son amigos por medio de 2-way search
            $Recibidos      = UserRelation::where('user_id1',$id)
                                  ->where('user_id2',$user_id)
                                  ->where('are_friends','Si')
                                  ->get();
            $Solicitados    = UserRelation::where('user_id2',$id)
                                  ->where('user_id1',$user_id)
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
                    'VideoContents' => $videos
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
