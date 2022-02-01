<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{Helper::settings('website_title')}}</title>

    <meta name="description" content="{{Helper::settings('website_desc')}}">
    <meta name="keywords" content="{{Helper::settings('website_keywords')}}">
    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" href="{{asset('images/'.Helper::settings(['shortcut_icon']))}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/'.Helper::settings(['website_icon']))}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/'.Helper::settings(['apple_icon']))}}">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{Helper::settings('website_title')}}">
    <meta property="og:site_name" content="{{Helper::settings('website_title')}}">
    <meta property="og:description" content="{{Helper::settings('website_desc')}}">
    
    
    <!-- RTL style -->
    @if (Helper::getDefaultDirection() == 'rtl')
    <link rel="stylesheet" href="{{asset('css/app-rtl.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @endif

    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">

    
    <!-- style params-->
    <style>
        @include('layouts.style-config');
    </style>

    <title>{{Helper::settings('website_title')}}</title>
    <!-- scripts integrations -->
   {!!  Helper::settings('scripts_integrations') !!}

   
</head>
<body>
    @yield('content')
</body>
   @yield('scripts')
</html>