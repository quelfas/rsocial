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

Route::get('/donations',function(){
  return view('donations');
});

Route::get('/gallery',function(){
  return view('gallery');
});

Route::get('/events',function(){
  return view('event');
});

Route::get('/contact',function(){
  return view('contact');
});

/**
 * Rutas para quienes somos -front
 **/

Route::get('/sponsored',function(){
  return view('us.sponsored');
});

Route::get('/godparents',function(){
  return view('us.godparents');
});

Route::get('/supportUs',function(){
  return view('us.supportUs');
});

Route::get('/staff',function(){
  return view('us.staff');
});

Route::get('/joinUs',function(){
  return view('us.joinUs');
});

/**
 * Rutas para acceso
 **/
Route::get('/crear','Auth\AuthController@create');
Route::get('/accesar','Auth\AuthController@getlogin');
Route::get('/auth/login','Auth\AuthController@getlogin');
Route::post('/user-create',[
    'as'    => 'user-create',
    'uses'  => 'Auth\AuthController@store'
  ]);
  Route::post('/accesar',[
      'as'    => 'accesar',
      'uses'  => 'Auth\AuthController@postLogin'
    ]);

/**
 * Route Control
 **/
Route::get('profile/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('user/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('relation/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('videos/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('upload/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('content/{id}', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

Route::get('user/{id}/videos/ord{name}', function($id, $name){
  abort(406, 'Not Acceptable');
})->where([
  'id'    => '\D+',
  'name'  => '\W'
]);

/*----------  usuario con condicion (con discapacidad)  ----------*/
Route::get('user/{id}/condition', function($id){
  abort(406, 'Not Acceptable');
})->where('id','\D+');

/*----------  busqueda de condicion (con discapacidad)  ----------*/
Route::get('condition/{name}', function($name){
  abort(406, 'Not Acceptable');
})->where('name','\W+');

/**
 * Rutas bajo Auth
 **/
Route::group(['middleware'=>'auth'], function($id){

  Route::get('user/{id}/videos/ord/{slug}','UserController@listVideo');

  Route::post('/condition',[
      'as'    => 'condition',
      'uses'  => 'UserController@storeCondition'
    ]);

  Route::post('/terminate',[
      'as'    => 'terminate',
      'uses'  => 'RelationController@endApplication'
    ]);

  Route::get('user/{id}/condition', 'UserController@condition');

  Route::resource('user', 'UserController');
  Route::resource('profile', 'ProfileController');
  Route::resource('relation', 'RelationController');
  Route::resource('videos', 'VideoController');
  Route::resource('upload', 'FileController',
    ['only' => ['store']]);
  Route::resource('content', 'ContentController');
  Route::get('/salir', 'Auth\AuthController@getLogout');
});
