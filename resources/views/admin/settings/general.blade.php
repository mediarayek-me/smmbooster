@extends('layouts.admin')

@section('content')
<main id="main-container">

<div class="settings-area my-4">
    <h4 class="mt-2 mb-4">{{Helper::getLang('General Settings')}}</h4>
    <div class="card content">
        <div class="card-body">
          <form class="actionForm" action="{{route('admin.settings.store')}}" method="POST" >
            @csrf
            <input type="hidden" name="type" value="general">
              <div class="col-md-12 col-lg-12">
               
                <div class="row d-flex justify-content-between">
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-control-inline">
                            <input type="hidden" name="maintenance_mode" value="off">
                            <input type="checkbox" class="custom-control-input" id="maintenance-mode" name="maintenance_mode"  @if(isset($settings['maintenance_mode']) && $settings['maintenance_mode'] === 'on') checked @endif>
                            <label class="custom-control-label" for="maintenance-mode">{{Helper::getLang('Maintenance mode')}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-control-inline">
                            <input type="hidden" name="user_registration" value="off">
                            <input type="checkbox" class="custom-control-input" id="user-registration" name="user_registration"  @if(isset($settings['user_registration']) && $settings['user_registration'] === 'on') checked @endif>
                            <label class="custom-control-label" for="user-registration">{{Helper::getLang('User Registration')}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-control-inline">
                            <input type="hidden" name="user_login" value="off">
                            <input type="checkbox" class="custom-control-input" id="user-login" name="user_login"  @if(isset($settings['user_login']) && $settings['user_login'] === 'on') checked @endif>
                            <label class="custom-control-label" for="user-login">{{Helper::getLang('User Login')}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-control-inline">
                            <input type="hidden" name="email_verification" value="off">
                            <input type="checkbox" class="custom-control-input" id="email-verification" name="email_verification"  @if(isset($settings['email_verification']) && $settings['email_verification'] === 'on') checked @endif>
                            <label class="custom-control-label" for="email-verification">{{Helper::getLang('Email verification')}}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Website Name 1')}}</label>
                            <input class="form-control" name="website_name_1" value="@if(isset($settings['website_name_1'])){{$settings['website_name_1']}} @endif">
                          </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Website Name 2')}}</label>
                            <input class="form-control" name="website_name_2" value="@if(isset($settings['website_name_2'])){{$settings['website_name_2']}} @endif ">
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Website Title')}}</label>
                            <input class="form-control" name="website_title" value="@if(isset($settings['website_title'])){{$settings['website_title']}} @endif ">
                          </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Currency Code')}}</label>
                            <select class="form-control" name="currency" id="currency" value="@if(isset($settings['currency'])){{$settings['currency']}}@endif">
                                @foreach (Helper::currency() as $key => $currency)
                                    <option @if(isset($settings['currency']) && $settings['currency'] === $currency ) selected @endif value="{{$key}}">{{$currency}}</option>
                                @endforeach
                              </select>
                          </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Currency Symbol')}}</label>
                            <input class="form-control" name="currency_symbol" value="@if(isset($settings['currency_symbol'])){{$settings['currency_symbol']}} @endif ">
                          </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Facebook Link')}}</label>
                            <input class="form-control" name="facebook_link" value="@if(isset($settings['facebook_link'])){{$settings['facebook_link']}} @endif ">
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Twitter Link')}}</label>
                            <input class="form-control" name="twitter_link" value="@if(isset($settings['twitter_link'])){{$settings['twitter_link']}} @endif ">
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Linkedin Link')}}</label>
                            <input class="form-control" name="linkedin_link" value="@if(isset($settings['linkedin_link'])){{$settings['linkedin_link']}} @endif ">
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{Helper::getLang('Instagram Link')}}</label>
                            <input class="form-control" name="instagram_link" value="@if(isset($settings['instagram_link'])){{$settings['instagram_link']}} @endif ">
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
