<?php

namespace App\Models;

use DateTime;
use App\Models\User;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

   
    protected $fillable = ['notes','status'];
   /**
    * Get the user that owns the Transaction
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user()
   {
       return $this->belongsTo(User::class,'user_id');
   }

   /**
    * Get the paymentMethod that owns the Transaction
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function paymentMethod()
   {
       return $this->belongsTo(PaymentMethod::class,'method_id');
   }

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
        self::observe(TransactionObserver::class);
    }
}

