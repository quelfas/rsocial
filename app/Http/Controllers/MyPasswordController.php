<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use Log;


class MyPasswordController extends Controller
{

var $id_u;

  protected function pswUpDate()
  {
      return view('pswUpdate');
  }

  protected function pswStore(Request $request)
  {
    //

  $user = Auth::user();

  $validation = Validator::make($request->all(), [

    // Here's how our new validation rule is used.
    'passwordOld' => 'hash:' . $user->password,
    'password' => 'required|different:passwordOld|confirmed'
  ]);

  if ($validation->fails()) {
    return redirect()->back()->withErrors($validation->errors());
  }

  $user->password = Hash::make($request->input('password'));
  $user->save();
  $error = "El usuario [".$user->name."], modifico su clave";
  Log::info($error);
  return redirect()->back()
    ->with('success-message', 'Nueva clave creada');
  }
}
