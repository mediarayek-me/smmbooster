<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
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
    if(!app()->runningUnitTests() && file_exists(storage_path('installed')))
    {
        $settings = Setting::where('type','email')->orderBy('id','desc')->get()->pluck('value','name');
        Config::set('mail.mailers.smtp.transport', $settings['MAIL_DRIVER']);
        Config::set('mail.mailers.smtp.host', $settings['MAIL_HOST']);
        Config::set('mail.mailers.smtp.port', $settings['MAIL_PORT']);
        Config::set('mail.mailers.smtp.encryption', $settings['MAIL_ENCRYPTION']);
        Config::set('mail.mailers.smtp.username', $settings['MAIL_USERNAME']);
        Config::set('mail.mailers.smtp.password', $settings['MAIL_PASSWORD']);
        Config::set('mail.mailers.smtp.timeout', 5 );
    }
    }
}
