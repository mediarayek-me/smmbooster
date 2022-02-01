@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="order-area my-4">
       <!-- filters bar -->
       <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getOrders()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
        @if (Gate::allows('isUser'))
        <button v-on:click="loadModal()" id="add-service" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
        @endif
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{Helper::getLang('Orders')}}</h3>
        </div>

      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="d-none d-sm-table-cell" style="width: 1%;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 12%;">{{Helper::getLang('User')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 40%;">{{Helper::getLang('Order Details')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 12%;">{{Helper::getLang('Created at')}}</th>
                      @if (Gate::allows('isAdmin'))
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Type')}}</th>
                      @endif
                      <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Status')}}</th>
                      @if (Gate::allows('isAdmin'))
                      <th class="text-center" style="width: 300px;">{{Helper::getLang('Actions')}}</th>
                      @endif
                  </tr>
              </thead>
              <tbody>
                <template v-if="loading">
                    <div class="spinner spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </template>
                <template v-if="!loading">
                    <order-item
                     v-for="order in orders.data"
                     :key="order.id"  
                     :order="order"  
                     :edit-fun="loadModalEdit" 
                     :delete-fun="loadModalDelete"  
                     :view-fun="loadModalView"  
                     :permissions="permissions"  
                     >
                   </order-item>
                </template>
                
              </tbody>
              
            </table>
            <pagination align="right" :data="orders" @pagination-change-page="getOrders"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>

</main>
<!-- END Page Container -->
@include('admin.modals.order.order-modal')
@include('admin.modals.order.order-edit-modal')
@include('admin.modals.delete-modal',['message' =>"Are you sure you want to delete this order?"])
@endsection
 
@section('scripts')
<script src="{{asset('js/pages/order.js')}}"></script>
@endsection