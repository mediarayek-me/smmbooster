<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Category;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $categories = Category::orderBy('sort','desc')->get();
       $permissions  = $this->getPermissions('services');

       $conditions = $request->api_provider ? [['api_provider_id','=',$request->api_provider]] : [];

        if($request->api)
        {
            $services = Service::with(['category'])->where($conditions)->orderBy('id','desc')->paginate();
            if(isset($request->search)){

                $services = $this->filter(['table'=>'services','conditions'=>$conditions,'tables'=>['categories'],'with'=>['category'],'class'=>Service::class,'search'=>$request->search]);
            }
            return response()->json(compact(['permissions','services']), 200);
        }
       return view('admin.services',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $service = Service::create($request->all());
        return response()->json($service, 200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::with(['apiProvider'])->where('id',$id)->first();
        return response()->json($service, 200);
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
        $this->authorize('isAdmin');
        $service = Service::where('id',$id)->first();
        $service->update($request->all());
        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $destroy = Service::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}
