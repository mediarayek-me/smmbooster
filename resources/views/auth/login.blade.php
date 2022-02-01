@extends('layouts.auth')

 <!-- Page Container -->
@section('content')
    
    <!-- Main Container -->
    <main id="main-container-fluid">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo11@2x.jpg')}}');">
            <div class="row no-gutters justify-content-center">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Login Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class=" mb-2 link-fx font-w700 font-size-h1" href="{{route('welcome')}}">
                                    <span class="text-dark text-uppercase">{{Helper::settings('website_name_1')}}</span><span class="text-primary text-uppercase">{{Helper::settings('website_name_2')}}</span>
                                </a>
                                @if (request()->is('login'))
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Login')}}</p>
                                @else
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Login As Admin')}}</p>
                                @endif
                            </div>
                            <!-- END Header -->

                            <!-- Login Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            @if (Route::currentRouteName() === 'login')
                                <form class="js-validation-signin" action="{{route('login')}}" method="POST">
                             @else
                                <form class="js-validation-signin" action="{{route('admin.login')}}" method="POST">
                            @endif
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control @if($errors->has('username') || $errors->has('email'))  is-invalid @endif " id="username"  name="username" placeholder="{{Helper::getLang('Email or Username')}}"   autocomplete autofocus >
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('username'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('username'))}}</div>
                                        @elseif ($errors->has('email'))
                                            <div class="invalid-feedback">{{Helper::getLang($errors->first('email'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" name="password" placeholder="{{Helper::getLang('Password')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">{{Helper::getLang($errors->first('password'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                    <div class="custom-control custom-checkbox custom-control-primary">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" checked @if(old('checked')) checked @endif >
                                        <label class="custom-control-label" for="remember">{{Helper::getLang('Remember Me')}}</label>
                                    </div>
                                    <div class="font-w600 font-size-sm py-1">
                                        @if (request()->is('login'))
                                        <a href="{{route('password.request')}}">{{Helper::getLang('Forgot Password?')}}</a>
                                        @else
                                        <a href="{{route('admin.password.request')}}">{{Helper::getLang('Forgot Password?')}}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{Helper::getLang('Login')}}
                                    </button>
                                </div>
                                @if (request()->is('login'))
                                <p class="d-block text-center font-w700 font-size-sm text-black">{{Helper::getLang('you don\'t have an account yet?')}}</p>
                                <a class="text-uppercase font-w700 font-size-sm text-primary d-block text-center" href="{{route('register')}}">{{Helper::getLang('Sign up')}}</a>
                                @endif

                            </form>
                            <!-- END Login Form -->
                        </div>
                    </div>
                    <!-- END Login Block -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
@endsection
        <!-- END Page Container -->
@section('scripts')
@if(session()->has('account_disabled'))
<script>
    jQuery(function(){
        window
        .utilities.notify('error','Your account has been disabled');
    })
</script>
@endif
@php session()->forget('account_disabled') @endphp 
 
@endsection