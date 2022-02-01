@extends('layouts.admin')


@section('content')
<main id="main-container">
<div class="service-area my-4">
    <div v-if="loading" class="col-md-12"  style="height: 400px">
        <div v-show="true" class="spinner spinner-grow text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <template v-if="!loading">
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-block js-tabs-enabled" data-toggle="tabs" role="tablist">
                @foreach ($paymentMethods as $key  => $p)
                <li class="nav-item" style="width: {{100/count($paymentMethods)}}%">
                <a class="nav-link @if($key === 0) active  @endif"  data-toggle="tab"   href="#payement{{$p->id}}">
                    {{$p->name}}
                    <img class="ml-3" style="width:70px"  src="{{asset('images/'.$p->image)}}">
                </a>
                </li>
                @endforeach
             
            </ul>
            <div class="block-content tab-content">
                @foreach ($paymentMethods as $key  => $p)
                <div class="tab-pane @if($key === 0) active  @endif" id="payement{{$p->id}}" role="tabpanel">
                    <h6 class="font-w200 text-center">{{Helper::getLang('You can deposit funds with')}} {{$p->name}} {{Helper::getLang('they will be automatically added into your account')}}</h6>
                    <div class="form-group">
                        <input v-on:input="getAmount()" v-model="postdata.amount" type="number" placeholder="{{Helper::getLang('amount in usd')}}" class="form-control">
                        <div v-if="errors.amount">
                         <div v-if="errors.amount.required" class="invalid-feedback m-0 d-block ">{{Helper::getLang('Amount is required')}}</div>
                        <div v-if="errors.amount.max" class="invalid-feedback m-0 d-block ">{{Helper::getLang('amount must be less than maximum amount')}}</div>
                        <div  v-if="errors.amount.min" class="invalid-feedback m-0 d-block ">{{Helper::getLang('amount must be greater than minimum amount')}}</div>
                        </div>
                    </div>
                    @if ($key == 1)
                      @include('admin.partials.checkout-form')
                    @endif
                    <div class="form-group">
                        <ul>
                      @if ($key === 1)
                      <li > {{Helper::getLang('Transaction fee')}} : <span id="strip_fee">{{floatval($p->fee)}}</span>%</li>
                      @endif
                      @if ($key === 0)
                      <li > {{Helper::getLang('Transaction fee')}} : <span id="paypal_fee">{{floatval($p->fee)}}</span>%</li>
                      @endif
                        <li> {{Helper::getLang('Minimal payment')}} : ${{$p->min}}</li>
                        <li> {{Helper::getLang('Maximal payment')}} : ${{$p->max}}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                       <strong> {{Helper::getLang('Total Amount To Pay')}} : $@{{total_funds}} </strong>
                    </div>
                   <div class="form-group">
                    <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                        <input  v-model="postdata.confirmation"  type="checkbox" class="custom-control-input" id="confirmation" name="confirmation">
                        <label class="custom-control-label text-uppercase" for="confirmation"> {{Helper::getLang('I understand that funds will not be asked for refund')}}</label>
                        <div v-if="errors.confirmation" class="invalid-feedback m-0 d-block ">{{Helper::getLang('confirmation is required')}}</div>
                    </div>
                   
                   </div>
                   <div class="d-flex justify-content-center block-content block-content-full text-right">
                        <button :disabled="processing" v-on:click="addFunds({{$p->id}})" type="button" class="w-100 btn btn-primary">{{Helper::getLang('Add funds')}} <i v-if="processing" class="fa ml-2 fa-sync fa-spin"></i></button>
                </div>
                </div>
                @endforeach
            </div>
        </div>
    </template>
   

</div>
</main>

<!-- END Page Container -->
@endsection
@section('css')
<style>
    .StripeElement {
       background-color: #ffffff;
       padding: 8px 12px;
       border-radius: 4px;
       border: 1px solid #d4dcec;
      transition: box-shadow 150ms ease;
      width: 100%;
   }

   .StripeElement--focus {
       box-shadow: 0 1px 3px 0 #cfd7df;
   }

   .StripeElement--invalid {
       border-color: #fa755a;
   }

   .StripeElement--webkit-autofill {
       background-color: #fefde5 !important;
   }
</style>    
@endsection

@section('header-scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('scripts')
<script src="{{asset('js/pages/funds.js')}}"></script>

@endsection

