<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\Galery;

class PhotoController extends Controller
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

        $path       = public_path().'/assets/upload/';
        $file      = $request->file('file');
        $galeria    = "perfil";
        $user       = Auth::user()->id;
        $privacy    = "off";
        $mensajeSalida = [];

        //foreach($files as $file){
            $fileName       = md5($file->getClientOriginalName()."*".time())."-".$file->getClientOriginalName();
            $fileRealName   = $file->getClientOriginalName();
            $fileSize       = $file->getSize();
            $fileMime       = $file->getMimeType();
            //dd($fileName);
            /**
             * ToDo
             * Faltan las comprobaciones y validaciones (Validate)
             * Done!!!
             * validando las imagenes (via mime)
             * tipo de archivo imagen
             * tamanio no mayor a 3mb
             * validacion en el bucle foreach tamanio y mime antes de guardar y mover
             */

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
                //$message[]    = $fileRealName . " cargado exitosamente!!!";

                /**
                * la imagen anterior que este up pasa a down
                * falta adecuar el form
                * falta crear la pieza de codigo que apaga la imagen de perfil activa
                **/
                //determinando si existe alguna imagen activa
                $oldGalery = DB::table('Galery')
                            ->where('user_id',$user)
                            ->where('type','perfile-up')
                            ->get();

                if(count($oldGalery) == 1){
                  $downGalery = DB::table('Galery')
                              ->where('id',$oldGalery[0]->id)
                              ->update([
                                'type' =>'perfile-down'
                              ]);
                }

                $galery = new Galery;

                $galery->user_id        = $user;
                $galery->galery_name    = $galeria;
                $galery->image_name     = $fileName;
                $galery->image_real     = $fileRealName;
                $galery->size           = $fileSize;
                $galery->type           = "perfile-up";
                $galery->privacy        = $privacy;
                $galery->tags           = "perfil";

                $galery->save();

                $file->move($path, $fileName);

                $mensajeSalida = [
                  'mensaje' => 'Perfil actualizado',
                  'class'   => 'alert-success'
                ];

            }else{
              $mensajeSalida = [
                'mensaje' => 'no es un tipo de archivo valido o es mayor a 3MB',
                'class'   => 'alert-info'
              ];

            }


        //}






        return redirect('user')->with('mensaje',$mensajeSalida);
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
