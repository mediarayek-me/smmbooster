
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>{{Helper::settings('website_title')}}</title>

        <meta name="description" content="{{Helper::settings('website_desc')}}">
        <meta name="keywords" content="{{Helper::settings('website_keywords')}}">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="{{Helper::settings('website_title')}}">
        <meta property="og:site_name" content="{{Helper::settings('website_name')}}">
        <meta property="og:description" content="{{Helper::settings('website_desc')}}">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('images/'.Helper::settings(['shortcut_icon']))}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/'.Helper::settings(['website_icon']))}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/'.Helper::settings(['apple_icon']))}}">
         <!-- END Icons -->

        <!-- Stylesheets -->
        <link rel="stylesheet" id="css-main" href="{{asset('admin/css/main.css')}}">
          <!-- RTL style -->
        @if (Helper::getDefaultDirection() == 'rtl')
        <link rel="stylesheet" href="{{asset('css/admin-rtl.css')}}">
        @endif

    </head>
<body>
    <div id="page-container">
        @yield('content')
    </div>
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('admin/js/core.js')}}"></script>
    <script src="{{asset('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script>jQuery(function(){Dashmix.helpers('notify');});</script>
 
    @yield('scripts')
</body>


</html>