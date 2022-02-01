@extends('layouts.auth')

@section('content')
    
    <!-- Main Container -->
    <main id="main-container-fluid">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo11@2x.jpg')}}');">
            <div class="row no-gutters justify-content-center bg-black-75">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <!-- Sign Up Block -->
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class="link-fx text-primary font-w700 font-size-h1" href="{{route('welcome')}}">
                                    <span class="text-dark text-uppercase">{{Helper::settings('website_name_1')}}</span><span class="text-primary text-uppercase">{{Helper::settings('website_name_2')}}</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Create New Account')}}</p>
                            </div>
                            <!-- END Header -->

                            <!-- Sign Up Form -->
                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signup" action="{{route('register')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" id="username" name="username" placeholder="{{Helper::getLang('Username')}}" value="{{old('username')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('username'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('username'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control @if($errors->has('firstname')) is-invalid @endif" id="firstname" name="firstname" placeholder="{{Helper::getLang('Firstname')}}" value="{{old('firstname')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('firstname'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('firstname'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control @if($errors->has('lastname')) is-invalid @endif" id="lastname" name="lastname" placeholder="{{Helper::getLang('Lastname')}}" value="{{old('lastname')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user-circle"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('lastname'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('lastname'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" placeholder="{{Helper::getLang('Email')}}" value="{{old('email')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-envelope-open"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('email'))
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
                                        @if($errors->has('password'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('password'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" id="password-confirm" name="password_confirmation" placeholder="{{Helper::getLang('Password Confirm')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-asterisk"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">{{Helper::getLang($errors->first('password_confirmation'))}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <a class="font-w600 font-size-sm" href="#" data-toggle="modal" data-target="#modal-terms">{{Helper::getLang('Terms & Conditions')}}</a>
                                    <div class="custom-control custom-checkbox custom-control-primary">
                                        <input type="checkbox" class="custom-control-input @if($errors->has('terms'))  is-invalid @endif" {{old('terms')?  'checked' : ''}} id="terms" name="terms">
                                        <label class="custom-control-label" for="terms">{{Helper::getLang('I agree')}}</label>
                                    </div>
                                    @if($errors->has('terms'))
                                    <div  class="invalid-feedback d-block">{{Helper::getLang($errors->first('terms'))}}</div>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-hero-primary">
                                        <i class="fa fa-fw fa-plus mr-1"></i>{{Helper::getLang('Sign Up')}}
                                    </button>
                                </div>
                            </form>
                            <p class="d-block text-center font-w700 font-size-sm text-black">{{Helper::getLang('already have an account ?')}}</p>
                            <a class="text-uppercase font-w700 font-size-sm text-primary d-block text-center" href="{{route('login')}}">{{Helper::getLang('Sign in')}}</a>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign Up Block -->
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

<!-- Terms Modal -->
<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-success">
                    <h3 class="block-title">{{Helper::getLang('Terms & Conditions')}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    {!! Helper::settings('terms_policy') !!}
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Terms Modal -->
@endsection
        <!-- END Page Container -->
@section('scripts')
    
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('admin/js/core.js')}}"></script>
<script src="{{asset('admin/js/app.js')}}"></script>

<!-- Page JS Plugins -->
<script src="{{asset('admin/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<!-- Page JS Code -->
<script src="{{asset('admin/js/pages/op_auth_signup.min.js')}}"></script>


@endsection