<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/profile';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //create mail login confirmation

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        if ($validator->passes()){
            $data = $this->create($input)->toArray();

            $data['confirm_token'] = str_random(25);
            $user = User::find($data['id']);

            $user->confirm_token = $data['confirm_token'];

            $user->save();

            Mail::send('mails.confirmation', $data, function($massage) use($data){
                    $massage->to($data['email']);
                    $massage->subject('Registration confirmation');
            });
            return redirect(route('login'))->with('status', 'Confirmation email has been sent. Please, check your email.');
        }
        return redirect(route('login'))->with('status', $validator->errors());
    }

    public function confirmation($token)
    {
        $user = User::where('confirm_token', $token)->first();
        if(!is_null($user)){
            $user->confirmed = 1;

            $user->confirm_token = '';
            $user->save();
            return redirect(route('login'))->with('status', 'Your activation is completed');
        }
        return redirect(route('login'))->with('status', 'Something went wrong!!!');
    }
}
