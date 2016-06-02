<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
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
        
        //dd($request->file('file'));
        $path = public_path().'/assets/upload/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName       = md5($request->input('galeria'))."-".$file->getClientOriginalName();
            $fileRealName   = $file->getClientOriginalName();
            $fileSize       = $file->getSize();
            $fileMime       = $file->getMimeType();
            $privacy      = ($request->input('privacy') == "on") ? "privado" : "publico";
            //faltan las comprobaciones y validaciones
            $galery = new Galery;

            $galery->user_id        = Auth::user()->id;
            $galery->galery_name    = $request->input('galeria');
            $galery->image_name     = $fileName;
            $galery->image_real     = $fileRealName;
            $galery->size           = $fileSize;
            $galery->type           = $fileMime;
            $galery->privacy        = $privacy;
            $galery->tags           = $request->input('tags');

            $galery->save();

            $file->move($path, $fileName);
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
