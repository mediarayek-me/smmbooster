<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use App\Models\Service;
use App\Models\Category;
use App\Traits\MainTrait;
use App\Models\ApiProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiProviderController extends Controller
{

    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $api_providers = ApiProvider::orderBy('id','desc')->paginate();

        if($request->api)
        {
            if(isset($request->search))
            $api_providers = $this->filter(['table'=>'api_providers','class'=>ApiProvider::class,'search'=>$request->search]);
            return response()->json($api_providers, 200);
        }
        return view('admin.api_providers',compact('api_providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $api_provider = ApiProvider::create($request->all());
        if(!is_null($api_provider))
        {
            $this->addApiServices($api_provider);
        }
        $count = Service::where('api_provider_id',$api_provider->id)->get()->count();
        $api_provider->update(['services_count'=>$count]);
        return response()->json($api_provider, 200);
   
    }
    public function addApiServices($api_provider)
    {
        // $request->request->add(['url'=>'https://hqsmartpanel.com/api/v1','key'=>'2EHdvKjVv02cpGuYXo2Zs8fGazkFPv2V','action'=>'services']);
        $data = ['url'=>$api_provider->url,'key'=>$api_provider->api_key,'action'=>'services'];
        $services =  $this->getApiServiceProvider($data);
        if($services && !empty($services))
        foreach ($services as $service) {
        $current_service = new Service();
        $category = Category::where('name',$service['category'])->first();
        if(!$category)
        {
        $category = new Category();
        $category->name = $service['category'];
        $category->status = 'active';
        $category->save();
        }
        $current_service->category_id = $category->id;
        $current_service->api_provider_id = $api_provider->id;
        $current_service->type = 'api';
        $current_service->status = 'active';
        $current_service->name = $service['name'];
        $current_service->api_provider_service_id = $service['service'];
        $current_service->percentage_increase = $api_provider->percentage_increase;
        $current_service->rate_original = floatval($service['rate']);
        $current_service->rate = floatval($service['rate']) + floatval($service['rate'])*floatval($api_provider->percentage_increase)/100 ;
        $current_service->min = floatval($service['min']);
        $current_service->max = floatval($service['max']);
        $current_service->description = isset($service['desc'])?$service['desc']:'';
        $current_service->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $api_provider = ApiProvider::where('id',$id)->first();
        return response()->json($api_provider, 200);
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
        $api_provider = ApiProvider::where('id',$id)->first();
        if($api_provider){
            $api_provider->update($request->all());
            $this->addApiServices($api_provider);
            $count = Service::where('api_provider_id',$api_provider->id)->get()->count();
            $api_provider->update(['services_count'=>$count]);
        }
        return response()->json($api_provider, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = ApiProvider::where('id',$id)->first();
        if($destroy)
        $destroy->delete();
        return response()->json($destroy, 200);
    }

  
    public  function syncServices($id)
    {
       $apiProvider =  ApiProvider::where('id',$id)->first();
       $apiProviderData = $apiProvider->toArray();
       $data = ['url'=>$apiProvider->url,'key'=>$apiProvider->api_key,'action'=>'services'];
       $services = $this->getApiServiceProvider($data);
       if($services && !empty($services)){
        $services = Service::where('api_provider_id',$apiProvider->id);
        $category_ids = $services->get()->pluck('category_id');
        $categories = Category::whereIn('id',$category_ids);
        $categories->delete();
        $this->addApiServices($apiProvider);
     

       }
       return response()->json($apiProvider, 200);

    }

    public function getApiServiceProviderData(Request $request)
    {
        $data = $request->all();
        return $this->getApiServiceProvider($data);
    }

}