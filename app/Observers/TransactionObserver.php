<?php

namespace App\Observers;

use App\Models\Setting;
use App\Events\NotifyEvent;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */

    public function creating(Transaction $transaction)
    {
    }
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */

    public function replaceParameters($string,$params)
    {
        $transaction = $params['transaction'];
        $website_name = $params['website_name'];
        $string = str_replace('{{amount}}',$transaction->amount - $transaction->take_fee ,$string);
        $string = str_replace('{{firstname}}',$transaction->user->firstname,$string);
        $string = str_replace('{{balance}}',$transaction->user->funds,$string);
        $string = str_replace('{{currency}}','$',$string);
        $string = str_replace('{{method_name}}',$transaction->paymentMethod->name,$string);
        $string = str_replace('{{transaction_number}}',$transaction->transaction_id,$string);
        $string = str_replace('{{website_name}}',$website_name,$string);
        return $string;
    }
    public function created(Transaction $transaction)
    {
            $this->notify($transaction);
    
    }
  
    public function notify($transaction)
    {
        $is_active = Setting::where('name','payment_notification_tpl_active')->first();
        if($is_active && $is_active->value === 'on') 
        {
            $website_name = Setting::where('name','website_title')->first();
            $website_name  =$website_name ? $website_name->value : '';
            $params = ['transaction'=>$transaction,'website_name'=>$website_name];
            
            $subject = Setting::where('name','payment_notification_tpl_subject')->first()->value;
            $body = Setting::where('name','payment_notification_tpl')->first()->value;
    
            $body = $this->replaceParameters($body,$params);
            $subject = $this->replaceParameters($subject,$params);
    
            $notification = ['template'=>'admin.emails.notification','user'=>$transaction->user,'website_name'=>$website_name,'transaction'=>$transaction,'subject'=>$subject,'body'=>$body];
            NotifyEvent::dispatch($notification);
        }

    }
    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }  

    public function updating(Transaction $transaction)
    {
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
