<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Models
use App\Profile;
use App\UserRelation;
use App\Videos;

class UserController extends Controller
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
        return view('user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $mensajeSalida = [
              'mensaje'=>'Mensaje de Prueba',
              'class'=>'alert-success'
      ];
        return view('users')->with('mensaje',$mensajeSalida);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //iniciando la validacion del $request->input()

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

    /**
     * Display all video from user
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function listVideo($id)
    {
        //dd($id);

        $this->id_u = Auth::user()->id;

        /**
         * Paso para carga de video
         * Verificar si el id existe
         * Si no existe sale el abort 404
         * Verificar si los usuarios tienen relacion establecida
         * Carga del Recurso Video mostrando 10 videos por pagina
         * Verificar si el visitante es el mismo id [sale la vista ampliada]
         */

        $user = Profile::where('user_id',$id)->get();

        //Si el id no existe sale un abort 404
        if ($user->isEmpty()) {
            abort(404,'Not Found');
        }


        $video = Videos::where('user_id',$id)
                            ->paginate(5);

        //
       // dd($video);
        if($this->id_u == $id){
            //Se carga vista ampliada
        }else{
            //se verifica si el visitante y el autor tienen relacion

            //Verificar si tienen relacion
            $relaciones = UserRelation::where('user_id1',$this->id_u)
                                            ->orWhere('user_id2',$this->id_u)
                                            ->where('are_friends','Si')
                                            ->get();
            //dd($relaciones);
            foreach ($relaciones as $relacion) {
                /**
                 *
                 *   TODO:
                 *   - cruzar los campos para colicionar $id
                 *   - verificar si tiene relacion
                 *   - Si la tiene verificar el estado de la relacion
                 * 
                 **/

                if ($relacion->user_id1 == $id && $relacion->user_id2 == $this->id_u) {
                    
                    //echo" se ha creado el ".$relacion->created_at." por parte de ".$this->id_u;

                } elseif($relacion->user_id2 == $id && $relacion->user_id1 == $this->id_u) {
                    
                    //echo" se ha creado el ".$relacion->created_at." por parte de ".$id;

                }
                
                
            }

            return view('videos_views')->with(['videos'=>$video,'UserProfiles'=>$user]);

        }
        
    }
    
}
