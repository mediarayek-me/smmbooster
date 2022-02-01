<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Traits\MainTrait;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $users = User::orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $users = $this->filter(['table'=>'users','class'=>User::class,'search'=>$request->search]);
            return response()->json($users, 200);
        }
       return view('admin.users',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'required | unique:users',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required | email | unique:users',
            'password'=>'required | min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
        
        $user = $request->all();
        if(!is_null($request->input('password')));
        $user['password'] = Hash::make($request->input('password'));
        
        $user = User::create($user);
        return response()->json($user, 200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        return response()->json($user, 200);
    }

    /**
     * user profil
     */
   
    public function profil(Request $request)
    {
        $user = auth()->user();
        $user_data = $request->all();
        $guard = $request->is('login') ? 'web' : 'admin';
        if($request->isMethod('post'))
        {
            $request->validate(
            [
                'username'=>'required | unique:users,username,'.$user->id,
                'firstname'=>'required',
                'lastname'=>'required',
                'avatar'=>'image|mimes:jpeg,png,jpg|max:2048',
                'email'=>'required | unique:users,email,'.$user->id,
            ]);
            // change password
            if(!is_null($request->password))
            {
               // dd($request->only('email','password'));
               
               // dd(Hash::check('password', $user->password));
                $request->validate(['password_new'=> 'min:8']);
                if(Auth::guard($guard)->check($request->only('email','password')))
                {
                    if(!is_null($request->password_new))
                    $user->update(['password'=>Hash::make($request->password_new)]);
                }else
                return back()->withErrors(['error'=> 'Your password is incorrect']); 
            }   
            // change avatar
            if($request->file('avatar'))
           {
            $imagename = time().'.'.$request->file('avatar')->getClientOriginalExtension();
            
            if($request->file('avatar')->move(public_path('images/avatars'),$imagename))
            $user_data['avatar'] = $imagename;
           }
        unset($user_data['password']);
        $user->update($user_data);
        back()->with('success_update', true);
        }
        return view('admin.user-profil');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'unique:users,email,'.$id,
            'email'=>'email | unique:users,email,'.$id,
            'password'=>'min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
        $data  = $request->all();
        $user = User::where('id',$id)->first();

        if(!is_null($request->input('password')))
        $data['password'] = Hash::make($request->input('password'));
        

        $user = $user->update($data);
        return response()->json($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    } 

    public function emailVerification(Request $request)
    {  
        if($request->isMethod('post'))
        {
            auth()->user()->sendEmailVerificationNotification();
            return back()->with(['verification_link'=>true]);
        }
        if(!session()->has('email_verification'))
        auth()->user()->sendEmailVerificationNotification();

        session()->put('email_verification', true);
        return view('auth.verify');
    }

    public function verifyUser(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/user/dashboard')->with(['verify'=>true]);;
    }
   
   

}
