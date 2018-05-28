<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use \App\Mail\confirmation_user;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Brian2694\Toastr\Facades\Toastr;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'codigoempleado' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }



      protected function create(array $data)
      {
        //$data['confirmation_code'] = str_random(25);
          $user= User::create([
              'codigoempleado' => $data['codigoempleado'],
              'name' => $data['name'],
              'puesto_id' => 1,
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'confirmation_code' => str_random(25)
          ]);
            //enviar correo de confirmacion
            Mail::to($user->email)
            ->send(new confirmation_user($user));
            Toastr::success('Usuario Creado Satisfactoriamente :)' ,'Success');
            return $user;
      }

      /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (config('auth.users.confirm_email') && !$user->confirmed) {

            $this->guard()->logout();

            //$user->notify(new ConfirmEmail());

            return redirect(route('login'));
        }
    }

}
