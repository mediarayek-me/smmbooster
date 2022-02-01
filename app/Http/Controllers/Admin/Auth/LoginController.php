<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Admin_Dashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
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
        $attempt = $this->guard()->attempt($this->credentials($request));
        if($attempt)
        {
            $user = $this->guard()->user();

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

       /* $this->validateLogin($request);
        $email = isset($this->credentials($request)['email']) ? $this->credentials($request)['email'] : null;
        $username = isset($this->credentials($request)['username']) ? $this->credentials($request)['username'] : null;
        
        $admin =Admin::where('email',$email)->orWhere('username',$username)->first();
        if($admin)
        {
            if($admin->status === 'active')
            {
                Auth::guard('admin')->login($admin);
                return $this->sendLoginResponse($request);
            }
            return back()->with(['account_disabled'=>true]);
            
        }
        else
        {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }*/
    }


}
