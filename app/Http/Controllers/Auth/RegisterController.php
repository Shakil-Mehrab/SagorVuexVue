<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Str;
use Mail;
use App\Mail\EmailAuthenticaion;

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
            'name' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'integer'],
            'code_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
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
        $user= User::create([
            'name' => $data['name'],
            'country_id' => $data['country_id'],
            'countrycode_id' => $data['code_id'],
            'district_id' => $data['district_id'],
            'city_id' => $data['city_id'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'verifyToken' => Str::random(40),
            'password' => Hash::make($data['password']),
        ]);
        $thisUser=User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }
     public function sendEmail($thisUser)
    {
       Mail::to($thisUser['email'])->send(new EmailAuthenticaion($thisUser));
    }
    public function verifyEmailFirst()
    {
        return view('auth.verify');
    }
    public function sentEmailVerifying($email,$verifyToken)
    {
        $user=User::where('email',$email)->where('verifyToken',$verifyToken)->first();
        if($user){
            $user->status=1;
            $user->verifyToken=NULL;
            $user->update();
            return redirect('/login')->withSuccess("Registration Successfully Done");
        }else{return view('auth.verify')->withError("Authentication Not Done");}
    }
}