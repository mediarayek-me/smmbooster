<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Language;
use App\Models\ApiProvider;
use Illuminate\Support\Str;
use App\Models\LanguageValue;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;

class Helper
{
    // 
    public static function status($name = null)
    {
        $status = ['active'=>'Active','deactive'=>'Deactive'];
        if($name) return $status[$name];
        return $status;
    }

    public static function orderStatus($name = null)
    {
        $status =  ['pending','processing','in progress','completed','partial','refunded','awaiting','error'];
        if($name) return $status[$name];
        return $status;
    }

    public static function transactionStatus($name = null)
    {
        $status = ['paid'=>'Paid','refund'=>'Refund'];
        if($name) return $status[$name];
        return $status;
    } 
    
    public static function getTicketStatus()
    {
        return ['pending','answered','closed'];
    } 
    
    public static function announcementTypes()
    {
        return['new service','disabled service','updated service','announcement'];
    }

    public static function ticketStatus()
    {
        return ['pending','answered','closed'];
    } 
    
    public static function ticketTypes()
    {
        return ['order','payment','service','api'];
    } 
    public static function percentageIncrease()
    {
        $values = [];
        for ($i=0; $i <= 1000 ; $i++) { 
           $values[$i] = $i.'%';
        }
        return $values;
    }
    
    public static function payment_methods($id = null)
    {
        $payment_methods = PaymentMethod::where('status','active')->get()->pluck('name','id');
        if($id) return $payment_methods[$id];
        return $payment_methods;
    }

    public static function users($id = null)
    {
        $users = User::where('status','active')->get()->pluck('email','id');
        if($id) return $users[$id];
        return $users;
    }

     public static function api_providers($id = null)
    {
        $api_providers = ApiProvider::where('status','active')->get()->pluck('name','id');
        if($id) return $api_providers[$id];
        return $api_providers;
    }

    public static function settings($key = null)
    {
        $settings = Setting::where('name',$key)->first();
        if($settings)
        return $settings->value;
        return '';
    } 
    public static function currency($key = null)
    {
        return ["AED" => "AED",
        "ALL" => "ALL",
        "AFN" => "AFN",
        "AFN" => "AFN",
        "AFN" => "AFN",
        "AMD" => "AMD",
        "ANG" => "ANG",
        "AOA" => "AOA",
        "ARS" => "ARS",
        "AUD" => "AUD",
        "AWG" => "AWG",
        "AZN" => "AZN",
        "BAM" => "BAM",
        "BBD" => "BBD",
        "BDT" => "BDT",
        "BGN" => "BGN",
        "BHD" => "BHD",
        "BIF" => "BIF",
        "BMD" => "BMD",
        "BND" => "BND",
        "BOB" => "BOB",
        "BOV" => "BOV",
        "BRL" => "BRL",
        "BSD" => "BSD",
        "BTN" => "BTN",
        "BWP" => "BWP",
        "BYR" => "BYR",
        "BZD" => "BZD",
        "CAD" => "CAD",
        "CDF" => "CDF",
        "CHE" => "CHE",
        "CHF" => "CHF",
        "CHW" => "CHW",
        "CLF" => "CLF",
        "CLP" => "CLP",
        "CNY" => "CNY",
        "COP" => "COP",
        "COU" => "COU",
        "CRC" => "CRC",
        "CUC" => "CUC",
        "CUP" => "CUP",
        "CVE" => "CVE",
        "CZK" => "CZK",
        "DJF" => "DJF",
        "DKK" => "DKK",
        "DOP" => "DOP",
        "DZD" => "DZD",
        "EGP" => "EGP",
        "ERN" => "ERN",
        "ETB" => "ETB",
        "EUR" => "EUR",
        "FJD" => "FJD",
        "FKP" => "FKP",
        "GBP" => "GBP",
        "GEL" => "GEL",
        "GHS" => "GHS",
        "GIP" => "GIP",
        "GMD" => "GMD",
        "GNF" => "GNF",
        "GTQ" => "GTQ",
        "GYD" => "GYD",
        "HKD" => "HKD",
        "HNL" => "HNL",
        "HRK" => "HRK",
        "HTG" => "HTG",
        "HUF" => "HUF",
        "IDR" => "IDR",
        "ILS" => "ILS",
        "INR" => "INR",
        "IQD" => "IQD",
        "IRR" => "IRR",
        "ISK" => "ISK",
        "JMD" => "JMD",
        "JOD" => "JOD",
        "JPY" => "JPY",
        "KES" => "KES",
        "KGS" => "KGS",
        "KHR" => "KHR",
        "KMF" => "KMF",
        "KPW" => "KPW",
        "KRW" => "KRW",
        "KWD" => "KWD",
        "KYD" => "KYD",
        "KZT" => "KZT",
        "LAK" => "LAK",
        "LBP" => "LBP",
        "LKR" => "LKR",
        "LRD" => "LRD",
        "LSL" => "LSL",
        "LTL" => "LTL",
        "LVL" => "LVL",
        "LYD" => "LYD",
        "MAD" => "MAD",
        "MDL" => "MDL",
        "MGA" => "MGA",
        "MKD" => "MKD",
        "MMK" => "MMK",
        "MNT" => "MNT",
        "MOP" => "MOP",
        "MRO" => "MRO",
        "MUR" => "MUR",
        "MVR" => "MVR",
        "MWK" => "MWK",
        "MXN" => "MXN",
        "MXV" => "MXV",
        "MYR" => "MYR",
        "MZN" => "MZN",
        "NAD" => "NAD",
        "NGN" => "NGN",
        "NIO" => "NIO",
        "NOK" => "NOK",
        "NPR" => "NPR",
        "NZD" => "NZD",
        "OMR" => "OMR",
        "PAB" => "PAB",
        "PEN" => "PEN",
        "PGK" => "PGK",
        "PHP" => "PHP",
        "PKR" => "PKR",
        "PLN" => "PLN",
        "PYG" => "PYG",
        "QAR" => "QAR",
        "RON" => "RON",
        "RSD" => "RSD",
        "RUB" => "RUB",
        "RWF" => "RWF",
        "SAR" => "SAR",
        "SBD" => "SBD",
        "SCR" => "SCR",
        "SDG" => "SDG",
        "SEK" => "SEK",
        "SGD" => "SGD",
        "SHP" => "SHP",
        "SLL" => "SLL",
        "SOS" => "SOS",
        "SRD" => "SRD",
        "SSP" => "SSP",
        "STD" => "STD",
        "SYP" => "SYP",
        "SZL" => "SZL",
        "THB" => "THB",
        "TJS" => "TJS",
        "TMT" => "TMT",
        "TND" => "TND",
        "TOP" => "TOP",
        "TRY" => "TRY",
        "TTD" => "TTD",
        "TWD" => "TWD",
        "TZS" => "TZS",
        "UAH" => "UAH",
        "UGX" => "UGX",
        "USD" => "USD",
        "USN" => "USN",
        "USS" => "USS",
        "UYI" => "UYI",
        "UYU" => "UYU",
        "UZS" => "UZS",
        "VEF" => "VEF",
        "VND" => "VND",
        "VUV" => "VUV",
        "WST" => "WST",
        "XAF" => "XAF",
        "XAG" => "XAG",
        "XAU" => "XAU",
        "XBA" => "XBA",
        "XBB" => "XBB",
        "XBC" => "XBC",
        "XBD" => "XBD",
        "XCD" => "XCD",
        "XDR" => "XDR",
        "XFU" => "XFU",
        "XOF" => "XOF",
        "XPD" => "XPD",
        "XPF" => "XPF",
        "XPT" => "XPT",
        "XTS" => "XTS",
        "XXX" => "XXX",
        "YER" => "YER",
        "ZAR" => "ZAR",
        "ZMW" => "ZMW",
    ];

    }

