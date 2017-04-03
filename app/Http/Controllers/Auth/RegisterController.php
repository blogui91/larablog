<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Modules\Users\Src\Repositories\UserRepositoryInterface as User;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('Admin.auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activation_service, User $users)
    {
        $this->middleware('guest');
        $this->activation_service = $activation_service;
        $this->users = $users;
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            // 'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $fields = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ];
        
        // if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
        //     $fields['username'] = $data['username'];
        // }
        return $this->users->createModel()->create($fields);
    }

    /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //After user created we attach the role with id 2, in this case 'user.registered'
        $user->attachRole(2);
        //Send activation token via email
        $this->activation_service->sendActivationMail($user);

        return redirect('/login')->with('status', 'Te hemos enviado un código de activación. Verifica tu correo electrónico.');
    }

     /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
       
    }

    public function activateUser($token)
    {
        if ($user = $this->activation_service->activateUser($token)) {
            auth()->login($user);

            if($user->hasRole('admin')){
                $redirectTo = '/admin/dashboard';
            }
            
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    public function resendEmail($email)
    {
        $user = $this->users->where('email',$email)->first();
        if($user){
            $done = $this->activation_service->resendEmail($user);
            if($done){
                return redirect('/login')->with('status', 'Te hemos enviado un código de activación. Verifica tu correo electrónico.');
            }
        }
        return redirect('/login')->with('error', 'Este correo no se encuentra registrado.');
    }


}
