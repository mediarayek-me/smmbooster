<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Setting;
use App\Events\NotifyEvent;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{
    
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Order $order)
    {
      $service = Service::with(['category'])->where('id',$order->service_id)->get()->first();
      $order->total = $order->quantity * $service->rate / 1000;
      $order->user_id = Auth::user()->id;
      $details = '<h6>'.$service->name.'</h6>';
      $details .= '<div>
       <small>
        <ul>
        <li> type: '.$service->category->name.'</li>
        <li> rate: $'.$service->rate.' / 1000</li>
        <li> link:  <a href="'.$order->link.'">'.$order->link.'</a></li>
        <li> quantity: '.$order->quantity.'</li>
        <li> total: $'.number_format($order->total, 4) .'</li>
        <li> notes: '.$order->notes.'</li>
        </ul>
       </small>
      </div>';
      $order->details = $details;

    }
    public function replaceParameters($string,$params)
    {
        $order = $params['order'];
        $website_name = $params['website_name'];
        $status = $order->status ? $order->status : Order::where('id',$order->id)->first()->status;
        $string = str_replace('{{price}}',$order->total ,$string);
        $string = str_replace('{{firstname}}',$order->user->firstname,$string);
        $string = str_replace('{{balance}}',$order->user->funds,$string);
        $string = str_replace('{{currency}}','$',$string);
        $string = str_replace('{{website_name}}',$website_name,$string);
        $string = str_replace('{{service_name}}',$order->service->name,$string);
        $string = str_replace('{{service_category}}',$order->service->category->name,$string);
        $string = str_replace('{{status}}',$status,$string);
        $string = str_replace('{{order_ID}}',$order->id,$string);
        return $string;
    }

    public function notify($order)
    {
        $is_active = Setting::where('name','order_status_tpl_active')->first();
        if($is_active && $is_active->value === 'on') 
       {
        $website_name = Setting::where('name','website_title')->first();
        $website_name  =$website_name ? $website_name->value : '';
        $params = ['order'=>$order,'website_name'=>$website_name];
        
        $subject = Setting::where('name','order_status_tpl_subject')->first()->value;
        $body = Setting::where('name','order_status_tpl')->first()->value;

        $body = $this->replaceParameters($body,$params);
        $subject = $this->replaceParameters($subject,$params);

        $notification = ['template'=>'admin.emails.notification','user'=>$order->user,'website_name'=>$website_name,'order'=>$order,'subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
       }
    }
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $this->notify($order);
    }

    /**
     * Handle the Order "updating" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updating(Order $order)
    {
        if($order->isDirty('status')){
            $this->notify($order); 
          }
    } 
    
    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
