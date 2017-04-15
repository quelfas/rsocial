<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

//Models
use App\Galery;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //redireccionames a index
        return redirect()->route('/home');
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
        //validation rules
        $rules = ['galeria'=>'required|max:50'];

        Carbon::setLocale('es');
        $now = Carbon::now();

        $message = ['max'       =>'El tamaño maximo es de 50 caracteres'];

        $v = Validator::make($request->all(),$rules,$message);

          if ($v->fails()) {
                $message[]  = "El campo Galeria es obligatorio y el tamaño maximo es de 50 caracteres";
                $errores    = json_encode($message);

            return response()->json([
                'success'       =>true,
                'message'       =>$errores
                ], 200);

          }

        $message    = array();
        $path       = public_path().'/assets/upload/';
        $files      = $request->file('file');
        $galeria    = $request->input('galeria');
        $user       = Auth::user()->id;
        $privacy    = ($request->input('privacy') == "on") ? "privado" : "publico";
        $id_content = [];



        foreach($files as $file) {
            $fileName       = md5($file->getClientOriginalName()."*".time())."-".$file->getClientOriginalName();
            $fileRealName   = $file->getClientOriginalName();
            $fileSize       = $file->getSize();
            $fileMime       = $file->getMimeType();

            /**
             * ToDo
             * Faltan las comprobaciones y validaciones (Validate)
             * Done!!!
             * validando las imagenes (via mime)
             * tipo de archivo imagen
             * tamanio no mayor a 3mb
             * validacion en el bucle foreach tamanio y mime antes de guardar y mover
             **/

            switch ($fileMime) {
                case 'image/jpeg':
                    $paso = true;
                    break;

                case 'image/jpg':
                    $paso = true;
                    break;

                case 'image/JPG':
                    $paso = true;
                    break;

                case 'image/bmp':
                    $paso = true;
                    break;

                case 'image/png':
                    $paso = true;
                    break;

                case 'image/gif':
                    $paso = true;
                    break;

                default:
                    $paso = false;
                    break;
            }

            if ($paso && $fileSize <= 3000000) {
              /**
              * Por cada proceso acertado el id es capturado en un arreglo para
              * la creacion del nuevo registro en la tabla contenidos
              **/
                $message[]    = $fileRealName . " cargado exitosamente!!!";
                /**
                * $galery = new Galery;

                * $galery->user_id        = $user;
                * $galery->galery_name    = $galeria;
                * $galery->image_name     = $fileName;
                * $galery->image_real     = $fileRealName;
                * $galery->size           = $fileSize;
                * $galery->type           = "Galery";
                * $galery->privacy        = $privacy;
                * $galery->tags           = $request->input('tags');

                * $galery->save();
                **/

                $idGalery = DB::table('Galery')->insertGetId(
                          [
                          'user_id'        => $user,
                          'galery_name'    => $galeria,
                          'image_name'     => $fileName,
                          'image_real'     => $fileRealName,
                          'size'           => $fileSize,
                          'type'           => "Galery",
                          'privacy'        => $privacy,
                          'tags'           => $request->input('tags'),
                          'created_at'     => $now,
                          'updated_at'     => $now
                        ]
                      );


                $file->move($path, $fileName);
                array_push($id_content, $idGalery);
            } else {
                $message[]    = $fileRealName . " no es un tipo de archivo valido o es mayor a 3MB";
            }


        }
        /**
        * Verificamos si el arrego esta vacio para poder crear el contenido
        * Creamos el nuevo contenido en la tabla Contents
        **/
        if (count($id_content) == 0) {
          # el array esta vacio no metemos nada
        } else {

          $id_content = implode("-",$id_content);
          DB::table('Contents')->insert(
              [
                'user_id'        => $user,
              	'content_type'   => 'Galery',
              	'content_id'     => $id_content,
              	'privacy'        => $privacy,
              	'message'        => 'Nueva galeria|Haz creado una nueva galeria|Ha creado una nueva galeria',
              	'tags'           => $galeria, //nombre de la galeria, no los tags
              	'active'         => '1',
                'created_at'     => $now,
                'updated_at'     => $now
              ]
          );
        }

        $errores    = json_encode($message);
        /*return response()->json([
            'success'       =>true,
            'message'       =>$errores
            ],200);*/
        
        //prueba de retorno a vista
        return redirect()->route('profile',[$user]);
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
