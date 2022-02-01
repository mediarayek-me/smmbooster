@extends('layouts.admin')

@section('content')
<main id="main-container">

    <div class="settings-area my-4">
        <h4 class="mt-2 mb-4">{{ Helper::getLang('Email SMTP Settings') }}</h4>
        <div class="card content">
            <div class="card-body">
                <form class="actionForm" action="{{ route('admin.settings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="email">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL DRIVER') }}</label>
                                    <input class="form-control" name="MAIL_DRIVER"
                                        value="@if(isset($settings['MAIL_DRIVER'])){{ $settings['MAIL_DRIVER'] }}@endif">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL HOST') }}</label>
                                    <input class="form-control" name="MAIL_HOST"
                                        value="@if(isset($settings['MAIL_HOST'])){{ $settings['MAIL_HOST'] }}@endif">
                                </div>
                            </div>
                        </div>
                         <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL PORT') }}</label>
                                    <input class="form-control" name="MAIL_PORT"
                                        value="@if(isset($settings['MAIL_PORT'])){{ $settings['MAIL_PORT'] }}@endif">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL ENCRYPTION') }}</label>
                                    <input class="form-control" name="MAIL_ENCRYPTION"
                                        value="@if(isset($settings['MAIL_ENCRYPTION'])){{ $settings['MAIL_ENCRYPTION'] }}@endif">
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL USERNAME') }}</label>
                                    <input class="form-control" name="MAIL_USERNAME"
                                        value="@if(isset($settings['MAIL_USERNAME'])){{ $settings['MAIL_USERNAME'] }}@endif">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        class="form-label">{{ Helper::getLang('MAIL PASSWORD') }}</label>
                                    <input class="form-control" name="MAIL_PASSWORD"
                                        value="@if(isset($settings['MAIL_PASSWORD'])){{ $settings['MAIL_PASSWORD'] }}@endif">
                                </div>
                            </div>
                         </div>
                        </div>
                        <button
                            class="btn btn-primary btn-min-width btn-sm mt-3">{{ Helper::getLang('Save') }}</button>
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
        jQuery(function () {
            window.utilities.notify('success', 'settings saved successfully');
        })

    </script>
@endif
@php session()->forget('success_save') @endphp
    @endsection
