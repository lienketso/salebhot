@extends('frontend::master')
@section('content')
    <section class="py-3 bg-color-3" data-animated-id="1">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$setting['keyword_16_'.$lang]}}</li>
                </ol>
            </nav>
        </div>
    </section>
            <div class="padd-top-30 padd-bot-30 text-center" style="margin: 0 auto; padding: 100px 0">
                <div class="text-center">
                <h1 class="mrg-top-15 mrg-bot-0 cl-danger font-150 font-bold">Thank you</h1>
                <h2 class="mrg-top-10 mrg-bot-5 funky-font font-40">Gửi thông tin thành công !</h2>
                <p>Xin chào <strong>{{$data['name']}}</strong>, Chúng tôi đã nhận được thông tin của bạn.</p>
                <span>Đội ngũ chuyên viên tư vấn của chúng tôi sẽ sớm phản hồi thông tin của bạn, xin chân thành cảm ơn !</span>
                <a href="{{route('frontend::home')}}" class="btn theme-btn-trans mrg-top-20">Quay lại trang chủ</a>
                </div>
            </div>
    @endsection

