<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="theme-color" content="#92E136">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="android, ios, mobile, application template, progressive web app, ui kit, multiple color, dark layout">
    <meta name="description" content="W3Grocery - Complete solution of some popular application like - grocery app, shop vendor app, driver app and progressive web app">
    <meta property="og:title" content="W3Grocery: Pre-Build Grocery Mobile App Template ( Bootstrap 5 + PWA )">
    <meta property="og:description" content="W3Grocery - Complete solution of some popular application like - grocery app, shop vendor app, driver app and progressive web app">
    <meta property="og:image" content="https://w3grocery.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/mobile/assets/images/favicon.png')}}">

    <!-- Title -->
    <title>Dành cho khách hàng</title>

    <!-- Global CSS -->
    <link href="{{asset('frontend/mobile/assets/vendor/apexcharts/dist/apexcharts.css')}}" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/mobile/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/mobile/assets/css/custom.css')}}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>
<body data-theme-color="color-orange">
<div class="page-wraper">

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- Preloader end-->


    <!-- Sidebar End -->
    @yield('content')

    <!-- Theme Color Settings End -->
</div>
<!--**********************************
    Scripts
***********************************-->
@include('frontend::customer.footer')

@yield("js")
@yield("js-init")
@stack("js")
@stack("js-init")

@yield("css")
@yield("css-init")
@stack("css")
@stack("css-init")
</body>
</html>
