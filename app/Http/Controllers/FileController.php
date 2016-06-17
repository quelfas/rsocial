<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use App\Galery;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $rules = [
            'galeria'   =>'required|max:50'
        ];

        $message = [
            'max'       =>'El tamaño maximo es de 50 caracteres'
        ];

        $v = Validator::make($request->all(),$rules,$message);
          if ($v->fails()) {
                // mis vacaciones en holanda 2015
                //$errores    = $v->errors();
                $message[]  = "El campo Galeria es obligatorio y el tamaño maximo es de 50 caracteres"
                $errores    = json_encode($message);

            return response()->json([
                'success'       =>true,
                'message'       =>$errores
                ], 200);

          }

        //dd($request->file('file'));
        $message    = array();
        $path       = public_path().'/assets/upload/';
        $files      = $request->file('file');
        $galeria    = $request->input('galeria');
        $user       = Auth::user()->id;
        $privacy    = ($request->input('privacy') == "on") ? "privado" : "publico";
        foreach($files as $file){
            $fileName       = md5($file->getClientOriginalName()."*".time())."-".$file->getClientOriginalName();
            $fileRealName   = $file->getClientOriginalName();
            $fileSize       = $file->getSize();
            $fileMime       = $file->getMimeType();
            //faltan las comprobaciones y validaciones
            //validando las imagenes
            //*tipo de archivo imagen
            //*tamanio no mayor a 3mb

            //validando en el bucle foreach tamanio y mime antes de guardar y mover
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
                $message[]    = $fileRealName . " cargado exitosamente!!!";

                $galery = new Galery;

                $galery->user_id        = $user;
                $galery->galery_name    = $galeria;
                $galery->image_name     = $fileName;
                $galery->image_real     = $fileRealName;
                $galery->size           = $fileSize;
                $galery->type           = $fileMime;
                $galery->privacy        = $privacy;
                $galery->tags           = $request->input('tags');

                $galery->save();

                $file->move($path, $fileName);
            }else{
                $message[]    = $fileRealName . " no es un tipo de archivo valido o es mayor a 3MB";
            }


        }
        $errores    = json_encode($message);
        return response()->json([
            'success'       =>true,
            'message'       =>$errores
            ],200);
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
