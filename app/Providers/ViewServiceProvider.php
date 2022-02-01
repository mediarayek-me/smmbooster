<?php

namespace App\Providers;

use App\Helpers\Helper;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('admin.modals.service-modal', function ($view) {
            $view->with('categories',Category::getActive());
        });
        view()->composer('web.partials.header', function ($view) {
            $view->with('languages',Language::getActive());
            $view->with('lang',Helper::getCurrentLanguage());
        });
        view()->composer('admin.partials.header', function ($view) {
            $view->with('languages',Language::getActive());
            if(Auth::guard('admin')->check())
            {
                $notifications = UserNotification::where('user_id',auth()->user()->id)->where('is_for_admin',1)->orderBy('created_at','desc')->get();
                $notifications_count = UserNotification::where('user_id',auth()->user()->id)->where('is_for_admin',1)->where('viewed','0')->count();
            }else{
                $notifications = UserNotification::where('user_id',auth()->user()->id)->where('is_for_admin',0)->orderBy('created_at','desc')->get();
                $notifications_count = UserNotification::where('user_id',auth()->user()->id)->where('is_for_admin',0)->where('viewed','0')->count();
            }
            $view->with('notifications',$notifications);
            $view->with('notifications_count',$notifications_count);

        });
        view()->composer('admin.emails.notification', function ($view) {
        $website_name = Setting::where('name','website_title')->first();
        $website_name  =$website_name ? $website_name->value : '';
        $website_logo = Setting::where('name','website_logo')->first()->value;
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST'] : '';
        $domain = isset($_SERVER['HTTP_HOST']) ? $protocol.$host : '';
        $logo = $domain.'/images/'.$website_logo;;
        $view->with('domain',$domain);
        $view->with('logo',$logo);
        $view->with('website_name',$website_name);
        });

    }
}
