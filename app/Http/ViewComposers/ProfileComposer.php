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

    $id = Auth::user()->id;
    
    $perfile = Profile::where('user_id',$id)->get();

    $condition = Discapacidad::where('user_id',$id)->get();
    
    $view->with([
    	'UserProfiles'	=> $perfile, 
    	'conditions' 	=> $condition
    	]);    

  }
}
