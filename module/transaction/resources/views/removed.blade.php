@extends('wadmin-dashboard::master')
@section('js-init')

@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách đơn hàng đã xóa</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách đơn hàng đã xóa</h4>
            <p>Danh sách đơn hàng </p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên KH hoặc số điện thoại" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <select name="status" class="form-control">
                                <option value="">Trạng thái</option>
                                <option value="disable" {{(request('status')=='active') ? 'selected' : ''}}>Đã hoàn thành</option>
                                <option value="active" {{(request('status')=='pending') ? 'selected' : ''}}>Đang xử lý</option>
                                <option value="payment" {{(request('status')=='payment') ? 'selected' : ''}}>Đã thanh toán</option>
                                <option value="cancel" {{(request('status')=='cancel') ? 'selected' : ''}}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::transaction.removed.get')}}" class="btn btn-default">Làm lại</a>
                        </div>

                    </form>
                </div>


            </div>
        </div>

        <div class="panel-body">

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
                        <th>Tên khách hàng</th>
                        <th>Thông tin</th>
                        <th width="">Nhà PP / CV</th>
                        <th>Nội dung</th>
                        <th>Giá trị </th>
                        <th class="">Ngày gửi</th>
                        <th width="100"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr id="tr_{{$d->id}}">
                            <td>
                                <label class="ckbox ckbox-primary">
                                    <input type="checkbox" class="checkbox" data-id="{{$d->id}}" wfd-id="{{$d->id}}"><span></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{route('wadmin::transaction.edit.get',$d->id)}}">{{$d->name}}</a>
                            </td>
                            <td> Số điện thoại : {{$d->phone}}</td>
                            <td>
                                <p>{{($d->company()->exists()) ? $d->company->name.' - ID: '. $d->company->company_code : 'Chưa xác định'}}</p>
                                <p>CV : {{ ($d->userTran()->exists()) ? $d->userTran->full_name : 'Chưa xác định'}}</p>
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
                            <td>
                                <span style="color: #F87D33">{{number_format($d->amount)}}</span>
                                <a href="{{route('wadmin::transaction.price.get',$d->id)}}"><i class="fa fa-pencil"></i> Sửa giá trị</a>
                            </td>
                            <td>{{format_date($d->created_at)}}</td>

                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::transaction.edit.get',$d->id)}}"><i class="fa fa-pencil"></i> Khôi phục</a></li>
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
