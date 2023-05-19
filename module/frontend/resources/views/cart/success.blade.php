@extends('frontend::master')
@section('content')
    <section class="py-3 bg-color-3" data-animated-id="1">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-0">
                    <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{($lang=='vn') ? 'Trang chủ' : 'Home'}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{($lang=='vn') ? 'Đặt hàng thành công' : 'Success'}}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pt-10 pb-10" data-animated-id="2">
        <div class="container">
            <h2 class="fs-sm-40 mb-10 text-center">{{($lang=='vn') ? 'Đặt hàng thành công' : 'Success'}}</h2>
            {!! $setting['fact_title_2_'.$lang] !!}
            <div class="back-home">
                <a href="{{route('frontend::home')}}">{{($lang=='vn') ? 'Về trang chủ' : 'Back to homepage'}}</a>
            </div>
        </div>

    </section>
    @endsection
