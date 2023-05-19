@extends('wadmin-dashboard::master')
@section('css-init')
    <style type="text/css">
        .item-product-order{
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
            display: flex;
        }
        .item-product-order span{
            width: 25%;
            padding: 10px;
            text-align: center;
        }
        .detail-order-p{
            padding-top: 20px;
        }
        .detail-order-p p{
            position: relative;
        }
        .detail-order-p p span{
            position: absolute;
            right: 0;
            font-weight: bold;
        }
    </style>
    @endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách đơn hàng</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách đơn hàng</h4>
            <p>Danh sách đơn hàng trên trang</p>
        </div>


        <div class="panel-body">
            <div class="table-responsive">

                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>Khách hàng</th>
                        <th>Tiền hàng</th>
                        <th>Số lượng</th>
                        <th>Loại thanh toán</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                {{$d->customer}}
                                <ul>
                                    <li>Điện thoại : {{$d->phone}}</li>
                                    <li>Thành phố : {{$d->getCity->name}}</li>
                                    @if(!is_null($d->district) || $d->district!='')
                                        <li>Quận / Huyện : {{$d->getDistrict->name}}</li>
                                    @endif
                                    <li>Địa chỉ : {{$d->address}}</li>
                                </ul>
                            </td>
                            <td>{{number_format($d->amount-$d->discount)}}</td>
                            <td>{{$d->qty}}</td>
                            <td>{{($d->payment_type=='bank') ? 'Chuyển khoản' : 'COD'}}</td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td>
                                @if($d->status=='pending')
                                    <a href="{{route('wadmin::order.update.get',$d->id)}}" class="btn btn-warning">Chưa xử lý</a>
                                    @else
                                    <a href="{{route('wadmin::order.update.get',$d->id)}}" class="btn btn-success">Hoàn thành</a>
                                @endif
                            </td>
                            <td>
                                <ul class="table-options">
                                    <li><a data-toggle="modal" data-target="#modelId{{$d->id}}"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modelId{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId{{$d->id}}"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chi tiết đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                            @foreach($d->orderProduct as $p)
                                                <div class="item-product-order">
                                                    <span><img src="{{upload_url($p->product->thumbnail)}}" width="70"></span>
                                                    <span>{{$p->product->name}}</span>
                                                    <span>{{$p->qty}}</span>
                                                    <span style="text-align: right">{{number_format($p->amount)}}</span>
                                                </div>
                                            @endforeach
                                        <div class="detail-order-p">
                                            <p>Tiền hàng : <span>{{number_format($d->amount)}} VND</span></p>
                                            <p>Giảm giá chuyển khoản ( {{$d->discount_percent}} % ) : <span>{{number_format($d->discount)}} VND</span></p>
                                            <p>Vận chuyển : <span>Miễn phí</span></p>
                                            <p>Thanh toán : <span>{{number_format($d->amount - $d->discount)}} VND</span></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
