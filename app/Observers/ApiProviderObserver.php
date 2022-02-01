<?php

namespace App\Observers;

use App\Models\Service;
use App\Models\Category;
use App\Traits\MainTrait;
use App\Models\ApiProvider;
use Illuminate\Http\Request;

class ApiProviderObserver
{
    
    use MainTrait;
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(ApiProvider $apiProvider)
    {}
    /**
     * Handle the ApiProvider "created" event.
     *
     * @param  \App\Models\ApiProvider  $apiProvider
     * @return void
     */
    public function created(ApiProvider $apiProvider)
    {
        //
    }

    /**
     * Handle the ApiProvider "updated" event.
     *
     * @param  \App\Models\ApiProvider  $apiProvider
     * @return void
     */
    public function updated(ApiProvider $apiProvider)
    {
        //
    }  

    public function updating(ApiProvider $apiProvider)
    {
        $data = ['url'=>$apiProvider->url,'key'=>$apiProvider->api_key,'action'=>'services'];
        $services = $this->getApiServiceProvider($data);
        if(!$services || empty($services))
        {
        $services = Service::where('api_provider_id',$apiProvider->id);
        $category_ids = $services->get()->pluck('category_id');
        $categories = Category::whereIn('id',$category_ids);
        $categories->delete();
        }
    }

    /**
     * Handle the ApiProvider "deleted" event.
     *
     * @param  \App\Models\ApiProvider  $apiProvider
     * @return void
     */
    public function deleted(ApiProvider $apiProvider)
    {
       $services = Service::where('api_provider_id',$apiProvider->id);
       $category_ids = $services->get()->pluck('category_id');
       $categories = Category::whereIn('id',$category_ids);
       $categories->delete();
       $services->delete();
    }

    /**
     * Handle the ApiProvider "restored" event.
     *
     * @param  \App\Models\ApiProvider  $apiProvider
     * @return void
     */
    public function restored(ApiProvider $apiProvider)
    {
        //
    }

    /**
     * Handle the ApiProvider "force deleted" event.
     *
     * @param  \App\Models\ApiProvider  $apiProvider
     * @return void
     */
    public function forceDeleted(ApiProvider $apiProvider)
    {
        //
    }
}
