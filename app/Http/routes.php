<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//rutas al front
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
//rutas al front



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

/*
|--------------------------------------------------------------------------
| Rutas protegidas por AuthController
|--------------------------------------------------------------------------
|
|
*/
Route::group(['middleware'=>'auth'],function($id){
  Route::resource('user', 'UserController');
  Route::resource('profile', 'ProfileController');
  Route::resource('relation', 'RelationController');
  Route::resource('videos', 'VideoController');
  Route::resource('upload', 'FileController',
    ['only' =>['store']]);
  Route::get('/salir', 'Auth\AuthController@getLogout');
});
