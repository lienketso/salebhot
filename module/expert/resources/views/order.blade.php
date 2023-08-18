@extends('wadmin-dashboard::master')
@section('js-init')

@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách đơn hàng chuyên viên <b>{{\Illuminate\Support\Facades\Auth::user()->full_name}}</b></a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách đơn hàng của chuyên viên</h4>
            <p>Danh sách đơn hàng </p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-lg-12">

                        <div class="hulk-site">
                            <a href="{{route('wadmin::expert.get-order.get')}}" class="btn btn-default btn-quirk ">Tất cả ({{$data->count()}})</a>
                        </div>
                        <div class="hulk-site">
                            <a href="{{route('wadmin::expert.get-order.get',['status'=>'received'])}}" class="btn btn-success btn-quirk">Đã tiếp nhận ({{$countReceived}})</a>
                        </div>
                        <div class="hulk-site">
                            <a href="{{route('wadmin::expert.get-order.get',['status'=>'active'])}}" class="btn btn-primary btn-quirk ">Đã hoàn thành ({{$countActive }})</a>
                        </div>

                        <div class="hulk-site">
                            <a href="{{route('wadmin::expert.get-order.get',['status'=>'pending'])}}" class="btn btn-warning btn-quirk">Đang xử lý ({{$countPending}})</a>
                        </div>

                        <div class="hulk-site">
                            <a href="{{route('wadmin::expert.get-order.get',['status'=>'cancel'])}}" class="btn btn-danger btn-quirk">Đã hủy ({{$countCancel}})</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên KH hoặc số điện thoại" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code"
                                   value="{{old('company_code',request('company_code'))}}"
                                   placeholder="Mã NPP / Tên NPP / SĐT" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <select name="status" class="form-control">
                                <option value="">Trạng thái</option>
                                <option value="new" {{(request('status')=='new') ? 'selected' : ''}}>Chưa tiếp nhận</option>
                                <option value="received" {{(request('status')=='received') ? 'selected' : ''}}>Đang tiếp nhận</option>
                                <option value="pending" {{(request('status')=='pending') ? 'selected' : ''}}>Đang xử lý</option>
                                <option value="cancel" {{(request('status')=='cancel') ? 'selected' : ''}}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::expert.get-order.get')}}" class="btn btn-default">Làm lại</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="panel-body">
            <div class="action-block">


            </div>
            <div class="table-responsive">
                @if (session('edit'))
                    <div class="alert alert-info">{{session('edit')}}</div>
                @endif
                @if (session('create'))
                    <div class="alert alert-success">{{session('create')}}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>
                            <label class="ckbox ckbox-primary">
                                <input class="select-all" type="checkbox" id="checkboxesMain" wfd-id="id0">
                                <span></span>
                            </label>
                        </th>
                        <th>Khách hàng</th>
                        <th width="">Nhà PP</th>
                        <th>Nội dung</th>
                        <th class="">Ngày gửi</th>
                        <th class="" width="">Trạng thái</th>
                        <th width="130"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <label class="ckbox ckbox-primary">
                                    <input type="checkbox" class="checkbox" data-id="{{$d->id}}" wfd-id="{{$d->id}}"><span></span>
                                </label>
                            </td>
                            <td>
                                <p><a href="{{route('wadmin::transaction.edit.get',$d->id)}}">{{$d->name}}</a></p>
                                <p>Số điện thoại : {{$d->phone}} - Email : {{$d->email}}</p>
                            </td>
                            <td>
                                <p>{{($d->company()->exists()) ? $d->company->name.' - ID: '. $d->company->company_code : 'Chưa xác định'}}</p>
                            </td>
                            <td>
                                <div class="product-in">
                                    <h4>Sản phẩm</h4>
                                    <ul>
                                        @foreach($d->orderProduct as $p)
                                            <li>{{$p->product->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <p>Ngày hết hạn: <strong>{{format_date($d->expiry)}}</strong></p>

                            </td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td class="order-status">
                                @if($d->order_status=='active')
                                    <span class="order-success"><i class="fa fa-check-circle-o"></i> Đã hoàn thành</span>
                                @endif
                                @if($d->order_status=='disable' || $d->order_status=='pending')
                                    <span class="order-pending"><i class="fa fa-spinner"></i> Đang xử lý</span>
                                @endif
                                @if($d->order_status=='received')
                                    <span class="order-payment"><i class="fa fa-clock-o"></i> Đã tiếp nhận TT</span>
                                @endif
                                @if($d->order_status=='new')
                                    <span class="order-new"><i class="fa fa-exclamation-triangle"></i> Chưa tiếp nhận</span>
                                @endif
                                @if($d->order_status=='cancel')
                                    <span class="order-cancel"><i class="fa fa-ban"></i> Đã hủy</span>
                                @endif
                            </td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::transaction.detail.get',$d->id)}}"><i class="fa fa-eye"></i> Xem đơn</a> </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
