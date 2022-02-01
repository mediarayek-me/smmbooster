<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;

  

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected  function redirectTo()
    {
        if(request()->is('admin/*'))
        return RouteServiceProvider::Admin_Dashboard;
        return RouteServiceProvider::HOME;
    }
    

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */

    protected function broker()
    {
        if(request()->is('admin/*'))
        return Password::broker('admins');
        return Password::broker('users');
    }
}
