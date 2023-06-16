@extends('frontend::customer.master')
@section('js-init')
    <script type="text/javascript">
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });
        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/customer/order?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#resultAjax").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
@endsection
@section('content')
<header class="header">
    <div class="main-bar">
        <div class="container">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <svg height="512" viewBox="0 0 486.65 486.65" width="512"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z"></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z"></path>
                        </svg>
                    </a>
                    <h5 class="title mb-0 text-nowrap">Đơn hàng</h5>
                </div>
                <div class="mid-content">
                </div>
                <div class="right-content">
                </div>
            </div>
        </div>
    </div>
</header>
<div class="page-content bottom-content">
    <div class="container">
        <div class="dz-tab style-4">
            <div class="tab-slide-effect mx-2">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="tab-active-indicator" ></li>
                    <li class="nav-item active" role="presentation">
                        <button class="nav-link active" id="order-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#order-tab-pane"
                                type="button" role="tab"
                                aria-controls="order-tab-pane" aria-selected="true" tabindex="-1">Đã duyệt</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="order2-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#order2-tab-pane"
                                type="button" role="tab"
                                aria-controls="order2-tab-pane"
                                aria-selected="false" tabindex="-1">Đợi duyệt</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="order3-tab"
                                data-bs-toggle="tab" data-bs-target="#order3-tab-pane"
                                type="button" role="tab" aria-controls="order3-tab-pane"
                                aria-selected="false" tabindex="-1">Đã hủy</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content px-0" id="myTabContent1">
                <div class="tab-pane fade active show" id="order-tab-pane" role="tabpanel" aria-labelledby="order-tab" tabindex="0">
                    <div class="resultAjax" id="resultAjax">

                    </div>
                    <div class="auto-load text-center">
                        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#000"
                                  d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                                  from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="tab-pane fade" id="order2-tab-pane" role="tabpanel" aria-labelledby="order2-tab" tabindex="0">
                    @foreach($orderPending as $d)
                    <div class="card order-box">
                        <div class="card-body">
                            <a href="{{route('frontend::customer.order-single.get',$d->id)}}">
                                <div class="order-content">

                                    <div class="right-content">
                                        <h6 class="order-number">ORDER # {{$d->id}}</h6>
                                        <ul>
                                            @if($d->orderProduct()->exists())
                                                @foreach($d->orderProduct as $p)
                                            <li>
                                                <p class="order-name">{{$p->product->name}}</p>
                                            </li>
                                                @endforeach
                                            @endif
                                            <li>
                                                <h6 class="order-time">Ngày đặt: {{format_date($d->created_at)}}</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="badge badge-md badge-primary float-end rounded-sm">Xem</div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="tab-pane fade" id="order3-tab-pane" role="tabpanel" aria-labelledby="order3-tab" tabindex="0">
                    @foreach($orderCancel as $d)
                    <div class="card order-box">
                        <div class="card-body">
                            <a href="{{route('frontend::customer.order-single.get',$d->id)}}">
                                <div class="order-content">
                                    <div class="right-content">
                                        <h6 class="order-number">ORDER # {{$d->id}}</h6>
                                        <ul>
                                            @if($d->orderProduct()->exists())
                                                @foreach($d->orderProduct as $p)
                                                    <li>
                                                        <p class="order-name">{{$p->product->name}}</p>
                                                    </li>
                                                @endforeach
                                            @endif
                                            <li>
                                                <h6 class="order-time">Ngày đặt: {{format_date($d->created_at)}}</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="badge badge-md badge-primary float-end rounded-sm">Xem</div>
                            </a>
                        </div>
                    </div>
                        @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
