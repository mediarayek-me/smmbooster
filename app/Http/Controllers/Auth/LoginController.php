<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * Get the needed authorization credentials from the request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array */
    protected function credentials(Request $request)
    {
       
      return ['password'=>$request->input('password'),$this->username() =>$request->input('username')];
    }


     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $rules = ['password' => 'required | string'];
        $this->username() === 'email' ? $rules['username'] = 'email | required | string' :  $rules['username'] = 'required | string';
        $request->validate($rules);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {  
        $email  = filter_var(request()->input('username'),FILTER_VALIDATE_EMAIL);
        
        return  $email ? 'email' : 'username';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $attempt = Auth::attempt($this->credentials($request));
        $verify_is_active = Setting::where('name','email_verification_tpl_active')->first();

        if($attempt)
        {
            $user = auth()->user();
            if($verify_is_active && $verify_is_active->value === 'on' && is_null($user->email_verified_at))
            {
                return redirect('user/verify/email');
            }

            if($user->status === 'active')
            {  
                return $this->sendLoginResponse($request);
            }

            return back()->with(['account_disabled'=>true]);
            
        }
        else
        {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }
    }

}
