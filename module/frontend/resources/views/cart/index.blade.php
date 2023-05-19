@extends('frontend::master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function() {
            var url = "{{ route('frontend::cart.update.get') }}";

            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                var id = $input.attr('data-id');
                var qty = count;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { id: id, qty: qty },
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                var id = $input.attr('data-id');
                var qty = $input.val();
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { id: id, qty: qty },
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

                return false;
            });


        });
    </script>
@endsection
@section('content')
    <section class="py-3 bg-color-3" data-animated-id="1">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb py-0">
                    <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{($lang=='vn') ? 'Trang chủ' : 'Home'}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{($lang=='vn') ? 'Giỏ hàng' : 'Shopping Cart'}}</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="pb-11 pb-lg-15 pt-10" data-animated-id="2">
        <div class="container">
            <h2 class="fs-sm-40 mb-9 text-center">{{($lang=='vn') ? 'Giỏ hàng của bạn' : 'Shopping Cart'}}</h2>
            <form action="{{route('frontend::cart.checkout.get')}}">
                <div class="row">
                    <div class="col-lg-9 mb-9 mb-lg-0 pr-lg-13">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td colspan="4" class="border-bottom pl-0 pb-3"><p class="fs-15 text-primary mb-0"><span class="d-inline-block mr-2 fs-14"><i class="far fa-check-circle"></i></span>
                                            {{($lang=='vn') ? 'Giỏ hàng của bạn được lưu trữ' : 'Your cart saved'}}  <span class="font-weight-600">4 Day</span></p>
                                    </td>
                                </tr>
                                @if($carts && count($carts)>0)
                                    @foreach($carts as $cart)
                                        @php
                                            $productConCart = getProduct($cart->id);
                                            $rowId = $cart->rowId;
                                            $productid = $cart->id;
                                        @endphp
                                <tr class="c{{$rowId}}">
                                    <td class="pl-0 py-6 align-middle">
                                        <a href="#" onclick="removeCartItem('{{$rowId}}')" class="d-block mr-4"><i class="fal fa-times"></i></a>
                                    </td>
                                    <td class="py-6 pl-0">
                                        <div class="media">
                                            <div class="w-90px mr-4">
                                                <img src="{{ ($productConCart->thumbnail!='') ? upload_url($productConCart->thumbnail) : asset('frontend/assets/images/no-image.png')}}"
                                                     alt="{{$cart->name}}">
                                            </div>
                                            <div class="media-body">
                                                <p class="text-muted fs-12 mb-0 text-uppercase letter-spacing-05 lh-1 mb-1 font-weight-500">
                                                    {{$productConCart->category->name}}</p>
                                                <a href="#" class="font-weight-bold mb-1 d-block">{{$cart->name}}</a>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="pl-0 py-6">
                                        <div class="input-group position-relative w-100px">
                                            <span class="minus position-absolute pos-fixed-left-center pl-2 z-index-2"><i class="far fa-minus"></i></span>
                                            <input name="qty_{{$cart->id}}" data-id="{{$rowId}}" type="number"
                                                   class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px"
                                                   value="{{$cart->qty}}"
                                                   required="">
                                            <span class="plus position-absolute pos-fixed-right-center pr-2 z-index-2"><i class="far fa-plus"></i></span>
                                        </div>
                                    </td>
                                    <td class="pl-0 py-6">
                                        <p class="mb-0 ml-12 text-primary"><span class="soluongcart">{{$cart->qty}}</span> x {{number_format($cart->price)}}</p>
                                    </td>
                                </tr>
                                    @endforeach
                                @endif


                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-header border-0 bg-transparent p-0">
                                <h4 class="card-title fs-24 mb-0">{{($lang=='vn') ? 'Thông tin đơn hàng' : 'Summary'}}</h4>
                            </div>
                            <div class="card-body pt-6 px-0 pb-4">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="text-primary">{{($lang=='vn') ? 'Tiền hàng' : 'Subtotal'}}</span>
                                    <span class="d-block ml-auto text-primary">{{number_format(Cart::subtotal(0, '.', ''))}}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="text-primary">{{($lang=='vn') ? 'Phí vận chuyển' : 'Shipping'}}</span>
                                    <span class="d-block ml-auto text-primary">Free ship</span>
                                </div>
                            </div>
                            <div class="card-footer pt-4 px-0 bg-transparent">
                                <div class="d-flex align-items-center font-weight-bold mb-7">
                                    <span class="text-primary">{{($lang=='vn') ? 'Tổng tiền' : 'Total'}}</span>
                                    <span class="d-block ml-auto text-primary">{{number_format(Cart::subtotal(0, '.', ''))}}</span>
                                </div>
                                <input type="submit" class="btn btn-primary btn-block" value="{{($lang=='vn') ? 'Thanh toán' : 'Check Out'}}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
