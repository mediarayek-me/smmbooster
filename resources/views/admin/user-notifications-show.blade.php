@extends('layouts.admin')


@section('content')
<main id="main-container">

<div class="user_notifications-area my-4">

    <!-- Hover Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
          <h2 class="block-title text-uppercase font-w500 ">{{Helper::getLang('User Notifications')}}</h2>
      </div>
      <div class="block-content">
          <!-- user_notification details modal -->
          <div  id="from-user_notification">
            @csrf
            <div class="block block-themed block-transparent mb-0">
                <div class="px-3  mt-3">
                   
                    <div class="form-group">
                            <label for="subject">{{Helper::getLang('Subject')}}</label>
                      <div  class="p-2 border">{!!$userNotification->subject!!}</div>
                           
                    </div>
                    <div class="form-group">
                        <label for="content">{{Helper::getLang('Content')}}</label>
                        <div class="p-4 border">{!!$userNotification->content!!}</div>
                    </div>
                 </div>

                </div>
            </div>
        </form>
  </div>
  <!-- END Hover Table -->
</div>
</main>

<!-- END Page Container -->
@endsection

@section('scripts')
<script src="{{asset('js/pages/user_notifications.js')}}"></script>
@endsection