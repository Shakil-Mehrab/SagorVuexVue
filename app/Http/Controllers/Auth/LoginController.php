<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Mail\EmailAuthenticaion;

class LoginController extends Controller
{ 
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutResponse($request);
        }
               if($this->guard()->validate($this->credentials($request))){
                $user=$this->guard()->getLastAttempted();
                if($user->status && $this->attemptLogin($request)){
                    return $this->sendLoginResponse($request);
                }
              
               else{
                $this->incrementLoginAttempts($request);
                // $user->verifyToken=Str::random(40);
                // if($user->save()){
                    return redirect('/verifyEmailFirst');
                // }
               }
               }
       $this->incrementLoginAttempts($request);
       return $this->sendFailedLoginResponse($request);

    }
}