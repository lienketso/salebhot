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


    <div class="menubar-area style-10 footer-fixed">
        <div class="toolbar-inner menubar-nav">
            <a href="{{route('frontend::customer.index.get')}}" class="nav-link {{ request()->is('customer') ? 'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M506.555 208.064L263.859 30.367a13.3 13.3 0 0 0-15.716 0L5.445 208.064c-5.928 4.341-7.216 12.665-2.875 18.593a13.31 13.31 0 0 0 18.593 2.875L256 57.588l234.837 171.943c2.368 1.735 5.12 2.57 7.848 2.57 4.096 0 8.138-1.885 10.744-5.445 4.342-5.927 3.054-14.251-2.874-18.592zm-64.309 24.479c-7.346 0-13.303 5.956-13.303 13.303v211.749H322.521V342.009c0-36.68-29.842-66.52-66.52-66.52s-66.52 29.842-66.52 66.52v115.587H83.058V245.847c0-7.347-5.957-13.303-13.303-13.303s-13.303 5.956-13.303 13.303V470.9c0 7.347 5.957 13.303 13.303 13.303h133.029c6.996 0 12.721-5.405 13.251-12.267.032-.311.052-.651.052-1.036V342.01c0-22.009 17.905-39.914 39.914-39.914s39.914 17.906 39.914 39.914V470.9c0 .383.02.717.052 1.024.524 6.867 6.251 12.279 13.251 12.279h133.029c7.347 0 13.303-5.956 13.303-13.303V245.847c-.001-7.348-5.957-13.304-13.304-13.304z"/></svg>
            </a>
            <a href="{{route('frontend::customer.order.get')}}" class="nav-link {{ request()->is('customer/order') ? 'active':'' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M386.689 304.403c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269-14.473 32.269-32.269 32.269zm-220.504-96.807c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269-14.473 32.269-32.269 32.269zM430.15 119.675c-2.743-5.448-8.32-8.885-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"/><path d="M216.202 353.345h122.084v32.269H216.202zm-98.421 0H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134s-7.223-16.134-16.135-16.134zm390.831-98.636l-31.736-40.874c-3.049-3.937-7.755-6.239-12.741-6.239H346.891V94.655c0-8.912-7.223-16.134-16.134-16.134H61.849c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.773V223.73c0 8.912 7.223 16.134 16.134 16.134h125.478l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134V264.605c0-3.582-1.194-7.067-3.388-9.896zm-391.906 16.888H42.487c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.134-16.133-16.134zm37.109-63.463H16.134C7.223 208.134 0 215.357 0 224.269s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135zm26.353-63.462H42.487c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h137.681c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.134-16.134-16.134z"/></svg>
                <span>Order</span>
            </a>
            <a href="{{route('frontend::customer.revenue.get')}}" class="nav-link {{ request()->is('customer/revenue') ? 'active':'' }}">
                <svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Layer_2" data-name="Layer 2"><path d="m1 29h30v2h-30z"/><path d="m4 26a2.99 2.99 0 0 0 2.189-5.037l5.119-8.052a2.837 2.837 0 0 0 1.977-.212l4.015 4.016a2.951 2.951 0 0 0 -.3 1.285 3 3 0 0 0 6 0 2.972 2.972 0 0 0 -.7-1.908l5.2-9.142a3.023 3.023 0 1 0 -1.746-.976l-5.176 9.085a3.015 3.015 0 0 0 -.578-.059 2.951 2.951 0 0 0 -1.285.3l-4.015-4.015a2.951 2.951 0 0 0 .3-1.285 3 3 0 0 0 -6 0 2.968 2.968 0 0 0 .632 1.82l-5.227 8.221a3 3 0 0 0 -.405-.041 3 3 0 0 0 0 6zm16-7a1 1 0 1 1 1-1 1 1 0 0 1 -1 1zm8-16a1 1 0 1 1 -1 1 1 1 0 0 1 1-1zm-16 6a1 1 0 1 1 -1 1 1 1 0 0 1 1-1zm-8 13a1 1 0 1 1 -1 1 1 1 0 0 1 1-1z"/></g></svg>
                <span>Analytics</span>
            </a>
            <a href="#" class="nav-link">
                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g fill="rgb(0,0,0)"><path d="m12 12.75c-3.17 0-5.75-2.58-5.75-5.75s2.58-5.75 5.75-5.75 5.75 2.58 5.75 5.75-2.58 5.75-5.75 5.75zm0-10c-2.34 0-4.25 1.91-4.25 4.25s1.91 4.25 4.25 4.25 4.25-1.91 4.25-4.25-1.91-4.25-4.25-4.25z"/><path d="m20.5901 22.75c-.41 0-.75-.34-.75-.75 0-3.45-3.5199-6.25-7.8399-6.25-4.32005 0-7.84004 2.8-7.84004 6.25 0 .41-.34.75-.75.75s-.75-.34-.75-.75c0-4.27 4.18999-7.75 9.34004-7.75 5.15 0 9.3399 3.48 9.3399 7.75 0 .41-.34.75-.75.75z"/></g></svg>
                <span>Profile</span>
            </a>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom m-3 rounded"  tabindex="-1" id="offcanvasBottom">
        <div class="offcanvas-body small">
            <ul class="theme-color-settings">
                <li>
                    <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary">
                    <label for="primary_color_8"></label>
                    <span>Default</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
                    <label for="primary_color_2"></label>
                    <span>Green</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
                    <label for="primary_color_3"></label>
                    <span>Blue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
                    <label for="primary_color_4"></label>
                    <span>Pink</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
                    <label for="primary_color_5"></label>
                    <span>Yellow</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
                    <label for="primary_color_6"></label>
                    <span>Orange</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
                    <label for="primary_color_7"></label>
                    <span>Purple</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red">
                    <label for="primary_color_1"></label>
                    <span>Red</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
                    <label for="primary_color_9"></label>
                    <span>Lightblue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
                    <label for="primary_color_10"></label>
                    <span>Teal</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
                    <label for="primary_color_11"></label>
                    <span>Lime</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
                    <label for="primary_color_12"></label>
                    <span>Deeporange</span>
                </li>
            </ul>
        </div>
    </div>
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
