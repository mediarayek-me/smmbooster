<?php

namespace App\Models;

use DateTime;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getCreatedAtAttribute($date)
    {
     return date_format(new DateTime($date),'d-m-Y H:i:s');
    }

     /**
    * Get the user that owns the Transaction
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user()
   {
       return $this->belongsTo(User::class,'user_id');
   }

   public function getTime()
   {
    return date_format(new DateTime($this->created_at),'d-m-Y H:i:s');
   }
}
