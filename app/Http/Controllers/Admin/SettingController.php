<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class SettingController extends Controller
{
    use MainTrait;

   
    public function generalSettings(Request $request)
    {
       $settings = Setting::where('type','general')->orderBy('id','desc')->get()->pluck('value','name');
       return view('admin.settings.general',compact('settings'));
    }

    public function defaultSettings(Request $request)
    {
       $settings = Setting::where('type','default')->orderBy('id','desc')->get()->pluck('value','name');
       return view('admin.settings.default',compact('settings'));
    }
     
     
    public function apparenceSettings(Request $request)
    {
   
       $settings = Setting::where('type','apparence')->orderBy('id','desc')->get()->pluck('value','name');
       return view('admin.settings.apparence',compact('settings'));
    }

    public function seoSettings(Request $request)
    {
   
       $settings = Setting::where('type','seo')->orderBy('id','desc')->get()->pluck('value','name');
       return view('admin.settings.seo',compact('settings'));
    }

     public function policySettings(Request $request)
    {
   
       $settings = Setting::where('type','policy')->orderBy('id','desc')->get()->pluck('value','name');
     
       return view('admin.settings.policy',compact('settings'));
    }

    public function emailSettings(Request $request)
    {
   
       $settings = Setting::where('type','email')->orderBy('id','desc')->get()->pluck('value','name');
     
       return view('admin.settings.emails',compact('settings'));
    } 
    
    public function configEmail(Request $request)
    {
       $settings = Setting::where('type','email')->orderBy('id','desc')->get()->pluck('value','name');
       return view('admin.settings.config-email',compact('settings'));
    }

 
    public function store(Request $request)
    {

        $inputs = $request->all();
        $type = $request->input('type');
        
        unset($inputs['_token']);
        unset($inputs['type']);
        // save inputs
        foreach ($inputs as $name => $value) {
            $name = trim($name);
            $setting = Setting::where('name',$name)->first();
            if(is_file($value))
         {
            move_uploaded_file($value->getPathname(),public_path('images').DIRECTORY_SEPARATOR.$value->getClientOriginalName());
            $value = $value->getClientOriginalName();
        }
        $value = trim($value);
        $setting = Setting::where('name',$name)->first();
        $setting ? $setting->update(['value'=>$value]) :
         Setting::create(['name'=>$name,'value'=>$value,'type'=>$type]);
       }

        session()->put('success_save', 1);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Setting::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

    public function show($name)
    {
        if($name === 'all')
        {
        $settings = Setting::all()->pluck('value','name');
        return response()->json($settings, 200) ;
        }

        $setting = Setting::where('name',$name)->first();
        return $setting ?
        response()->json($setting, 200) :   response()->json([], 404);
    }



}
