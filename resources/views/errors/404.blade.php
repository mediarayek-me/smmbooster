@extends('layouts.app')

@section('content')
<div id="page-container">

    <!-- Main Container -->
    <main>
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('{{asset('admin/media/photos/photo19@2x.jpg')}}');">
            <div class="hero bg-white-95">
                <div class="hero-inner">
                    <div class="content content-full">
                        <div class="px-3 py-5 text-center">
                            <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
                                <div class="col-sm-6 text-center text-sm-right">
                                    <div class="display-1 text-danger font-w700">404</div>
                                </div>
                                <div class="col-sm-6 text-center d-sm-flex align-items-sm-center">
                                    <div class="display-1 text-muted font-w300">{{Helper::getLang('Error')}}</div>
                                </div>
                            </div>
                            <h1 class="h2 font-w700 mt-5 mb-3 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" data-timeout="300">{{Helper::getLang('You just found an error page..')}}</h1>
                            <h2 class="h3 font-w400 text-muted mb-5 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" data-timeout="450">{{Helper::getLang('We are sorry but the page you are looking for was not found..')}}</h2>
                           
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