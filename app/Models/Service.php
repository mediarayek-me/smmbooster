<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    /**
     * Get the category that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     /**
     * Get the api provider that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiProvider()
    {
        return $this->belongsTo(ApiProvider::class);
    }
}
