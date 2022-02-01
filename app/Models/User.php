<?php

namespace App\Models;

use DateTime;
use App\Models\Setting;
use App\Events\NotifyEvent;
use App\Observers\UserObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAtAttribute($date)
    {
     return date_format(new DateTime($date),'d-m-Y H:i:s');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(UserObserver::class);
    }

  public function sendPasswordResetNotification($token)
  {
    $this->notifyUser($token);
  }

  public function notifyUser($token)
  {
      $is_active = Setting::where('name','password_recovery_tpl_active')->first();
      if($is_active && $is_active->value === 'on') 
     {
      $website_name = Setting::where('name','website_title')->first();
      $website_name  =$website_name ? $website_name->value : '';
      $route = request()->is('admin/*') ? 'admin.password.reset' : 'password.reset';
      $params = ['recovery_password_link'=>route($route,[$token]),'website_name'=>$website_name];
      
      $subject = Setting::where('name','password_recovery_tpl_subject')->first()->value;
      $body = Setting::where('name','password_recovery_tpl')->first()->value;

      $body = $this->replaceParameters($body,$params);
      $subject = $this->replaceParameters($subject,$params);

      $notification = ['template'=>'admin.emails.notification','user'=>$this,'website_name'=>$website_name,'subject'=>$subject,'body'=>$body];
      NotifyEvent::dispatch($notification);
     }
  }

  public function replaceParameters($string,$params)
  {
      $website_name = $params['website_name'];
      $recovery_password_link = $params['recovery_password_link'];
      $string = str_replace('{{firstname}}',$this->firstname,$string);
      $string = str_replace('{{website_name}}',$website_name,$string);
      $string = str_replace('{{recovery_password_link}}','<a href="'.$recovery_password_link.'">Recovery Password Link</a>',$string);
      return $string;
  }




}
