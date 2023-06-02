<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}">
    <meta name="twitter:description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}">
    <meta name="twitter:image" content="{{(isset($meta_thumbnail)) ? $meta_thumbnail : $setting['site_logo']}}">

    <meta name="description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}" />
    <link rel="canonical" href="{{domain_url()}}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}" />
    <meta property="og:description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}" />
    <meta property="og:url" content="{{(isset($meta_url)) ? $meta_url : domain_url()}}" />
    <meta property="og:image" content="{{(isset($meta_thumbnail)) ? $meta_thumbnail : $setting['site_logo']}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <title>{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}</title>

    <!-- color sceme -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/colorvariants/default.css')}}" id="defaultscheme">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Bootstrap-5 -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

    <!-- custom-styles -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animation.css')}}">

    <!-- color switcher -->
    <link rel="stylesheet" href="{{asset('frontend/colorswitcher/assets/css/colorswitcher.css')}}">
</head>
<body>
<main>
    <div class="logo">
        <div class="logo-icon">
            <img src="{{ ($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/images/logo.png')}}" alt="Baohiemoto">
        </div>
        <div class="logo-text">
            
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="left-shape">
        <img src="{{asset('frontend/assets/images/top-left.png')}}" alt="">
    </div>
    <div class="right-shape">
        <img src="{{asset('frontend/assets/images/top-right.png')}}" alt="">
    </div>

</main>


<div id="error">

</div>




<!-- Jquery -->
<script src="{{asset('frontend/assets/js/jquery-3.6.1.min.js')}}"></script>
<!-- Bootstrap-5 -->
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<!-- My js -->
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>

<!-- colorswitcher -->

</body>
</html>
