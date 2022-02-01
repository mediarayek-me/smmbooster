@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="user_notifications-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getUserNotifications()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i> {{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        {{-- <button v-on:click="loadModal()" id="add-user_notifications" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button> --}}
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('User Notifications')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 20px;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 25%;">{{Helper::getLang('Subject')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 40%;">{{Helper::getLang('Content')}}</th>
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
                    <user_notifications-item
                     v-for="user_notification in user_notifications.data"
                     :key="user_notification.id"    
                     :user_notification="user_notification"
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     :view-fun="loadModalView" 
                     
                     >
                   </user_notifications-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="user_notifications" @pagination-change-page="getUserNotifications"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.user_notifications.user_notifications-modal')
@include('admin.modals.user_notifications.user_notifications-view-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this user notifications ?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/user_notifications.js')}}"></script>
@endsection