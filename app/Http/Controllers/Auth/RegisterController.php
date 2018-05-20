<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Rol;
use App\RolesUsers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:usuarios.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'documento' => 'required|unique:users,documento',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $usuario = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'documento' => $data['documento'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'estado' => '0',
            'password' => bcrypt($data['password']),
        ]);

        DB::table('role_user')->insert(
            ['role_id' => '3', 'user_id' => $usuario->id]
        );

        return $usuario;

    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);


        return $this->registered($request, $user)
                        ?: redirect('verUsuarios');
    }


}
