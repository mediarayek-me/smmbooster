@extends('layouts.auth')

        <!-- Page Container -->
@section('content')
    
       <!-- Main Container -->
       <main id="main-container-fluid">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo21@2x.jpg')}}');">
            <div class="row no-gutters justify-content-center bg-black-75">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Reminder Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ Helper::getLang(session('status')) }}
                            </div>
                        @endif
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx text-warning font-w700 font-size-h1" href="{{route('user.dashboard')}}">
                                    <span class="text-dark text-uppercase">{{Helper::settings('website_name_1')}}</span><span class="text-warning text-uppercase">{{Helper::settings('website_name_2')}}</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Password Reminder')}}</p>
                            </div>
                            <!-- END Header -->
                            @if (request()->is('admin/*'))
                            <form class="js-validation-reminder" action="{{route('admin.password.email')}}" method="post">
                            @else
                            <form class="js-validation-reminder" action="{{route('password.email')}}" method="post">
                            @endif
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email"  placeholder="{{Helper::getLang('Email')}}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{Helper::getLang($message)}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-warning">
                                        <i class="fa fa-fw fa-reply mr-1"></i>{{Helper::getLang('Reset Password')}}
                                    </button>
                                </div>
                            </form>
                            <!-- END Reminder Form -->
                        </div>
                    </div>
                    <!-- END Reminder Block -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
        <!-- END Page Container -->
@section('scripts')
    
<script src="{{asset('admin/js/dashmix.core.min.js')}}"></script>

       
<script src="{{asset('admin/js/dashmix.app.min.js')}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset('admin/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<!-- Page JS Code -->
<script src="{{asset('admin/js/pages/op_auth_reminder.min.js')}}"></script>
@endsection