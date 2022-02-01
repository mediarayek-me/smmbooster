<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(!app()->runningUnitTests())
        {
        $notification = $event->notification;
        $website_logo = Setting::where('name','website_logo')->first()->value;
        $notification['icon'] = 'fa fa-fw fa-check-circle text-success';

        if($notification['user'] === 'all')
        {
            $users = User::where('status','active')->get();
            foreach ($users as $user) {
              $this->sendEmail($user,$notification);
            }
        }else if($notification['user'] === 'admins')
        {
            $users = Admin::where('status','active')->get();
            foreach ($users as $user) {
              $this->sendEmail($user,$notification,true);
        }
        }else{
        $user = $notification['user'];
        $this->sendEmail($user,$notification);
        }
        }
    }

    public function sendEmail($user,$notification,$is_for_admin = false)
    {
        if(!app()->runningUnitTests())
        {
            try {
                Mail::send($notification['template'],compact('notification'), function ($message) use ($user,$notification,$is_for_admin) {
                    $message->from(config('mail')['from']['address'],config('mail')['from']['name']);
                    $message->to($user->email, $user->firstname.' '.$user->lastname);
                    $message->subject($notification['subject']);
                    // save notification
                   $user_notification = ['subject'=>$notification['subject'],'content'=>$notification['body'],'icon'=>$notification['icon'],'user_id'=>$user->id];
                   if($is_for_admin)
                   $user_notification['is_for_admin'] = 1;
                   UserNotification::create($user_notification);  
                });
            } catch (\Exception $e) {
                if(!is_null(auth()->user()) && auth()->guard('admin')->check())
                  session()->put('email_error',true);
                  return;
            }
        }
    }
}
