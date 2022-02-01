<?php

namespace App\Http\Controllers\Admin;

use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Models\UserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
       if(Auth::guard('admin')->check())
       $conditions = [['user_id','=',auth()->user()->id],['is_for_admin','=',1]];
       else
       $conditions = [['user_id','=',auth()->user()->id],['is_for_admin','=',0]];

       $userNotifications = UserNotification::where($conditions)->orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $userNotifications = $this->filter(['table'=>'user_notifications','class'=>UserNotification::class,'search'=>$request->search]);
            return response()->json($userNotifications, 200);
        }
       return view('admin.user-notifications',compact('userNotifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $userNotification = UserNotification::create($request->all());
        return response()->json($userNotification, 200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userNotification = UserNotification::with(['user'])->where('id',$id)->first();
        $userNotification->update(['viewed'=>1]);
        return view('admin.user-notifications-show',compact('userNotification'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = UserNotification::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}
