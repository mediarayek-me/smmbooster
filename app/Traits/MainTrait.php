<?php

namespace App\Traits;

use App\Models\User;
use GuzzleHttp\Client;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;


/**
 * Main Trait
 */
trait MainTrait
{

    public function filter($params){
      $table_base = $params['table'];
      $columnListing =  Schema::getColumnListing($table_base);
      $columnListing_relation = [];
      $with = isset($params['with']) ? $params['with'] : [];
      $conditions = isset($params['conditions']) ? $params['conditions'] : [];
      $search = $params['search'];
      $class =  $params['class'];
      
      if(isset($params['tables']))
      foreach ($params['tables'] as $table) {
        array_push($columnListing_relation,  Schema::getColumnListing($table));
      }
      //return $columnListing_relation;
       return  $class::where($conditions)->with($with)->where(function($q) use ($search,$columnListing,$columnListing_relation,$table_base,$with){
         foreach ($columnListing as $column) {
          $q->orWhere($column,'LIKE','%'.$search.'%');
         }
         foreach ($with as $key => $relation) {
          foreach ($columnListing_relation[$key] as $column_child) {
          $q->orWhereHas($relation,function($w)use($column_child,$search){
              $w->where($column_child,'LIKE','%'.$search.'%');
            });
          }
          }
        })->paginate();
      }
      
    public function getPermissions($type){
      $permissions =  [
        'services' =>
        [
          'edit' => Gate::allows('isAdmin'),
          'delete' => Gate::allows('isAdmin'),
          'view' => true 
        ],
        'orders' =>
        [
          'edit' => true,
          'delete' => Gate::allows('isAdmin'), 
          'view' => true,
          'is_admin' =>  Gate::allows('isAdmin')
        ],
        'transactions' =>
        [
          'is_admin' =>  Gate::allows('isAdmin')
        ],
      ];
      return $permissions[$type];
    }
    public  function getApiServiceProvider($data)
    {
      try {
        $request = new Request();
        $request->setMethod('post');
        $request->request->add($data);
       
        $params =  $request->all();
        $url = $params['url'];
        unset($params['url']);

        $client = new Client();
        $res = $client->request('POST', $url, [
            'form_params' => $params
        ]);
        $response = json_decode($res->getBody(), true);
        return $response;
        if(isset($response['error']))
        return null;
       
        return $response;
      } catch (\Throwable $th) {
        return null;
      }
    }

    
}

