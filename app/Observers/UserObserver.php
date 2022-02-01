<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Setting;
use App\Events\NotifyEvent;
use App\Listeners\SendEmailNotification;

class UserObserver
{
    
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    public function creating(User $user)
    {
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    public function replaceParameters($string,$params)
    {
        $user = $params['user'];
        $website_name = $params['website_name'];
        $string = str_replace('{{username}}',$user->username,$string);
        $string = str_replace('{{firstname}}',$user->firstname,$string);
        $string = str_replace('{{lastname}}',$user->lastname,$string);
        $string = str_replace('{{email}}',$user->email,$string);
        $string = str_replace('{{website_name}}',$website_name,$string);
        return $string;
    }

    public function sendWelcomeNotification($user)
    {
        $is_active = Setting::where('name','new_user_welcome_email_tpl_active')->first();
        if($is_active && $is_active->value === 'on')
        {
        $website_name = Setting::where('name','website_title')->first();

        $website_name  =$website_name ? $website_name->value : '';
        $params = ['user'=>$user,'website_name'=>$website_name];
        
        $subject = Setting::where('name','new_user_welcome_email_tpl_subject')->first()->value;
        $body = Setting::where('name','new_user_welcome_email_tpl')->first()->value;

        $body = $this->replaceParameters($body,$params);
        $subject = $this->replaceParameters($subject,$params);

        $notification = ['template'=>'admin.emails.notification','website_name'=>$website_name,'user'=>$user,'subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
        }
    }

    public function created(User $user)
    {
        
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }  

    public function updating(User $user)
    {
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
