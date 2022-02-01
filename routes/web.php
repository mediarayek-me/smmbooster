<?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[IndexController::class,'index'])->name('welcome');
Route::get('/terms-conditions',[IndexController::class,'termsConditions'])->name('terms-conditions');
Route::post('/contact-us',[IndexController::class,'constactUs'])->name('contact-us');
Route::get('languages/set-language/{id}',[LanguageController::class,'setLanguage'])->name('languages.set-language');


$disabled_routes = [];

if(file_exists(storage_path('installed')) && Schema::hasTable('settings')){
if(Helper::settings('user_registration') === 'off'){
    $disabled_routes['register'] = false;
}
if(Helper::settings('email_verification') === 'off'){
    $disabled_routes['verify'] = false;
}

if(Helper::settings('user_login') === 'off'){
    $disabled_routes['login'] = false;
}
if(Helper::settings('maintenance_mode') === 'on'){
    Route::get('/503',[IndexController::class,'maintenanceMode'])->name('maintenance-mode');
}

}
Auth::routes($disabled_routes);

