<?php

namespace App\Models;

use App\Observers\ApiProviderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiProvider extends Model
{
    protected $guarded = ['id'];
    
    use HasFactory;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

       self::observe(ApiProviderObserver::class);
    }
}
