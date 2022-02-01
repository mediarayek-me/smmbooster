@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{asset('admin/js/plugins/flatpickr/flatpickr.min.css')}}">
@endsection
@section('content')
<main id="main-container">

<div class="announcement-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
       
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getAnnouncements()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        <button v-on:click="loadModal()" id="add-announcement" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('Announcements')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 20px;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">{{Helper::getLang('Description')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Type')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 12%;">{{Helper::getLang('Start Date')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 12%;">{{Helper::getLang('End Date')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Status')}}</th>
                      <th class="text-center" style="width: 80px;">{{Helper::getLang('Actions')}}</th>
                  </tr>
              </thead>
              <tbody>
                <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template v-if="!loading">
                    <announcement-item
                     v-for="announcement in announcements.data"
                     :key="announcement.id"    
                     :announcement="announcement"
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     
                     >
                   </announcement-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="announcements" @pagination-change-page="getAnnouncements"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.announcement.announcement-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this announcement?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/announcement.js')}}"></script>
<script src="{{ asset('admin/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script>
<script>
    $('#start_date,#end_date').flatpickr();
</script>

@endsection