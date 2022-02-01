@extends('layouts.app')

@section('content')
<div id="page-container">

    <!-- Main Container -->
    <main>
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo24@2x.jpg')}}');">
            <div class="hero bg-black-90">
                <div class="hero-inner">
                    <div class="content content-full">
                        <div class="px-3 py-5 text-center">
                            <div class="mb-3">
                                <a class="link-fx font-w700 font-size-h1" href="{{route('welcome')}}">
                                    <span class="text-white text-uppercase">{{Helper::settings('website_name_1')}}</span><span class="text-primary text-uppercase">{{Helper::settings('website_name_2')}}</span>
                                </a>
                                <p class="text-uppercase font-w700 font-size-sm text-muted">{{Helper::getLang('Maintenance Mode')}}</p>
                            </div>
                            <h1 class="text-white font-w700 mt-5 mb-3">{{Helper::getLang('Working on some stuff..')}}</h1>
                            <h2 class="h3 text-white-75 font-w400 text-muted mb-5">{{Helper::getLang('Don’t worry though, we’ll be back soon!')}}</h2>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
@endsection