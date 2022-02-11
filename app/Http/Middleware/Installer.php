<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Installer
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
        // not installed
        if(!file_exists(storage_path('installed')) &&!$request->is('install') &&  !$request->is('install/*'))
        return redirect('/install');

        return $next($request);
    }
}
