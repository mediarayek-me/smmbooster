@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="ticket-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getTickets()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        @if (!Gate::allows('isAdmin'))
        <button v-on:click="loadModal()" id="add-ticket" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>    
        @endif
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('Tickets')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 50px;">#</th>
                      <th>{{Helper::getLang('user')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('type')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Status')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Created at')}}</th>
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
                    <ticket-item
                     v-for="ticket in tickets.data"
                     :key="ticket.id"    
                     :ticket=ticket
                     :view-fun="viewTicket" 
                     :delete-fun="loadModalDelete" 
                     >
                   </ticket-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="tickets" @pagination-change-page="getTickets"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.ticket.ticket-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this ticket?"])
<!-- END Page Container -->
@endsection

@section('scripts')

@if(session()->has('success_save'))
@php session()->forget('success_save') @endphp
<script>
    jQuery(function () {
        window.utilities.notify('success','ticket saved successfully');
    })
    </script>
 @endif
<script src="{{ asset('admin/js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script>
<script>
        jQuery(function () {
            Dashmix.helpers(['ckeditor5']);
            $('.select-file').on('click',function(){
            $(this).parent().find('input').click()
           })
        });

</script>
<script src="{{asset('js/pages/ticket.js')}}"></script>
@endsection