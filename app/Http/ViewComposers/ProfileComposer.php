<?php namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;
use Auth;

//Models
use App\Profile;
use App\Discapacidad;


class ProfileComposer
{

  function compose(View $view)
  {

    /**
     * Consulta de la informacion del perfil de usuario
     * Consulta de Condicion de Discapacidad del usuario
     */

    $idActive = Auth::user()->id;
    
    $perfile = Profile::where('user_id',$idActive)->get();

    $condition = Discapacidad::where('user_id',$idActive)->get();
    
    $view->with([
    	'UserProfiles'	=> $perfile, 
    	'conditions' 	      => $condition
    	]);    

  }
}
