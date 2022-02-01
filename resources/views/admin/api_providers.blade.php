@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="api_provider-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getApiProviders()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        <button v-on:click="loadModal()" id="add-api_provider" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('API Providers')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 10px;">#</th>
                      <th>{{Helper::getLang('Name')}}</th>
                      <th  style="width: 5%;">{{Helper::getLang('Balance')}}</th>
                      <th  style="width: 5%;">{{Helper::getLang('Services')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Url')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Connected')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Notes')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Status')}}</th>
                      <th class="text-center" style="width: 600px;">{{Helper::getLang('Actions')}}</th>
                  </tr>
              </thead>
              <tbody>
                <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template v-if="!loading">
                    <api_provider-item
                     v-for="api_provider in api_providers.data"
                     :key="api_provider.id"  
                     :api_provider="api_provider"  
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     >
                   </api_provider-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="api_providers" @pagination-change-page="getApiProviders"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.api_provider.api_provider-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this API?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/api_provider.js')}}"></script>
@endsection