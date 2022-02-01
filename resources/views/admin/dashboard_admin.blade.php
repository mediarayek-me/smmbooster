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
                    <div class="font-size-h4 font-w600">{{$total_earnings}} {{Helper::getLang('USD')}}</div>
                    <div class="text-muted">{{Helper::getLang('Total Earnings')}}</div>
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
                    <div class="font-size-h4 font-w600">{{$users_count}}</div>
                    <div class="text-muted">{{Helper::getLang('Total Users')}}</div>
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
                    <i class="fas fa-list fa-3x text-success"></i>
                </div>
                <div class="font-size-h4 font-w600">{{$services_count}}</div>
                <div class="text-muted">{{Helper::getLang('Total Services')}}</div>
            </div>
        </div>
    </a>
</div>
</div>
<div class="row m-0" >
  <div class="col-md-6">
    <div class="col-md-12 block block-rounded block-link-shadow">
        <div  class="col-md-12 loading">
            <div class="spinner spinner-grow" style="color: #82b54b">
            </div>
        </div>
        <canvas class="js-chartjs-analytics-bars-weeks"></canvas>
    </div>
    <div class="col-md-12  block block-rounded block-link-shadow">
        <div  class="col-md-12 loading">
            <div class="spinner spinner-grow" style="color: #ffb119">
            </div>
        </div>
        <canvas class="js-chartjs-analytics-bars-months"></canvas>
    </div>
  </div>
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
                            {{Helper::getLang('Pending')}}
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
                            {{Helper::getLang('Processing')}}
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
                            {{Helper::getLang('Partial')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
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
                        {{Helper::getLang('Completed')}}
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
                        {{Helper::getLang('Cancelled')}}
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
                        {{Helper::getLang('Refunded')}}
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
     <script src="{{asset('admin/js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
     <script src="{{asset('admin/js/plugins/chart.js/Chart.bundle.min.js')}}"></script>  
     <script>jQuery(function(){Dashmix.helpers('easy-pie-chart');});</script>
     {{-- <script src="{{asset('js/pages/dashboard.js')}}"></script> --}}
     <script src="{{asset('admin/js/pages/db_analytics.min.js')}}"></script>  

@endsection

