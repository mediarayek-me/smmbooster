<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Admin;
//use App\Policies\ServicePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
     //  User::class =>  ServicePolicy::class,
      // Admin::class =>  ServicePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return Auth::guard('admin')->check() == true ;
         });
        Gate::define('isUser', function($user) {
            return Auth::guard('web')->check() == true ;
         });
    }
}
