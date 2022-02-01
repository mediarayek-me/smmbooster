<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use MainTrait;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $admins = Admin::orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $admins = $this->filter(['table'=>'admins','class'=>Admin::class,'search'=>$request->search]);
            return response()->json($admins, 200);
        }
       return view('admin.admins',compact('admins'));
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
            'username'=>'required | unique:admins',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required | email | unique:admins',
            'password'=>'required | min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
        $admin = $request->all();
        if(!is_null($request->input('password')));
        $admin['password'] = Hash::make($request->input('password'));

        $admin = Admin::create($admin);
        return response()->json($admin, 201);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::where('id',$id)->first();
        return response()->json($admin, 200);
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
            'username'=>'unique:admins,email,'.$id,
            'email'=>'email | unique:admins,email,'.$id,
            'password'=>'min:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }
        $admin = Admin::where('id',$id)->first();
        $data = $request->all();

        if(!is_null($request->input('password')))
        $data['password'] = Hash::make($request->input('password'));

        $admin = $admin->update($data);
    
        return response()->json($admin, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Admin::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}