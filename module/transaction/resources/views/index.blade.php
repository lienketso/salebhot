@extends('wadmin-dashboard::master')

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
                                <option value="disable" {{(request('status')=='active') ? 'selected' : ''}}>Đã tư vấn</option>
                                <option value="active" {{(request('status')=='disable') ? 'selected' : ''}}>Chưa tư vấn</option>
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
{{--                            <a class="export-npp btn btn-danger" href="" >Export excel</a>--}}
                            <a href="{{route('wadmin::transaction.index.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th>Họ tên</th>
                        <th>Thông tin</th>
                        <th>Nhà PP</th>
                        <th>Nội dung</th>
                        <th class="">Ngày gửi</th>
                        <th class="">Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                {{$d->name}}<br/>
                                {{$d->company_info}}
                            </td>
                            <td> Số điện thoại : {{$d->phone}} - Email : {{$d->email}}</td>
                            <td>{{$d->getCompany()}}</td>
                            <td>
                                <p>Sản phẩm : <strong>{{$d->products}}</strong></p>
                                <p>Biến số xe : <strong>{{$d->license_plate}}</strong></p>
                                <p>Ngày hết hạn : <strong>{{format_date($d->expiry)}}</strong></p>
                                <p>Tin nhắn : {{$d->message}}</p>
                            </td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td><a href="{{route('wadmin::transaction.change.get',$d->id)}}"
                                   class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                    {{($d->status=='active') ? 'Đã tư vấn' : 'Chưa tư vấn'}}</a></td>
                            <td>
                                <ul class="table-options">
                                    <li><a class="example-p-6" data-url="{{route('wadmin::transaction.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
