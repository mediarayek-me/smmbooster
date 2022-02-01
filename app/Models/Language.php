<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;
    protected  $guarded = ['id'];

    public static function getActive()
    {
      return  Language::where('status','active')->get();
    }

}
