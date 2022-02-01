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
                        <div class="block-content block-content-full text-center px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                            <!-- Header -->
                            <div class="mb-2 text-center">
                                <a class=" mb-2 link-fx font-w700 font-size-h1" href="{{route('welcome')}}">
                                    <span class="text-dark text-uppercase">{{Helper::settings('website_name_1')}}</span><span class="text-primary text-uppercase">{{Helper::settings('website_name_2')}}</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Verify Your Email Address')}}</p>
                            </div>
                            <!-- END Header -->
                            <div class="text-center mb-4 font-size-h4">{{Helper::getLang('Before proceeding, please check your email for a verification link.')}}</div>
                            <div class="text-center mb-4">{{Helper::getLang('If you did not receive the email')}}</div>
                             <form class="" action="{{ route('verification.resend') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-hero-primary ">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i>{{Helper::getLang('resend an other')}}
                                </button>
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

@if(session()->has('verification_link'))
    @php session()->forget('verification_link') @endphp
        <script>
            jQuery(function () {
                window.utilities.notify('success', 'A fresh verification link has been sent to your email address');
            })
        </script>
 @endif

@endsection