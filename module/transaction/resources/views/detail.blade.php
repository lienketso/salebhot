@extends('wadmin-dashboard::master')

@section('css')
@endsection
@section('js')

@endsection
@section('js-init')
@endsection

@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::transaction.index.get')}}">Đơn hàng</a></li>
        <li class="active">chi tiết đơn hàng #{{$data->phone}}</li>
    </ol>
    <div class="row">
        <div class="col-md-8">

            <h4 class="panel-title mb5">Chi tiết đơn hàng #{{$data->phone}}</h4>
            <p class="mb15">Thông tin đơn hàng và trạng thái đơn hàng</p>

            <div class="panel-group" id="accordion">
                <div class="panel">

                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                Thông tin đơn hàng
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" >

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Khách hàng</h4>
                            </div>
                            <!-- panel-heading -->
                            <div class="panel-body">
                                <address>
                                    <strong class="text-primary">{{$data->name}}</strong><br>
                                    <abbr title="Số điện thoại">P:</abbr> {{$data->phone}}
                                </address>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Nhà phân phối</h4>
                            </div>
                            <!-- panel-heading -->
                            <div class="panel-body">
                                <address class="address-npp">
                                    <strong class="text-primary">{{$data->company->name}} - Mã : <span>{{$data->company->company_code}}</span></strong><br>
                                    <p>Địa chỉ : {{$data->company->address}}</p>
                                    <abbr title="Số điện thoại">P:</abbr> {{$data->company->phone}}
                                </address>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">Chuyên viên</h4>
                            </div>
                            @if($data->userTran()->exists())
                                <!-- panel-heading -->
                                <div class="panel-body">
                                    <address class="address-npp">
                                        <strong class="text-primary">{{$data->userTran->full_name}}</strong><br>
                                        <abbr title="Số điện thoại">P:</abbr> {{$data->userTran->phone}}
                                    </address>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-6">
                            <div class="panel-heading">
                                <h4 class="panel-title">Sản phẩm</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="list-product">
                                    @foreach($data->orderProduct as $p)
                                        <li class="text-primary"><strong>{{$p->product->name}}</strong></li>
                                    @endforeach
                                    @if($data->trancategory()->exists())
                                            <li><strong>Loại xe:</strong> {{$data->trancategory->name}}</li>
                                        @endif
                                        @if($data->hang()->exists())
                                            <li><strong>Hãng lựa chọn:</strong> {{$data->hang->name}}</li>
                                        @endif
                                        <li><strong>Biển số xe:</strong> {{$data->license_plate}}</li>
                                        <li><strong>Ngày hết hạn:</strong> {{format_date($data->expiry)}}</li>
                                        <li><strong>Comment:</strong> {{$data->message}}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="panel-heading">
                                <h4 class="panel-title">Giá trị sản phẩm</h4>
                            </div>
                            <div class="panel-body">
                                <p>Tiền đơn hàng : <strong class="price-strong">{{number_format($data->amount)}}</strong></p>
                                <p>Chiết khấu ( -{{($data->discount()->exists()) ? $data->discount->value : 0 }}% ) :
                                    <strong class="price-strong">{{ number_format($data->discount_amount)  }}</strong></p>
                                <p>Tổng tiền phải thu: <strong class="price-strong">{{ number_format($data->sub_total)  }}</strong></p>
                            </div>
                        </div>

                    </div>
                    </div>

                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo" aria-expanded="">
                                Trạng thái đơn hàng
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in" aria-expanded="">
                        <div class="panel-body">
                            <ul class="dz-timeline style-2 mb-5">
                                <li class="timeline-item active">
                                    <h6 class="timeline-tilte">Đơn hàng khởi tạo</h6>
                                    <p class="timeline-date">{{format_date($data->created_at)}} Lúc: {{format_hour($data->created_at)}}</p>
                                </li>
                                @if($data->tranStatus()->exists())
                                    @foreach($data->tranStatus as $d)
                                    <li class="timeline-item {{($d->status==$data->order_status) ? 'process' : ''}}">
                                        <h6 class="timeline-tilte">{{ getTranStatus($d->status) }} <span>cập nhật : {{$d->users->full_name}}</span></h6>
                                        <p class="timeline-date">{{format_date($d->updated_at)}} Lúc: {{format_hour($d->updated_at)}}</p>
                                    </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div><!-- col-md-6 -->

        <div class="col-md-4">



        </div><!-- col-md-6 -->
    </div>
@endsection
