@extends('frontend::customer.master')
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
                    <h5 class="title mb-0 text-nowrap">Chi tiết đơn hàng</h5>
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
        <h5 class="title border-bottom pb-1 font-w600">Đơn hàng</h5>
        <div class="order-summery">
            <ul class="summery-list mb-4">
               @foreach($data->orderProduct as $p)
                <li>
                    <p class="order-name">{{$p->product->name}}</p>
                </li>
                @endforeach

                <li>
                    <h6 class="mb-0 font-12">Biển số xe</h6>
                    <span class="font-12 font-w600 text-dark">{{$data->license_plate}}</span>
                </li>
                   @if($data->trancategory()->exists())
                <li>
                    <h6 class="mb-0 font-12">Loại xe</h6>
                    <span class="font-12 font-w600 text-dark">{{$data->trancategory->name}}</span>
                </li>
                   @endif
                <li>
                    <h6 class="mb-0 font-12">Ngày hết hạn</h6>
                    <span class="font-12 font-w600 text-dark">{{format_date($data->expiry)}}</span>
                </li>
                   @if($data->hang()->exists())
                <li>
                    <h6 class="mb-0 font-12">Hãng bảo hiểm</h6>
                    <span class="font-12 font-w600 text-dark">{{$data->hang->name}}</span>
                </li>
                   @endif

            </ul>
            <div class="deliver-location mb-4">
                <div class="d-flex align-items-center mb-3">
                    <span class="font-w600 flex-1">Địa chỉ</span>
                </div>
                <h6 class="address font-14">
                    {{$data->address}}
                </h6>
            </div>
            <h5 class="title border-bottom pb-2 mb-2 font-w600">Thông tin khác</h5>
            <div class="view-title mb-4">
                <ul>
                    <li>
                        <span>Mã đơn hàng</span>
                        <span class="text-dark">{{$data->id}}</span>
                    </li>
                    <li>
                        <span>Hình thức thanh toán</span>
                        <span class="text-dark">COD</span>
                    </li>
                    <li>
                        <span>Ngày đặt hàng</span>
                        <span class="text-dark">{{format_date($data->created_at)}}</span>
                    </li>
                </ul>
            </div>
            <h5 class="title border-bottom pb-2 mb-2 font-w600">Trạng thái đơn hàng</h5>
            <ul class="dz-timeline style-2 mb-5">
                <li class="timeline-item active">
                    <h6 class="timeline-tilte">Order Created</h6>
                    <p class="timeline-date">Feb 8,2023-12:20pm</p>
                </li>
                <li class="timeline-item process">
                    <h6 class="timeline-tilte">Order Recived</h6>
                    <p class="timeline-date">Feb 8,2023-12:20pm</p>
                </li>
                <li class="timeline-item">
                    <h6 class="timeline-tilte">Order Confirmed</h6>
                    <p class="timeline-date">Feb 8,2023-12:20pm</p>
                </li>
                <li class="timeline-item">
                    <h6 class="timeline-tilte">Order Processed</h6>
                    <p class="timeline-date">Feb 8,2023-12:20pm</p>
                </li>
                <li class="timeline-item">
                    <h6 class="timeline-tilte">Order Delivered</h6>
                    <p class="timeline-date">Feb 8,2023-12:20pm</p>
                </li>
            </ul>
            <h5 class="title border-bottom pb-2 mb-2 font-w600">Thông tin khách hàng</h5>
            <div class="item-list style-6 m-b30">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <h6 class="item-title mb-1 sub-title"><a href="">{{$data->name}}</a></h6>
                                    <span class="info"><i class="fa-solid me-1 fa-phone"></i>{{$data->phone}}</span>
                                </div>
                            </div>
                            <div class="deliver-icon">
                                <svg height="24" viewBox="0 0 548.244 548.244" width="24" xmlns="http://www.w3.org/2000/svg"><g><g><path clip-rule="evenodd" d="m392.19 156.054-180.922 125.613-189.236-63.087c-13.209-4.412-22.108-16.805-22.032-30.728.077-13.923 9.078-26.24 22.338-30.498l483.812-155.805c11.5-3.697 24.123-.663 32.666 7.88 8.542 8.543 11.577 21.165 7.879 32.666l-155.805 483.811c-4.258 13.26-16.575 22.261-30.498 22.338-13.923.076-26.316-8.823-30.728-22.032l-63.393-190.153z" fill-rule="evenodd"></path></g></g></svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</div>
@endsection
