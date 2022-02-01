<?php

namespace App\Providers;

use Stripe\Stripe;
use App\Models\Setting;
use App\Models\PaymentMethod;
use App\Models\UserNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->init();
    }

    public function init()
    {
        Schema::defaultStringLength(191);
        
        if(file_exists(storage_path('installed')))
        {
        

            if(Schema::hasTable('payment_methods')){
                // set stripe keys
                $stripe = PaymentMethod::where('id',2)->first();
                if($stripe){
                $stripe->makeVisible('private_key');
                Stripe::setApiKey($stripe->private_key);
                }
        
                // set paypal keys
                $paypal = PaymentMethod::where('id',1)->first();
                if($paypal){
                    Config::set('paypal.client_id', $paypal->client_id);
                    Config::set('paypal.secret', $paypal->private_key);
                    Config::set('paypal.settings.mode', $paypal->environment);
                }
            }
    
            VerifyEmail::toMailUsing(function ($notifiable, $url) {
                return $this->sendEmailVerificationNotification($url);
            });
        }
    }

    public function sendEmailVerificationNotification($url)
    {
        $website_name = Setting::where('name','website_title')->first();
        $website_name  =$website_name ? $website_name->value : '';
        $params = ['user'=>auth()->user(),'website_name'=>$website_name,'activation_link'=> $url];
        $subject = Setting::where('name','email_verification_tpl_subject')->first()->value;
        $body = Setting::where('name','email_verification_tpl')->first()->value;

        $body = $this->replaceParameters($body,$params);
        $subject = $this->replaceParameters($subject,$params);
        $notification = ['template'=>'admin.emails.notification','user'=>auth()->user(),'subject'=>$subject,'body'=>$body];
        return (new MailMessage())
        ->view('admin.emails.notification',compact('notification'))
        ->subject($subject);
       
    }
    public function replaceParameters($string,$params)
    {
        $user = $params['user'];
        $website_name = $params['website_name'];
        $activation_link = $params['activation_link'];
        $string = str_replace('{{firstname}}',$user->firstname,$string);
        $string = str_replace('{{website_name}}',$website_name,$string);
        $string = str_replace('{{activation_link}}','<a href="'.$activation_link.'"> Activation Link </a>',$string);
        return $string;
    }

}
