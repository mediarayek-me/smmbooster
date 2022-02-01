@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="paymentMethod-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getPaymentMethods()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i> {{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('Payment Methods')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                  <tr>
                      <th class="text-center" style="width: 50px;">#</th>
                      <th class="d-none d-sm-table-cell" style="width: 50%;">{{Helper::getLang('Name')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('transaction fee')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Min')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Max')}}</th>
                      <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Status')}}</th>
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
                    <payment-method-item
                     v-for="paymentMethod in paymentMethods.data"
                     :key="paymentMethod.id"    
                     :payment-method="paymentMethod"    
                     :image="'{{asset('images')}}/'+ paymentMethod.image"  
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     
                     >
                   </payment-method-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="paymentMethods" @pagination-change-page="getPaymentMethods"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.payment_method.payment_method-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this payment Method?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/payment_method.js')}}"></script>
@endsection