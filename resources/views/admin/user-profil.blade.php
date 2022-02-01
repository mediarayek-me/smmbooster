@extends('layouts.admin')


@section('content')
<main id="main-container">

    <div class="content content-full content-boxed">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
                <div>{{Helper::getLang($error)}}</div>
            </div>
        @endforeach
        <div class="block block-rounded">
            <div class="block-content">
                <form ref="user_profil" action="@if(Auth::guard('admin')->check()) {{route('admin.post-profil')}} @else {{route('user.post-profil')}} @endif" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> {{Helper::getLang('User Profile')}}
                    </h2>
                    <div class="row push">
                        <div class="col-lg-4">
                                {{Helper::getLang('Your account info. your username will be publicly visible.')}}
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="username">{{Helper::getLang('Username')}}</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="{{Helper::getLang('username')}}" value="{{auth()->user()->username}}">
                            </div>
                            <div class="form-group">
                                <label for="firstname">{{Helper::getLang('Firstname')}}</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="{{Helper::getLang('Firstname')}}" value="{{auth()->user()->firstname}}">
                            </div>
                            <div class="form-group">
                                <label for="lastname">{{Helper::getLang('Lastname')}}</label>
                                <input type="text" class="form-control" id="Lastname" name="lastname" placeholder="{{Helper::getLang('Lastname')}}" value="{{auth()->user()->lastname}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{Helper::getLang('Email Address')}}</label>
                                <input readonly type="email" class="form-control" id="email" name="email" placeholder="{{Helper::getLang('email')}}" value="{{auth()->user()->email}}">
                            </div>
                            <div class="form-group">
                                <label>{{Helper::getLang('Your Avatar')}}</label>
                                <div class="push">
                                    <img class="img-avatar" src="{{asset('images/avatars/'.auth()->user()->avatar)}}" alt="">
                                </div>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <input v-on:change="setAvatar($event)" type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="avatar" name="avatar">
                                    <label class="custom-file-label" for="avatar">
                                       <span v-if="avatar">@{{avatar}}</span>
                                       <span v-if="!avatar"> {{Helper::getLang('Choose a new avatar')}}</span>
                                    </label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Change Password -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-asterisk text-muted mr-1"></i> {{Helper::getLang('Change Password')}}
                    </h2>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                                {{Helper::getLang('Changing your sign in password is an easy way to keep your account secure.')}}
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="password">{{Helper::getLang('Current Password')}}</label>
                                <input v-model="password" type="password" class="form-control" id="password" name="password">
                                <div v-if="errors.password" class="invalid-feedback m-0 d-block ">
                                    <span v-if="errors.password.required">{{Helper::getLang('password is required')}}</span> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password_new">{{Helper::getLang('New Password')}}</label>
                                    <input v-model="password_new" type="password" class="form-control" id="password_new" name="password_new">
                                    <div v-if="errors.password_new" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.password_new.required">{{Helper::getLang('new password is required')}}</span> 
                                        <span v-if="errors.password_new.minimum">{{Helper::getLang('new password should have minimum 8 characters')}}</span>  
                                      </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="password_new_confirm">{{Helper::getLang('Confirm New Password')}}</label>
                                    <input  v-model="password_new_confirm" type="password" class="form-control" id="password_new_confirm" name="password_new_confirm">
                                    <div v-if="errors.password_new_confirm" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.password_new_confirm.notmatch">{{Helper::getLang('password didn\'t match')}}</span>  

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Change Password -->

                    <!-- Submit -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5 offset-lg-4">
                            <div class="form-group">
                                <button v-on:click="validateUserPassword()" type="button" class="btn btn-alt-primary">
                                    <i class="fa fa-check-circle mr-1"></i>{{Helper::getLang('Update Profile')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Submit -->
                </form>
            </div>
        </div>
    </div>

</main>


<!-- END Page Container -->
@endsection

@section('scripts')
@if(session()->has('success_update') == true)
    @php session()->forget('success_update') @endphp
        <script>
            jQuery(function () {
                window.utilities.notify('success', 'your profile updated successfully');
            })
        </script>
 @endif

<script src="{{asset('js/pages/user.js')}}"></script>
@endsection