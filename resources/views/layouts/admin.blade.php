
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{Helper::settings('website_title')}}</title>

        <meta name="description" content="{{Helper::settings('website_desc')}}">
        <meta name="keywords" content="{{Helper::settings('website_desc')}}">
        <meta name="robots" content="noindex, nofollow">
        <meta name="language_id" content="{{session()->get('language_id')}}">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="{{Helper::settings('website_title')}}">
        <meta property="og:site_name" content="{{Helper::settings('website_name_1') .' '.Helper::settings('website_name_2')}}">
        <meta property="og:description" content="{{Helper::settings('website_desc')}}">
        <meta property="og:type" content="website">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('images/'.Helper::settings(['shortcut_icon']))}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/'.Helper::settings(['website_icon']))}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/'.Helper::settings(['apple_icon']))}}">
        <!-- END Icons -->
        <!-- style params-->
        <style>
        @include('layouts.style-config');
        </style>
        <!-- Stylesheets -->
        @yield('css')

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{asset('admin/css/main.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('admin/js/plugins/select2/css/select2.min.css')}}"> --}}
        
         <!-- RTL style -->
         @if (Helper::getDefaultDirection() == 'rtl')
         <link rel="stylesheet" href="{{asset('css/admin-rtl.css')}}">
         @endif

        @yield('header-scripts')


        
      
    </head>
    <body>
        
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed page-header-dark page-header-glass main-content-boxed  
        @if (Helper::getDefaultDirection() == 'rtl') rtl-support sidebar-r  @endif">

            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header (mini Sidebar mode) -->
                <div class="smini-visible-block">
                    <div class="content-header bg-primary">
                        <!-- Logo -->
                        <a class="font-w600 text-white tracking-wide" href="index.html">
                            D<span class="opacity-75">x</span>
                        </a>
                        <!-- END Logo -->
                    </div>
                </div>
                <!-- END Side Header (mini Sidebar mode) -->
        
                <!-- Side Header (normal Sidebar mode) -->
                <div class="smini-hidden">
                    <div class="content-header justify-content-lg-center bg-primary">
                        <!-- Logo -->
                        <a class="font-w600 text-white tracking-wide" href="index.html">
                            <span class="opacity-75 text-uppercase">{{Helper::settings('website_name_1')}}</span>
                            <span class="font-w400 text-uppercase">{{Helper::settings('website_name_2')}}</span>
                        </a>
                        <!-- END Logo -->
        
                        <!-- Options -->
                        <div class="d-lg-none">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                                <i class="fa fa-times-circle"></i>
                            </a>
                            <!-- END Close Sidebar -->
                        </div>
                        <!-- END Options -->
                    </div>
                </div>
                <!-- END Side Header (normal Sidebar mode) -->
        
                <!-- Sidebar Scrolling -->
                @if(Auth::guard('admin')->check())
                @include('admin.partials.admin-sidebar')
                @else
                @include('admin.partials.user-sidebar')
                @endif
                
                <!-- END Sidebar Scrolling -->
            </nav>
            <!-- END Sidebar -->
            @include('admin.partials.header')
            <!-- Header -->
            
            <!-- END Header -->
        
            <!-- Main Container -->
                <div id="app">
                    @yield('content')
                </div>
            <!-- سهيثEND Main Container -->
        
            @include('admin.partials.footer')
        </div>
        <script src="{{asset('admin/js/core/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/core/bootstrap.bundle.min.js')}}"></script>        
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('admin/js/core.js')}}"></script>
        <script src="{{asset('admin/js/app.js')}}"></script>
        <script src="{{asset('admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
        {{-- <script src="{{asset('admin/js/plugins/select2/js/select2.min.js')}}"></script> --}}
        <script>jQuery(function(){Dashmix.helpers('notify');
              $("body").tooltip({ selector: '[data-toggle=tooltip]' });});
            
        </script>
       @if(session()->has('email_error'))
       @php session()->forget('email_error') @endphp
        <script>
         jQuery(function(){
             window.utilities.notify('error','Email can not be sent. please check your configuration');
         })
       </script>
         @endif

       @if(Session::has('checkenv'))
       <script>
           jQuery(function(){
               window.utilities.notify('error',"for security reasons you can't update data in demo version");
            })
            </script>
        @php session()->forget('checkenv') @endphp
         @endif
        @yield('scripts')
    </body>
</html>
