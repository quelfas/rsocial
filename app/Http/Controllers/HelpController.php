<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;
use Log;


class HelpController extends Controller
{

var $id_u;

  /**
  *
  **/
  public function assistance(){
    $user = Auth::user();
    return view('help.assistance')
      ->with([
        'users'=>$user
      ]);
  }

  /**
  *
  **/
  public function help(){
    return view('help.help');
  }
}
