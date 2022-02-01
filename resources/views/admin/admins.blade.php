@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="admins-area my-4">
       <!-- filters bar -->
       <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getAdmins()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        <button v-on:click="loadModal()" id="add-admin" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{Helper::getLang('Admins')}}</h3>
        </div>

      <div class="block-content">
          <table class="table table-hover table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="d-none d-sm-table-cell" style="width: 2%;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Username')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Fullname')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">{{Helper::getLang('Email')}}</th>
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
                    <admin-item
                     v-for="admin in admins.data"
                     :key="admin.id"    
                     :admin="admin"    
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     >
                   </admin-item>
                </template>
              </tbody>
          </table>
          <pagination align="right" :data="admins" @pagination-change-page="getAdmins"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>


</main>

@include('admin.modals.admin.admin-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this admin?"])

<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/admin.js')}}"></script>
@endsection