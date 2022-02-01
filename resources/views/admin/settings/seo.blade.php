@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="settings-area my-4">
    <div class="card content">
        <div class="card-body">
          <form class="actionForm" action="{{route('admin.settings.store')}}" method="POST" >
            @csrf
            <input type="hidden" name="type" value="seo">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="form-group">
                  <label class="form-label">{{Helper::getLang('Scripts Integrations')}}</label>
                  <textarea rows="3" name="scripts_integrations" class="form-control">@if(isset($settings['scripts_integrations'])){{$settings['scripts_integrations']}} @endif</textarea>
                </div>
                  <div class="form-group">
                    <label class="form-label">{{Helper::getLang('Website Keywords')}}</label>
                    <textarea rows="3" name="website_keywords" class="form-control">@if(isset($settings['website_keywords'])){{$settings['website_keywords']}} @endif</textarea>
                  </div>
                <div class="form-group">
                  <label class="form-label">{{Helper::getLang('Website Description')}}</label>
                  <textarea rows="3" name="website_desc" class="form-control">@if(isset($settings['website_desc'])){{$settings['website_desc']}} @endif</textarea>
                </div>
  
                <div class="form-group">
                    <label class="form-label">{{Helper::getLang('Social Title')}}</label>
                    <input class="form-control" name="social_title" value="@if(isset($settings['social_title'])){{$settings['social_title']}} @endif ">
                  </div>
                  <div class="form-group">
                    <label class="form-label">{{Helper::getLang('Social Description')}}</label>
                    <textarea rows="3" name="social_description" class="form-control">@if(isset($settings['social_description'])){{$settings['social_description']}} @endif</textarea>
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-min-width btn-sm ">{{Helper::getLang('Save')}}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
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