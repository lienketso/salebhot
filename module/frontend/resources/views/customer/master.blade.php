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
    <title>W3Grocery: Pre-Build Mobile App Template ( Bootstrap 5 + PWA )</title>

    <!-- Global CSS -->
    <link href="{{asset('frontend/mobile/assets/vendor/apexcharts/dist/apexcharts.css')}}" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/mobile/assets/css/style.css')}}">

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

    <!-- Header -->
    <header class="header style-6 header-fixed">
        <div class="container p-0">
            <div class="header-content">
                <div class="media-60 me-3 user-image">
                    <img class="rounded-circle" src="assets/images/avatar/2.jpg" alt="user-image">
                </div>
                <div class="flex-1">
                    <h5 class="title-head font-w700 mb-0">
                        <a href="#">{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->name}}</a>
                    </h5>
                    <span>{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->contact_name}}</span>
                </div>
                <a href="javascript:void(0);" class="menu-toggler icon-box">
                    <i class="fa-solid fa-bars text-primary"></i>
                </a>
            </div>
        </div>
    </header>
    <!-- Header -->
    @yield('content')

    <!-- Theme Color Settings End -->
</div>
<!--**********************************
    Scripts
***********************************-->
@include('frontend::customer.footer')
</body>
</html>
