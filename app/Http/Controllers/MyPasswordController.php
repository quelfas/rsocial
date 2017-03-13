<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use DB;
use Log;


class MyPasswordController extends Controller{

var $id_u;

  public function pswUpDate($value='')
  {
      return view('pswUpdate');
  }
}
?>
