@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="service-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
                <div class="input-group">
                    <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                    <div class="input-group-prepend">
                        <button v-on:click="getServices()" type="button" class="btn btn-primary">
                            <i class="fa fa-search mx-2"></i> {{Helper::getLang('Search')}}
                        </button>
                    </div>
                    <select v-model="selected_api_provider" v-on:change="getServices()" class="form-control mx-3" name="api_providers" id="api_providers">
                        <option value="" selected> {{Helper::getLang('Api Provider')}}</option>
                      @foreach (Helper::api_providers() as $key => $api_providers)
                          <option @if (request()->api_provider == $key) selected @endif value="{{$key}}">{{$api_providers}}</option>
                      @endforeach
                    </select>
                </div>
        
        @if (Gate::allows('isAdmin'))
        <button v-on:click="loadModal()" id="add-service" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
        @endif
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 "> {{Helper::getLang('Services')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 50px;">#</th>
                      <th>{{Helper::getLang('Service')}}</th>
                      <th>{{Helper::getLang('Caregory')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Rate per 1000')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Min/Max order')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Status')}}</th>
                      <th class="text-center" style="width: 140px;">{{Helper::getLang('Actions')}}</th>
                  </tr>
              </thead>
              <tbody>
                <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template v-if="!loading">
                    <service-item
                     v-for="service in services.data"
                     :key="service.id"    
                     :service="service"    
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     :view-fun="loadModalView" 
                     :permissions="permissions" 
                     
                     >
                   </service-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="services" @pagination-change-page="getServices"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.service.service-modal')
@include('admin.modals.delete-modal',['message' =>"Are you sure you want to delete this service?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/service.js')}}"></script>
@endsection