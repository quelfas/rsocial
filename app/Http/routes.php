<?php

use Illuminate\Support\Facades\App;

/**
 * Rutas al Front
 **/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/somos',function(){
  return view('somos');
});

Route::get('/contacto',function(){
  return view('contact');
});

/**
 * Rutas para acceso
 **/

Route::get('/crear','Auth\AuthController@create');
Route::get('/accesar','Auth\AuthController@getlogin');
Route::get('/auth/login','Auth\AuthController@getlogin');
Route::post('/user-create',[
    'as'  =>'user-create',
    'uses'=>'Auth\AuthController@store'
  ]);
  Route::post('/accesar',[
      'as'  =>'accesar',
      'uses'=>'Auth\AuthController@postLogin'
    ]);

/**
 * Rutas bajo Auth 
 **/
Route::group(['middleware'=>'auth'], function($id){
  Route::resource('user', 'UserController');
  Route::resource('profile', 'ProfileController');
  Route::resource('relation', 'RelationController');
  Route::resource('videos', 'VideoController');
  Route::resource('upload', 'FileController',
    ['only' => ['store']]);
  Route::resource('content', 'ContentController');
  Route::get('/salir', 'Auth\AuthController@getLogout');
});
