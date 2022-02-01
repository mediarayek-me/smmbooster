<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\Setting;
use App\Events\NotifyEvent;

class TicketObserver
{
    
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Ticket $ticket)
    {

    }
    public function replaceParameters($string,$params)
    {
        $ticket = $params['ticket'];
        $website_name = $params['website_name'];
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST'] : 'your-domain.com';
        $ticket_link = '<a target="_blank" href="'.$protocol.$host.'/admin/tickets/'.$ticket->id.'">'.'ticket link'.'</a>';
        $status = $ticket->status ? $ticket->status : Ticket::where('id',$ticket->id)->first()->status;
        $string = str_replace('{{firstname}}',$ticket->user->firstname,$string);
        $string = str_replace('{{website_name}}',$website_name,$string);
        $string = str_replace('{{status}}',$status,$string);
        $string = str_replace('{{ticket_id}}',$ticket->id,$string);
        $string = str_replace('{{ticket_subject}}',$ticket->subject,$string);
        $string = str_replace('{{ticket_link}}',$ticket_link,$string);
        return $string;
    }

    public function notify($ticket)
    {
        $is_active = Setting::where('name','reply_support_ticket_tpl_active')->first();
        if($is_active && $is_active->value === 'on') 
       {
        $website_name = Setting::where('name','website_title')->first();
        $website_name  =$website_name ? $website_name->value : '';
        $params = ['ticket'=>$ticket,'website_name'=>$website_name];
        
        $subject = Setting::where('name','reply_support_ticket_tpl_subject')->first()->value;
        $body = Setting::where('name','reply_support_ticket_tpl')->first()->value;

        $body = $this->replaceParameters($body,$params);
        $subject = $this->replaceParameters($subject,$params);

        $notification = ['template'=>'admin.emails.notification','user'=>$ticket->user,'subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
       }
    }

    public function notifyAdmins($ticket)
    {
        $website_name = Setting::where('name','website_title')->first();
        $website_name  =$website_name ? $website_name->value : '';
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST'] : 'your-domain.com';
        $ticket_link = '<a target="_blank" href="'.$host.'/admin/tickets/'.$ticket->id.'">'.'ticket link'.'</a>';
        $subject = $website_name .'- New Ticket has been created';
        $body = '<strong>'.$ticket->user->firstname.'</strong>  ' .'  create a new ticket <br>  please check this link to answer the ticket '.$ticket_link;
        $notification = ['template'=>'admin.emails.notification','user'=>'admins','subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
    }
    /**
     * Handle the Ticket "created" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
         $this->notifyAdmins($ticket);
    }

    /**
     * Handle the Ticket "updating" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updating(Ticket $ticket)
    {
        if($ticket->isDirty('status') && $ticket->status == 'answered'){
            $this->notify($ticket); 
        }
        if($ticket->isDirty('status') && $ticket->status == 'closed'){
            $this->notify($ticket); 
        }
        if($ticket->isDirty('status') && $ticket->status == 'pending'){
            $this->notifyAdmins($ticket);
        }

    } 
    
    /**
     * Handle the Ticket "updated" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        
    }

    /**
     * Handle the Ticket "deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        //
    }
}
