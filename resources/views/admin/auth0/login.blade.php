@extends('layouts.auth')

        <!-- Page Container -->
@section('content')

    <!-- Main Container -->
    <main id="main-container-fluid">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo11@2x.jpg')}}');">
            <div class="row no-gutters justify-content-center">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign In Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class=" mb-2 link-fx font-w700 font-size-h1" href="index.html">
                                    <span class="text-dark">SMM</span><span class="text-primary">STORE</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Sign In')}}</p>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <form class="js-validation-signin" action="{{route('admin.login')}}" method="POST">
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
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('email'))}} </div>
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
                                            <div class="invalid-feedback">{{$errors->first('password')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                                    <div class="custom-control custom-checkbox custom-control-primary">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" checked @if(old('checked')) checked @endif >
                                        <label class="custom-control-label" for="remember">{{Helper::getLang('Remember Me')}}</label>
                                    </div>
                                    <div class="font-w600 font-size-sm py-1">
                                        <a href="{{route('forgot-password')}}">{{Helper::getLang('Forgot Password?')}}</a>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{Helper::getLang('Sign In')}} 
                                    </button>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                    <!-- END Sign In Block -->
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
<script src="{{asset('admin/js/pages/op_auth_signin.min.js')}}"></script>
@endsection