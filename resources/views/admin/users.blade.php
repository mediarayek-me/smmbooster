@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="users-area my-4">
       <!-- filters bar -->
       <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getUsers()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        <button v-on:click="loadModal()" id="add-user" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{Helper::getLang('Users')}}</h3>
        </div>

      <div class="block-content">
          <table class="table table-hover table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="d-none d-sm-table-cell" style="width: 2%;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 25%;">{{Helper::getLang('User profil')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Funds')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">{{Helper::getLang('Notes')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 14%;">{{Helper::getLang('Created at')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10px;">{{Helper::getLang('Status')}}</th>
                      <th class="text-center" style="width: 30px">{{Helper::getLang('Actions')}}</th>
                  </tr>
              </thead>
              <tbody>
                 <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template> 
                <template v-if="!loading">
                    <user-item
                     v-for="user in users.data"
                     :key="user.id"    
                     :user="user"    
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     :view-fun="loadModalView" 
                     >
                   </user-item>
                </template>
              </tbody>
          </table>
          <pagination align="right" :data="users" @pagination-change-page="getUsers"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>


</main>

@include('admin.modals.user.user-modal')
@include('admin.modals.user.user-view-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this user?"])

<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/user.js')}}"></script>
@endsection