<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;
use App\Profile;

/**
 *
 */
class ProfileComposer
{

  function compose(View $view)
  {
    /*-------------------------------------------------
    | consulta de la informacion del perfil de usuario
    /*------------------------------------------------*/
    $id = Auth::user()->id;
    $perfile = Profile::where('id',$id)->get();
    $view->with('UserProfiles',$perfile);
  }
}