    public static function getOrdersCount($status = null)
    {
      return  Order::where('status',$status)->get()->count();
    }

    public static function getLang($key)
    {
          
        // session()->put('language_id',1);
        $ids = Language::get()->pluck('id');

        foreach ($ids as $language_id) {
             $row = LanguageValue::where('key',$key)->where('language_id',$language_id)->get();
             if(!$row->count())
              {
                  $value = $key;
                  LanguageValue::create(['key'=>Str::lower($key),'value'=>$value,'language_id'=>$language_id]);
              }
        }
        $language_id = session()->has('language_id') ? session()->get('language_id') : 1;
        // return $language_id;
        $languagevalue= LanguageValue::where('key',$key)->where('language_id',$language_id);
        return !is_null($languagevalue->first()) ? $languagevalue->first()->value : '';
    }

    public static function getDefaultDirection()
    {
        $language_id = session()->has('language_id') ? session()->get('language_id') : 1;
        $default = Language::where('id',$language_id)->get()->first();
        if(!is_null($default))
        return $default->direction;
        return 'ltr';
    }

    public static function getCurrentLanguage()
    {
        $language_id = session()->has('language_id') ? session()->get('language_id') : 1;
        return  Language::where('id',$language_id)->get()->first();
    }

    public static function isActiveRoute($routeName)
    {
        if(Route::currentRouteName() == $routeName)
        return 'active';
        return '';
    }

    public static function env($name)
    {
        $arr = explode("\n",file_get_contents(base_path(DIRECTORY_SEPARATOR .'.env')));
        $map = [];
        foreach ($arr as $key => $value) {
            $sub =  explode('=',$value);
            $map[$sub[0]] = isset($sub[1]) ? $sub[1] : '';
        }
        return $map[$name];
    }
    
    public static function isNavOpen($routes)
    {
        for ($i=0; $i < count($routes); $i++) { 
            $routeName = $routes[$i];
            if(Route::currentRouteName() == $routeName)
            return 'open';
        }
        return '';
    }
}