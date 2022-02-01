<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $verify = Setting::where('name','email_verification_tpl_active')->first();
        $verify  = isset($verify) ? $verify->value : '';
        if($verify === 'on' && auth()->user() &&  is_null(auth()->user()->email_verified_at))
        return redirect('user/verify/email');
        return $next($request);
    }
}
