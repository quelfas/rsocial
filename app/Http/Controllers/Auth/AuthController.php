<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Log;
use Validator;
use Mail;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//Models
use App\User;
use App\Contents;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create()
    {
      $mensajeSalida = [
              'mensaje'=>'Al crear una cuenta dentro de Una Vida Sobre Ruedas
              esta aceptando los Terminos y Condiciones, asi como tambien las
              Politicas de Privacidad y trato de informacion privada que maneja
              Una Vida Sobre Ruedas.',
              'class'=>'alert-info'
      ];
        return view('users')->with('mensaje',$mensajeSalida);
    }

    protected function store(Request $request)
    {
      //
      $rules = [
          'name'      => 'required|max:255',
          'email'     => 'required|email|max:255|unique:users',
          'password'  => 'required|confirmed|min:6',
      ];

      $v = Validator::make($request->all(),$rules);
      if ($v->fails()) {
        return redirect()
          ->back()
          ->withErrors($v->errors());
      }

        /**
         * User::create([
         *   'name'      => $request->input('name'),
         *   'email'     => $request->input('email'),
         *   'password'  => bcrypt($request->input('password')),
         * ]);
         **/
         Carbon::setLocale('es');
         $now = Carbon::now();
         
         $id_content = DB::table('users')->insertGetId(
                    [
                    'name'          => $request->input('name'),
                    'email'         => $request->input('email'),
                    'password'      => bcrypt($request->input('password')),
                    'created_at'    => $now,
                    'updated_at'    => $now
                    ]
                );
        
        /**
         * Evento de Nueva Cuenta
         */
        if($id_content){
        
        DB::table('Contents')->insert(
                    [
                      'user_id'        => $id_content,
                      'content_type'   => "Account",
                      'content_id'     => $id_content,
                      'privacy'        => "publico",
                      'message'        => "Nueva Cuenta|Haz creado una nueva Cuenta|Ha creado una nueva Cuenta",
                      'tags'           => "Cuenta Nueva",
                      'active'         => "Si",
                      'created_at'     => $now,
                      'updated_at'     => $now
                    ]
              );
         /**
          * Si se creo el un usuario, enviamos un mail para confirmar
          */
        
        $data = [
            'email'             => $request->input('email'),
            'confirmation_code' => md5($id_content),
            'name'              => $request->input('name')
            ];
        
        $dataMail = $data['email'];
        $dataName = $data['name'];
        
        Mail::send('emails.confirm', $data, function ($message) use ($dataMail,$dataName) {
             $message->from('webmaster@fundaruedas.org', 'Una Vida Sobre Ruedas');
       
             $message->to($dataMail, $dataName)->subject('Confirma tu correo');
           });
           /*
            * @endif($id_content)
            */
         }
        $mensajeSalida = [
    		'mensaje'=>'Se ha creado con exito el usuario:
                '.$request->input('email').'. Por defecto la cuenta se
                encuentra inactiva revise su email y siga las instrucciones,
                luego Ingrese su usuario y su clave para acceder',
    		'class'=>'alert-success'
    	];
        return view('cautivo')->with('mensaje',$mensajeSalida);
    }

    protected function getLogin()
    {
      return view('login')->with('mensaje',null);
    }

    protected function postLogin(Request $request)
    {
      $rules = [
        'EmailLog' => 'required|email|max:255',
        'PasswordLog' => 'required'
      ];

      $v = Validator::make($request->all(),$rules);

      if ($v->fails()) {
        return redirect()
          ->back()
          ->withErrors($v->errors());
      }

      $acceso = Auth::attempt([
        'email'=>$request->input('EmailLog'),
        'password'=>$request->input('PasswordLog'),
        'active'=>'Y'
      ]);

      if ($acceso) {
        $user = Auth::user();
        /**
        * envio de aviso de acceso de user
        **/
           Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
             $message->from('webmaster@fundaruedas.org', 'Una Vida Sobre Ruedas');
       
             $message->to($user->email, $user->name)->subject('Nuevo Acceso');
           });


        Log::info('Nuevo acceso de: '.$user['email']);
        $mensajeSalida = [
    		'mensaje'   => 'Credenciales correctas. Bienvenido '. $user['name'],
    		'class'     => 'alert-success'
    	];
        return redirect('user')->with('mensaje',$mensajeSalida);
      }else {
        $mensajeSalida = [
                'mensaje'   =>'Usuario o Clave no coinciden, revise los datos ingresados. Verifique que activo su cuenta',
                'class'     =>'alert-danger'
        ];
        return view('login')->with('mensaje',$mensajeSalida);
      }
    }

    protected function getLogout()
    {
    	$mensajeSalida = [
                'mensaje'   =>'Desconectado del Sistema',
                'class'     =>'alert-success'
        ];
    			
    	Auth::logout();
    	return view('login')->with('mensaje',$mensajeSalida);
    }
    
    /*
     * Confirm Account
     * verificamos si la cuenta ya esta confirmada
     * confirm = true redirect to login
     */
    
    public function confirmAccount($email, $token) {
        /*
         * Colicionando email con FILTER_SANITIZE_EMAIL
         */
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if(filter_var($emailSanitize, FILTER_VALIDATE_EMAIL)=== false || $email != $emailSanitize){
            abort(406, "Contenido no aceptable");
        }
        
        /**
         * el email es valido buscamos su modelo
         */
        $userForCheck = User::where('email', $email)
                ->where('active', 'N')
                ->get();
        
        /*
         * el modelo no existe
         */
        if(!$userForCheck){
            abort(406, "Contenido no aceptable");
        }
        
        /*
         * colicionando $userCheck
         */
        foreach ($userForCheck as $userCheck){
            if (md5($userCheck->id) == $token) {
                DB::table('users')
                        ->where('id', $userCheck->id)
                        ->update(['active'=>'Y']);

                $mensajeSalida = [
                    'mensaje'   =>'Cuenta Verificada y Activada',
                    'class'     =>'alert-success'
                ];
                return view('login')->with('mensaje',$mensajeSalida);
            }else{
                abort(406, "Contenido no aceptable");
            }
        }
    }
}
