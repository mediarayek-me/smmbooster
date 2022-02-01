@extends('layouts.admin')


@section('content')
<main id="main-container">
  <div class="category-area my-4">
  <!-- Overview -->
  <div class="row invisible  m-0" data-toggle="appear">
    <div class="col-md-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="py-4 text-center">
                    <div class="mb-3">
                      <i class="fas fa-money-bill-wave-alt fa-3x text-xinspire"></i>
                    </div>
                    <div class="font-size-h4 font-w600">{{$balance}} {{Helper::getLang('USD')}}</div>
                    <div class="text-muted">{{Helper::getLang('Your Balance')}}</div>
                </div>
            </div>
        </a>
      </div>
      <div class="col-md-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="py-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                    </div>
                    <div class="font-size-h4 font-w600">{{$ordrs_count}}</div>
                    <div class="text-muted">{{Helper::getLang('Total Orders')}}</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="py-4 text-center">
                    <div class="mb-3">
                        <i class="far fa-user fa-3x text-xinspire"></i>
                    </div>
                    <div class="font-size-h4 font-w600">{{$total_spent}} {{Helper::getLang('USD')}}</div>
                    <div class="text-muted">{{Helper::getLang('Total Spent')}} </div>
                </div>
            </div>
        </a>
    </div>
   
  <div class="col-md-3">
    <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
        <div class="block-content block-content-full">
            <div class="py-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-list fa-3x text-success"></i>
                </div>
                <div class="font-size-h4 font-w600">{{$transactions_count}}</div>
                <div class="text-muted">{{Helper::getLang('Transactions')}}</div>
            </div>
        </div>
    </a>
</div>
</div>
<div class="row m-0" >

 <div class="col-md-6">
    <div class="js-appear-enabled animated fadeIn" data-toggle="appear" >
        <a class="block block-rounded block-link-pop" style="padding: 13px" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="py-3 border-right">
                            <div class="item item-circle bg-body-light mx-auto">
                                <i class="fas fa-spinner text-dark"></i>
                            </div>
                            <p class="font-size-h3 font-w300 mt-3 mb-0">
                                {{ Helper::getOrdersCount('pending') }}
                            </p>
                            <p class="text-muted mb-0">
                              Pending
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="py-3 border-right">
                            <div class="item item-circle bg-body-light mx-auto">
                                <i class="fas fa-sync-alt text-info"></i>
                            </div>
                            <p class="font-size-h3 font-w300 mt-3 mb-0">
                                {{ Helper::getOrdersCount('processing') }}
                            </p>
                            <p class="text-muted mb-0">
                                Processing
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="py-3">
                            <div class="item item-circle bg-body-light mx-auto">
                                <i class="fas fa-cog text-primary"></i>
                            </div>
                            <p class="font-size-h3 font-w300 mt-3 mb-0">
                                {{ Helper::getOrdersCount('partial') }}
                            </p>
                            <p class="text-muted mb-0">
                                Partial
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
 </div>
 <div class="col-md-6">
    <div class="js-appear-enabled animated fadeIn" data-toggle="appear">
        <a class="block block-rounded block-link-pop" style="padding: 13px"  href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="row text-center">
                  <div class="col-4">
                      <div class="py-3">
                          <div class="item item-circle bg-body-light mx-auto">
                              <i class="fas fa-check-circle text-success"></i>
                          </div>
                          <p class="font-size-h3 font-w300 mt-3 mb-0">
                              {{ Helper::getOrdersCount('completed') }}
                          </p>
                          <p class="text-muted mb-0">
                              Completed
                          </p>
                      </div>
                  </div>
                    <div class="col-4">
                        <div class="py-3 border-right">
                            <div class="item item-circle bg-body-light mx-auto">
                                <i class="fas fa-window-close text-danger"></i>
                            </div>
                            <p class="font-size-h3 font-w300 mt-3 mb-0">
                              {{ Helper::getOrdersCount('cancelled') }}
                            </p>
                            <p class="text-muted mb-0">
                                Cancelled
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="py-3 border-right">
                            <div class="item item-circle bg-body-light mx-auto">
                                <i class="fas fa-backward text-warning"></i>
                            </div>
                            <p class="font-size-h3 font-w300 mt-3 mb-0">
                              {{ Helper::getOrdersCount('refunded') }}
                            </p>
                            <p class="text-muted mb-0">
                                Refunded
                            </p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </a>
      </div>
 </div>

</div>
  </div>
</main>

@endsection

@section('scripts')
    @if(session()->has('verify'))
    <script>
        jQuery(function(){
            window.utilities.notify('success','Your account has been verified successfully');
        })
    </script>
    @endif
     <script src="{{asset('admin/js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
     <script src="{{asset('admin/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>  
     <script>jQuery(function(){Dashmix.helpers('easy-pie-chart');});</script>
     <script src="{{asset('js/pages/dashboard.js')}}"></script>
     <script src="{{asset('js/pages/dashboard.js')}}"></script>
     <script src="{{asset('admin/js/pages/db_analytics.min.js')}}"></script> 
  


@endsection

