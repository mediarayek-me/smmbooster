<?php

namespace App\Http\Controllers\Web;

use ZipArchive;
use App\Models\Faq;
use App\Helpers\Helper;
use App\Events\NotifyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('status','active')->orderBy('sort','asc')->get();
        return view('web.index',compact('faqs'));
    }


    public function maintenanceMode()
    {
        return view('errors.503');
    } 

    public function termsConditions()
    {    
        return view('web.terms-conditions');
    }
    public function constactUs(Request $request)
    {   
        $subject = Helper::settings('website_title') ;
        $name = strip_tags($request->name);
        $email = strip_tags($request->email);
        $body = strip_tags($request->body);
        $body = 'from : '.$name .' <br> '. 'email :'.$email. ' <br> '.' message : '.$body;
        $notification = ['template'=>'admin.emails.notification','user'=>'admins','subject'=>$subject,'body'=>$body];
        NotifyEvent::dispatch($notification);
        return redirect()->back()->with(['send'=>true]);

    }
}
