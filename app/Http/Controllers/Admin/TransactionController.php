<?php

namespace App\Http\Controllers\Admin;

use App\Traits\MainTrait;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $transactions = Transaction::with(['paymentMethod','user'])->orderBy('created_at','desc')->paginate();
       $permissions  = $this->getPermissions('transactions');

       if($request->api)
        {
            if(isset($request->search))
            $transactions = $this->filter(['table'=>'transactions','tables'=>['payment_methods','users'],'with'=>['paymentMethod','user'],'class'=>Transaction::class,'search'=>$request->search]);
            return response()->json(compact('transactions','permissions'), 200);
        }
       return view('admin.transactions',compact('transactions'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with(['paymentMethod','user'])->where('id',$id)->first();
        return response()->json($transaction, 200);
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
        $transaction = Transaction::where('id',$id)->first();
        $transaction->update($request->all());
        return response()->json($transaction, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Transaction::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}
