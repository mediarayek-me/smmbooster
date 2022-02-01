@extends('layouts.admin')

@section('content')
<main id="main-container">

<div class="settings-area my-4">
  <h4 class="mt-2 mb-4">{{Helper::getLang('Default Settings')}}</h4>
    <div class="card content">
        <div class="card-body">
            <form class="actionForm" action="{{route('admin.settings.store')}}" method="POST" >
                @csrf
                <input type="hidden" name="type" value="default">
                <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Default Min Order')}}</label>
                            <input class="form-control" name="min_order" value="@if(isset($settings['min_order'])){{$settings['min_order']}} @endif">
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Default Max Order')}}</label>
                            <input class="form-control" name="max_order" value="@if(isset($settings['max_order'])){{$settings['max_order']}} @endif">
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Default price per 1000')}}</label>
                            <input class="form-control" name="price_per_1000" value="@if(isset($settings['price_per_1000'])){{$settings['price_per_1000']}} @endif">
                          </div>
                    </div>
                       
                </div>
            
               
                <button class="btn btn-primary btn-min-width btn-sm mt-3">{{Helper::getLang('Save')}}</button>
                    </div>
  
               
            
            </div>
          </form>
        </div>
      </div>
  
   
</main>

<!-- END Page Container -->
@endsection

@section('scripts')
@if(session()->has('success_save') == true)
<script>
  jQuery(function(){
    window.utilities.notify('success','settings saved successfully');
  })
</script>
@endif
@php session()->forget('success_save') @endphp
@endsection
