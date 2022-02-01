@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="settings-area my-4">
    <h4 class="mt-2 mb-4">{{Helper::getLang('Email Settings')}}</h4>
    <div class="card content">
        <div class="card-body">
          <form class="actionForm" action="{{route('admin.settings.store')}}" method="POST" >
            @csrf
            <input type="hidden" name="type" value="email">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="block block-rounded">
                    <ul class="nav nav-tabs nav-tabs-block js-tabs-enabled" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link active" href="#new_user_welcome_email">{{Helper::getLang('Welcome Email')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#email_verification">{{Helper::getLang('Email verification')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#payment_notification">{{Helper::getLang('Payments')}} </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#order_status">{{Helper::getLang('Order Status')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#password_recovery">{{Helper::getLang('Password Recovery')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#reply_support_ticket">{{Helper::getLang('Support Ticket')}}</a>
                        </li>
                    
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="new_user_welcome_email" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="new_user_welcome_email_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="new_user_welcome_email_tpl_active" name="new_user_welcome_email_tpl_active"  @if(isset($settings['new_user_welcome_email_tpl_active']) && $settings['new_user_welcome_email_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="new_user_welcome_email_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl @if(!isset($settings['new_user_welcome_email_tpl_active']) || $settings['new_user_welcome_email_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['new_user_welcome_email_tpl_subject'])){{$settings['new_user_welcome_email_tpl_subject'] }}@endif" name="new_user_welcome_email_tpl_subject"   name="new_user_welcome_email_tpl_subject" type="text" class="form-control">
                                </div>
                                 
                                <div class="form-group">
                                    <textarea  name="new_user_welcome_email_tpl" id="new_user_welcome_email_tpl">@if(isset($settings['new_user_welcome_email_tpl'])){{$settings['new_user_welcome_email_tpl'] }}@endif</textarea>
                                </div>
                                <div class="from-group">
                                    <label>{{Helper::getLang('Note')}}</label>
                                    <ul>
                                        <li>@{{username}} : {{Helper::getLang('displays the user\'s username')}}</li>
                                        <li>@{{firstname}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                        <li>@{{lastname}} : {{Helper::getLang('displays the user\'s lastname')}}</li>
                                        <li>@{{email}} : {{Helper::getLang('displays user\'s email')}}</li>
                                        <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="email_verification" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="email_verification_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="email_verification_tpl_active" name="email_verification_tpl_active"  @if(isset($settings['email_verification_tpl_active']) && $settings['email_verification_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="email_verification_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl  @if(!isset($settings['email_verification_tpl_active']) || $settings['email_verification_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['email_verification_tpl_subject'])){{$settings['email_verification_tpl_subject'] }}@endif" name="email_verification_tpl_subject" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea name="email_verification_tpl" id="email_verification_tpl">@if(isset($settings['email_verification_tpl'])){{$settings['email_verification_tpl'] }}@endif</textarea>
                                </div>
                            </div>
                            <div class="from-group">
                                <label>{{Helper::getLang('Note')}}</label>
                                <ul>
                                    <li>@{{firstname}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                    <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>
                                    <li>@{{activation_link}} : {{Helper::getLang('displays the activation link')}}</li>
                                
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="payment_notification" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="payment_notification_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="payment_notification_tpl_active" name="payment_notification_tpl_active"  @if(isset($settings['payment_notification_tpl_active']) && $settings['payment_notification_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="payment_notification_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl  @if(!isset($settings['payment_notification_tpl_active']) || $settings['payment_notification_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['payment_notification_tpl_subject'])){{$settings['payment_notification_tpl_subject'] }}@endif" name="payment_notification_tpl_subject" type="text" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <textarea name="payment_notification_tpl" id="payment_notification_tpl">@if(isset($settings['payment_notification_tpl'])){{$settings['payment_notification_tpl'] }}@endif</textarea>
                                </div>
                                <div class="from-group">
                                    <label>{{Helper::getLang('Note')}}</label>
                                    <ul>
                                        <li>@{{username}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                        <li>@{{currency}} : {{Helper::getLang('displays the transaction currency')}}</li>
                                        <li>@{{method_name}} : {{Helper::getLang('displays the transaction  payment method name')}}</li>
                                        <li>@{{transaction_number}} : {{Helper::getLang('displays the transaction number')}}</li>
                                        <li>@{{balance}} : {{Helper::getLang('displays user balance')}}</li>
                                        <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="order_status" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="order_status_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="order_status_tpl_active" name="order_status_tpl_active"  @if(isset($settings['order_status_tpl_active']) && $settings['order_status_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="order_status_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl  @if(!isset($settings['order_status_tpl_active']) || $settings['order_status_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['order_status_tpl_subject'])){{$settings['order_status_tpl_subject'] }}@endif" name="order_status_tpl_subject" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea name="order_status_tpl" id="order_status_tpl">@if(isset($settings['order_status_tpl'])){{$settings['order_status_tpl'] }}@endif</textarea>
                                </div>
                                <div class="from-group">
                                    <label>{{Helper::getLang('Note')}}</label>
                                    <ul>
                                        <li>@{{firstname}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                        <li>@{{currency}} : {{Helper::getLang('displays the order currency')}}</li>
                                        <li>@{{balance}} : {{Helper::getLang('displays user balance')}}</li>
                                        <li>@{{service_name}} : {{Helper::getLang('displays service name')}}</li>
                                        <li>@{{service_category}} : {{Helper::getLang('displays service category')}}</li>
                                        <li>@{{price}} : {{Helper::getLang('displays order service category')}}</li>
                                        <li>@{{status}} : {{Helper::getLang('displays order status')}}</li>
                                        <li>@{{order_ID}} : {{Helper::getLang('displays order ID')}}</li>
                                        <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="password_recovery" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="password_recovery_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="password_recovery_tpl_active" name="password_recovery_tpl_active"  @if(isset($settings['password_recovery_tpl_active']) && $settings['password_recovery_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="password_recovery_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl  @if(!isset($settings['password_recovery_tpl_active']) || $settings['password_recovery_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['password_recovery_tpl_subject'])){{$settings['password_recovery_tpl_subject'] }}@endif" name="password_recovery_tpl_subject" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea name="password_recovery_tpl" id="password_recovery_tpl">@if(isset($settings['password_recovery_tpl'])){{$settings['password_recovery_tpl'] }}@endif</textarea>
                                </div>
                                <div class="from-group">
                                    <label>{{Helper::getLang('Note')}}</label>
                                    <ul>
                                        <li>@{{firstname}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                        <li>@{{recovery_password_link}} : {{Helper::getLang('displays the recovery password link')}}</li>
                                        <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="reply_support_ticket" role="tabpanel">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="reply_support_ticket_tpl_active" value="off">
                                    <input type="checkbox" class="custom-control-input" id="reply_support_ticket_tpl_active" name="reply_support_ticket_tpl_active"  @if(isset($settings['reply_support_ticket_tpl_active']) && $settings['reply_support_ticket_tpl_active'] === 'on') checked @endif>
                                    <label class="custom-control-label" for="reply_support_ticket_tpl_active"></label>
                                </div>
                            </div>
                            <div class="tpl  @if(!isset($settings['reply_support_ticket_tpl_active']) || $settings['reply_support_ticket_tpl_active'] === 'off') d-none @endif">
                                <div class="form-group">
                                    <label>{{Helper::getLang('Subject')}}</label>
                                    <input value="@if(isset($settings['reply_support_ticket_tpl_subject'])){{$settings['reply_support_ticket_tpl_subject'] }}@endif" name="reply_support_ticket_tpl_subject" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <textarea name="reply_support_ticket_tpl" id="reply_support_ticket_tpl">@if(isset($settings['reply_support_ticket_tpl'])){{$settings['reply_support_ticket_tpl'] }}@endif</textarea>
                                </div>
                                <div class="from-group">
                                    <label>{{Helper::getLang('Note')}}</label>
                                    <ul>
                                        <li>@{{firstname}} : {{Helper::getLang('displays the user\'s firstname')}}</li>
                                        <li>@{{website_name}} : {{Helper::getLang('displays the website name')}}</li>
                                        <li>@{{ticket_id}} : {{Helper::getLang('displays the ticket id')}}</li>
                                        <li>@{{ticket_subject}} : {{Helper::getLang('displays the ticket subject')}}</li>
                                        <li>@{{ticket_link}} : {{Helper::getLang('displays the ticket link')}}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    
             </div>
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-min-width btn-sm ">Save</button>
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
 <!-- Page JS Plugins -->
 <script src="{{ asset('admin/js/plugins/ckeditor5-classic/build/ckeditor.js') }}">
 </script>

 <!-- Page JS Helpers (CKEditor 5 plugins) -->
 <script>
     var hideTemplate = function($e)
     {
         $e.parent().parent().parent().find('.tpl').toggleClass('d-none')
     }
     jQuery(function () {
         Dashmix.helpers(['ckeditor5']);

         $("#new_user_welcome_email_tpl_active,#email_verification_tpl_active,#payment_notification_tpl_active,#order_status_tpl_active,#password_recovery_tpl_active,#reply_support_ticket_tpl_active").on('change',function(){
            hideTemplate($(this))
         })
     });

 </script>
<script>
    ['#new_user_welcome_email_tpl','#email_verification_tpl','#order_status_tpl','#payment_notification_tpl','#password_recovery_tpl','#reply_support_ticket_tpl']
    .forEach(e => {
        ClassicEditor
         .create(document.querySelector(e))
    });
    
</script>
@endsection