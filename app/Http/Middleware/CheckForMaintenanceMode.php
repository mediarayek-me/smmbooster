<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Web\IndexController;

class CheckForMaintenanceMode
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
        return $this->checkForMaintenanceMode($request,$next);
    }


    
    public function checkEnv($request,$next)
    {
        if(!$this->isDemoEnv()) 
        return redirect('503');
        return $next($request);

    }
    public function checkForMaintenanceMode($request,$next)
    {
    if(file_exists(storage_path('installed')))
    {
        $settings = Setting::where('name','maintenance_mode')->first();

        if($settings && $settings['value'] === 'on' &&  !$request->is('admin/*') &&  !$request->is('503'))
        {
            return redirect('503');

        }else 
        {
            return $next($request);
        }
    }
    return $next($request); 
    }
}
