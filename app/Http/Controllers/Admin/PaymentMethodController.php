<?php

namespace App\Http\Controllers\Admin;

use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PaymentMethodController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $conditions = !Gate::allows('isAdmin')? [['status','=','active']] :[];
       $paymentMethods = PaymentMethod::where($conditions)->orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
           $paymentMethods = $this->filter(['conditions'=>$conditions,'table'=>'payment_methods','class'=>PaymentMethod::class,'search'=>$request->search]);
            return response()->json($paymentMethods, 200);
        }
       return view('admin.payment_methods',compact('paymentMethods'));
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::where('id',$id)->first();
        $paymentMethod->makeVisible('api_key');
        $paymentMethod->makeVisible('private_key');
        $paymentMethod->makeVisible('environment');
        return response()->json($paymentMethod, 200);
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
        $paymentMethod = PaymentMethod::where('id',$id)->first();
        $paymentMethod->update($request->all());
        return response()->json($paymentMethod, 200);
    }

  

}
