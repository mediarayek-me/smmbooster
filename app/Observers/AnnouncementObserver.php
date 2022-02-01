<?php

namespace App\Observers;

use App\Helpers\Helper;
use App\Events\NotifyEvent;
use App\Models\Announcement;

class AnnouncementObserver
{
    
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function creating(Announcement $announcement)
    {
      

    }
  

    public function notify($announcement)
    {
        $subject = Helper::settings('website_title').' - '. $announcement->type;
        $body =  $announcement->description;
        $notification = ['template'=>'admin.emails.notification','user'=>'all','subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
    
    }
    /**
     * Handle the Announcement "created" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function created(Announcement $announcement)
    {
        $this->notify($announcement);
    }

    /**
     * Handle the Announcement "updating" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function updating(Announcement $announcement)
    {
        
    } 
    
    /**
     * Handle the Announcement "updated" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function updated(Announcement $announcement)
    {
        
    }

    /**
     * Handle the Announcement "deleted" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function deleted(Announcement $announcement)
    {
        //
    }

    /**
     * Handle the Announcement "restored" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function restored(Announcement $announcement)
    {
        //
    }

    /**
     * Handle the Announcement "force deleted" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function forceDeleted(Announcement $announcement)
    {
        //
    }
} 

