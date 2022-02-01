@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="transaction-area my-4">
    <!-- filters bar -->
    <div class="block-header bg-white mb-4">
        <div class="m-0">
            <div class="input-group">
                <input v-model="search" type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="{{Helper::getLang('Search')}}">
                <div class="input-group-prepend">
                    <button v-on:click="getTransactions()" type="button" class="btn btn-primary">
                        <i class="fa fa-search mx-2"></i>{{Helper::getLang('Search')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('Transactions')}}</h2>
      </div>
      <div class="block-content">
          <table class="table table-striped table-borderless table-vcenter">
              <thead class="thead-light">
                <tr>
                    <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Transaction ID')}}</th>
                    @if (Gate::allows('isAdmin'))
                    <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('User')}}</th>
                    @endif
                    <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Payment Method')}}</th>
                    @if (!Gate::allows('isAdmin'))
                    <th class="d-none d-sm-table-cell" style="width: 15%;">{{Helper::getLang('Amount (include fee)')}}</th>
                    @else
                    <th class="d-none d-sm-table-cell" style="width: 10%;">{{Helper::getLang('Amount')}}</th>
                    @endif
                    @if (!Gate::allows('isAdmin'))
                    <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Fee')}}</th>
                    @endif
                    @if (Gate::allows('isAdmin'))
                    <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Fee')}}</th>
                    <th class="d-none d-sm-table-cell" style="width: 5%;">{{Helper::getLang('Profit')}}</th>                      
                    @endif
                    <th class="d-none d-sm-table-cell" style="width: 20%;">{{Helper::getLang('Created at')}}</th>
                    <th class="d-none d-sm-table-cell" style="width: 2%;">{{Helper::getLang('Status')}}</th>
                    @if (Gate::allows('isAdmin'))
                    <th class="text-center" style="width: 30%;">{{Helper::getLang('Actions')}}</th>
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
                    <transaction-item
                     v-for="transaction in transactions.data"
                     :key="transaction.id"    
                     :transaction="transaction"    
                     :permissions="permissions"    
                     :edit-fun="loadModal" 
                     :delete-fun="loadModalDelete" 
                     >
                   </transaction-item>
                </template>
                
                   
              </tbody>
          </table>
          <pagination align="right" :data="transactions" @pagination-change-page="getTransactions"></pagination>
      </div>
  </div>
  <!-- END Hover Table -->
</div>
</main>

@include('admin.modals.transaction.transaction-modal')
@include('admin.modals.delete-modal',['message' => "Are you sure you want to delete this transaction?"])
<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/transaction.js')}}"></script>
  
 @include('admin.partials.session-message',['key' => 'success_payment','type'=>'success','message' => Helper::getLang('your payment has been processed successfully')])

@endsection
