@extends('frontend::master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function() {

            //select city district
            $('#cityID').on('change',function(e){
                e.preventDefault();
                let route = '{{route("frontend::district.get")}}';
                let $this = $(this);
                let matp = $this.val();
                $.ajax({
                    method: 'GET',
                    url: route,
                    data: {matp:matp}
                })
                    .done(function (msg) {
                        let html = '';
                        $.each(msg.data, function (index,value) {
                            html += "<option value='"+value.maqh+"'>"+value.name+"</option>";
                        })
                        $('#districtId').html('').append(html);
                        // if(matp!=='01'){
                        //     $('#phiVanchuyen').text('20.0000 VND');
                        // }else{
                        //     $('#phiVanchuyen').text('Miễn phí');
                        // }

                    })
            });
            //onchange payment


        });
    </script>
@endsection
@section('content')
    <section class="py-3 bg-color-3" data-animated-id="1">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-0">
                    <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{($lang=='vn') ? 'Trang chủ' : 'Home'}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('frontend::cart.index.get')}}"> {{($lang=='vn') ? 'Giỏ hàng' : 'Shoping cart'}} </a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{($lang=='vn') ? 'Đặt hàng' : 'Checkout'}}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pb-11 pb-lg-15 pt-10" data-animated-id="2">
        <div class="container">
            <h2 class="fs-sm-40 mb-9 text-center">{{($lang=='vn') ? 'Đặt hàng' : 'Checkout'}}</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{route('frontend::cart.checkout.post')}}">
                <div class="row">
                    <div class="col-lg-6 mb-9 mb-lg-0">
                        <h3 class="fs-24 mb-7">{{($lang=='vn') ? 'Chi tiết hóa đơn' : 'Billing details'}}</h3>
                        <div class="form-group mb-5">
                            <label for="first-name" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Họ và tên' : 'Full name'}} <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <input type="text" id="first-name" class="form-control" name="customer" required="">
                        </div>
                        <div class="form-group mb-5">
                            <label for="country" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Tỉnh/Thành phố' : 'Country/Region'}} <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <div class="arrows">
                                <select class="form-control" required="" name="city" id="cityID">
                                    <option value="city">{{($lang=='vn') ? 'Chọn tỉnh thành' : 'Select City'}}</option>
                                    @foreach($city as $c)
                                        <option value="{{$c->matp}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="country" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Quận/Huyện' : 'District'}} <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <div class="arrows">
                                <select class="form-control" name="district" id="districtId">
                                    <option value="">{{($lang=='vn') ? 'Quận/Huyện' : 'District'}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="address" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Địa chỉ chi tiết' : 'Address'}} <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <input type="text" id="address" class="form-control mb-5" name="address" required="" placeholder="">
                        </div>

                        <div class="form-group mb-5">
                            <label for="email" class="mb-2 text-primary font-weight-500">Email <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <input type="text" id="email" class="form-control" required="" name="email">
                        </div>
                        <div class="form-group mb-9">
                            <label for="phone" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Số điện thoại' : 'Phone'}} <abbr class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <input type="text" id="phone" class="form-control" name="phone" required="">
                        </div>
                        <h3 class="fs-24 mb-7">{{($lang=='vn') ? 'Thông tin khác' : 'Additional information'}}</h3>
                        <div class="form-group mb-5">
                            <label for="note" class="mb-2 text-primary font-weight-500">{{($lang=='vn') ? 'Yêu cầu khác' : 'Order notes(optional)'}}</label>
                            <textarea id="note" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-lg-13">
                        <h3 class="fs-24 mb-7">{{($lang=='vn') ? 'Đơn hàng của bạn' : 'Your order'}}</h3>
                        <div class="card border-0 rounded-0 bg-color-3">
                            <div class="card-body px-6 py-7">
                                <div class="d-flex pb-3">
                                    <div class="text-primary font-weight-bold">{{($lang=='vn') ? 'Sản phẩm' : 'Product'}}</div>
                                    <div class="text-primary font-weight-bold ml-auto">{{($lang=='vn') ? 'Thành tiền' : 'Total'}}</div>
                                </div>
                                @if($carts && count($carts)>0)
                                    @foreach($carts as $cart)
                                <div class="pb-3 mb-3 border-bottom d-flex">
                                    <div class="text-primary">{{$cart->name}} {{$cart->qty}}x </div>
                                    <div class="text-primary ml-auto"> {{number_format($cart->price)}}</div>
                                </div>
                                    @endforeach
                                @endif

                                <div class="pb-8 mb-3 border-bottom d-flex">
                                    <div class="text-primary">{{($lang=='vn') ? 'Tổng tiền' : 'Total'}}</div>
                                    <div class="text-primary font-weight-bolder ml-auto">{{number_format($amount)}}</div>
                                </div>
                                <div class="form-check pl-0 border-bottom pb-3 mb-3">
                                    <div class="custom-control custom-radio mb-5">
                                        <input class="custom-control-input" type="radio" name="payment_type" value="bank" checked="" id="direct-bank">
                                        <label class="custom-control-label text-primary ml-2" for="direct-bank">
                                            {{($lang=='vn') ? 'Chuyển khoản' : 'Direct Bank Transfer'}}
                                        </label>
                                        <div class="text-gray pl-2 pt-4">{{$setting['fact_number_1_'.$lang]}}
                                        </div>
                                    </div>

                                    <div class="custom-control custom-radio mb-5">
                                        <input class="custom-control-input" type="radio" name="payment_type" value="cod" id="cash">
                                        <label class="custom-control-label text-primary ml-2" for="cash">
                                            {{($lang=='vn') ? 'Thanh toán khi nhận hàng ( COD )' : 'Cash On Delivery'}}
                                        </label>
                                    </div>

                                </div>

                                <button class="btn btn-outline-primary btn-block" type="submit">
                                    {{($lang=='vn') ? 'Xác nhận đặt hàng' : 'Place Oder'}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
