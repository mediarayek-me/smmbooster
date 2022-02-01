<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Helper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Web\IndexController;

class CheckEnv
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
        return $this->checkEnv($request,$next);
    }


    
    public function checkEnv($request,$next)
    {
       

        if(!$request->isMethod('get') && Helper::env('APP_ENV') == 'demo') 
        {
           $content = $request->header('content-type');
           $is_ajax = $content != 'application/x-www-form-urlencoded' && strpos($content,'multipart') === false;  

           
            if($is_ajax)
            return response()->json('not_allowed', 300);
            else
            {
                session()->put('checkenv','demo');
                return back();
            }
        }
        return $next($request);

    }
 
}
