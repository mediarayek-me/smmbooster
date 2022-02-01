<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Service;
use App\Models\Category;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user','service','service.apiProvider','service.category'])->orderBy('id','desc')->paginate();
        $permissions  = $this->getPermissions('orders');
        if($request->api)
        {
            if(isset($request->search))
        $orders = $this->filter(['table'=>'orders','class'=>Order::class,'tables'=>['users','services','api_providers','categories'],'with'=>['user','service','service.apiProvider','service.category'],'search'=>$request->search]);

            return response()->json( compact(['permissions','orders']), 200);
        }
        $categories  = Category::where('status','active')->orderBy('id','desc')->get();
        $services  = Service::where('status','active')->orderBy('id','desc')->get();
        return view('admin.orders',compact('orders','categories','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = $request->all();
        if($this->checkBalance($order))
        {
        $order = Order::create($order);
        if($order && $order->id)
        {
            $order = Order::with(['service','service.apiProvider'])->where('id',$order->id)->get()->first();
            $api_provider = $order->service->apiProvider;
            $service = $order->service;
            if($service->type === 'api')
            {
                // send order to api provider
                $data = ['url'=>$api_provider->url,'key'=>$api_provider->api_key,'action'=>'add','service'=>$service->api_provider_service_id,'link'=>$order->link,'quantity'=>$order->quantity];
                $response = $this->getApiServiceProvider($data);

                if(isset($response['order'])) // order sended successfly
                {
                $order->update(['order_api_id'=>$response['order']]) ;
                $this->discountBalance($order);
                }
                else if(isset($response['error']))
                $order->update(['api_provider_error'=>$response['error']]);

                return response()->json($response, 200);
        
            }
            $this->discountBalance($order);
            return response()->json($order, 200);
        }
        }else{
            return response()->json([], 401);
        }
    }

    public function checkBalance($order)
    {   
        $service = Service::where('id',$order['service_id'])->get()->first();
        $total = $order['quantity'] * $service['rate'] / 1000;
        $balance = Auth::user()->funds;
        return $balance > $total;
    } 
    
    public function discountBalance($order)
    {   
        $user =  Auth::user();
        $funds = $user->funds - $order->total;
        $user->update(['funds'=>$funds]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['service','service.category','user'])->where('id',$id)->first()->toArray();
        $order['category_id'] = $order['service']['category_id'];
        return response()->json($order, 200);
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
        $order = Order::where('id',$id)->first();
        $order->update($request->all());
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Order::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

    /**
     * Get services of a sigle category.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function getServices($category_id)
    {
        $services = Service::where('category_id',$category_id)->get();
        return response()->json($services, 200);
    }



    

}
