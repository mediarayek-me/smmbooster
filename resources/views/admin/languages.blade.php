@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="language-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getLanguages()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i> {{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        <button v-on:click="loadModal()" id="add-language" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('Languages')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 10px;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">{{Helper::getLang('name')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('code')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('image')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('direction')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('sort')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('is default')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Status')}}</th>
                      <th class="text-center" style="width: 100px;">{{Helper::getLang('Actions')}}</th>
                  </tr>
              </thead>
              <tbody>
                <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template v-if="!loading">
                    <language-item
                     v-for="language in languages.data"
                     :key="language.id"    
                     :language="language"
                     :image="'{{asset('images')}}/'+ language.image"  
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     :view-fun="loadPageView" 
                     
                     >
                   </language-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="languages" @pagination-change-page="getLanguages"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.language.language-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this language?"])
<!-- END Page Container -->
@endsection

@section('scripts')
@if(session()->has('success_save') == true)
<script>
    jQuery(function(){
        window
        .utilities.notify('success','language saved successfully');
    })
</script>
@endif
@php session()->forget('success_save') @endphp
@if(session()->has('success_update'))
<script>
    jQuery(function(){
        window.utilities.notify('success','language updated successfully');
    })
</script>
@endif
@php session()->forget('success_update') @endphp
<script src="{{asset('js/pages/language.js')}}"></script>
@endsection