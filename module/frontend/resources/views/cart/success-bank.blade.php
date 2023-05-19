@extends('frontend::master')
@section('content')
    <section class="succsess-cart" style="background-image: url('{{upload_url($setting['fact_background'])}}')">
        <div class="container">
            <div class="content-booked">
                <h1>Cảm ơn bạn đã đặt sách !</h1>
                {!! $setting['fact_title_2_'.$lang] !!}
                <div class="info-bank-checkout">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="bank-me-info">
                                <p>Chủ tài khoản : <span>Mai Thị Hồng</span></p>
                                <p>Ngân hàng : <span>Tiên Phong (TPbank)</span></p>
                                <p>Số tài khoản : <span>0934 440 664</span></p>
                                <p>Nội dùng : <span>{{$data->phone}}</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bank-info-cart">
                                <p>Tổng tiền : <span>{{number_format($data->amount)}} VND</span></p>
                                <p>Giảm giá chuyển khoản : <span class="mau">{{number_format($data->discount)}} VND</span></p>
                                <p>Vận chuyển : <span class="mau">{{$setting['fact_name_1_vn']}}</span></p>
                                <p style="padding-top: 10px; border-top: 1px solid #E37028">Thanh toán : <span class="">{{number_format($data->amount - $data->discount)}} VND</span></p>
                            </div>
                        </div>
                    </div>
                    <p style="padding-top: 30px">Nếu bạn đã thanh toán, xin bỏ qua thông báo trên nhé. Haduco sẽ kiểm tra thông tin trong 24 giờ làm việc, trước khi Haduco gửi sách, Haduco sẽ liên hệ với bạn!</p>
                </div>
                <div class="back-home">
                    <a href="{{route('frontend::home')}}">Về trang chủ</a>
                </div>
            </div>
        </div>
    </section>
@endsection
