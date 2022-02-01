<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ApiProviderController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\UserNotificationController;

//unauthenticated routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login',function(){
        return view('auth.login');
    })->name('loginform');
    Route::post('login',[LoginController::class,'login'])->name('login');
    Route::post('logout',[LoginController::class,'logout'])->name('logout');;
    Route::get('forgot-password',function(){
        return view('auth.forgot-password');
    })->name('forgot-password'); 
    Route::get('password/reset',function(){
        return view('auth.passwords.email');
    })->name('password.request');
    Route::post('password/email',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get('password/email/{token}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('password/reset',[ResetPasswordController::class,'reset'])->name('password.update');
    Route::get('languages/get-language-values/{id}',[LanguageController::class,'getLanguageValues'])->name('get-language-values');
    Route::post('settings/{name}',[SettingController::class,'show']);

});
//authenticated admin routes
Route::prefix('admin')->middleware(['auth:admin','checkenv'])->name('admin.')->group(function () {
    Route::get('dashboard',[DashboardController::class,'dashboardAdmin'])->name('dashboard');
    Route::get('dashboard/get-chart-profit',[DashboardController::class,'getChartProfit'])->name('get-week-profit');
    Route::apiResource('categories',CategoryController::class,);
    Route::apiResource('admins',AdminController::class);
    Route::apiResource('users',UserController::class);
    Route::get('profil',[UserController::class,'profil'])->name('profil');
    Route::post('profil',[UserController::class,'profil'])->name('post-profil');
    Route::apiResource('api-providers',ApiProviderController::class);
    Route::post('api-providers/api',[ApiProviderController::class,'getApiServiceProviderData']);
    Route::post('api-providers/sync-services/{id}',[ApiProviderController::class,'syncServices']);
    Route::apiResource('payment-methods',PaymentMethodController::class);
    Route::apiResource('services',ServiceController::class);
    Route::apiResource('transactions',TransactionController::class);
    Route::apiResource('orders',OrderController::class);
    Route::apiResource('tickets',TicketController::class);
    Route::apiResource('user-notifications',UserNotificationController::class)->except(['update']);;
    Route::get('tickets/download/{file}',[TicketController::class,'downloadAttachment']);
    Route::apiResource('faqs',FaqController::class);
    Route::apiResource('languages',LanguageController::class);
    Route::post('languages/store-values',[LanguageController::class,'storeValues'])->name('languages.store-values');
    Route::get('languages/show/{id}',[LanguageController::class,'showItem'])->name('languages.show.item');
    Route::get('languages/set-language/{id}',[LanguageController::class,'setLanguage'])->name('languages.set-language');
    Route::get('languages/delete-key/{id}',[LanguageController::class,'deleteKey'])->name('languages.delete-key');
    Route::apiResource('announcements',AnnouncementController::class);
    Route::apiResource('settings',SettingController::class)->except(['index','show']);
    Route::get('settings/general',[SettingController::class,'generalSettings'])->name('settings.general');
    Route::get('settings/default',[SettingController::class,'defaultSettings'])->name('settings.default');
    Route::get('settings/apparence',[SettingController::class,'apparenceSettings'])->name('settings.apparence');
    Route::get('settings/seo',[SettingController::class,'seoSettings'])->name('settings.seo');
    Route::get('settings/policy',[SettingController::class,'policySettings'])->name('settings.policy');
    Route::get('settings/emails',[SettingController::class,'emailSettings'])->name('settings.emails');
    Route::get('settings/config-email',[SettingController::class,'configEmail'])->name('settings.config-emails');
    Route::get('orders/services/{category}',[OrderController::class,'getServices']);
 
});
//authenticated routes
Route::prefix('user')->middleware(['auth','is_verified'])->name('user.')->group(function () {
    Route::get('dashboard',[DashboardController::class,'dashboardUser'])->name('dashboard');
    Route::get('profil',[UserController::class,'profil'])->name('profil');
    Route::post('profil',[UserController::class,'profil'])->name('post-profil');
    Route::get('add-funds',[PaymentController::class,'addFunds'])->name('add-funds');
    Route::post('add-funds/{payment_method}',[PaymentController::class,'addFunds']);
    Route::get('payment/status',[PaymentController::class,'getPaymentStatus'])->name('get-payment-status');
    Route::get('payment-methods/{id}',[PaymentMethodController::class,'show']);
    Route::apiResource('services',ServiceController::class);
    Route::apiResource('transactions',TransactionController::class);
    Route::apiResource('orders',OrderController::class);
    Route::apiResource('tickets',TicketController::class);
    Route::get('languages/set-language/{id}',[LanguageController::class,'setLanguage'])->name('languages.set-language');
    Route::apiResource('user-notifications',UserNotificationController::class)->except(['update']);;
    Route::get('orders/services/{category}',[OrderController::class,'getServices']);  
});
Route::get('user/verify/email',[UserController::class,'emailVerification'])->name('verification-email');
Route::post('user/verify/email', [UserController::class,'emailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::get('user/verifym/email/{id}/{hash}',[UserController::class,'verifyUser'])->middleware(['auth', 'signed'])->name('verification.verify');