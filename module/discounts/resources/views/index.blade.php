@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách mã chiết khấu</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách mã chiết khấu</h4>
            <p>Danh sách mã chiết khấu dành cho khách hàng</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-5">
                            <input type="text" name="name" placeholder="Nhập tên mã" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::discounts.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-5">
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::discounts.create.get')}}">Thêm mới</a>
                            </div>
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
                        <th>Tiêu đề</th>
                        <th>Mã chiết khấu</th>
                        <th>Tỷ lệ chiết khấu (%)</th>
                        <th>Thứ tự hiển thị</th>
                        <th class="">Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td> <span style="{{($d->parent==0) ? 'font-weight:bold' : ''}}">{{$d->name}}</span></td>
                            <td>{{$d->discount_code}}</td>
                            <td>{{$d->value}}%</td>
                            <td>{{$d->sort_order}}</td>
                            <td class="order-status">
                                @if($d->status=='disable')
                                    <span class="order-new">Đang tạm ẩn</span>
                                @endif
                                    @if($d->status=='active')
                                        <span class="order-success">Đang hiển thị</span>
                                    @endif
                            </td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::discounts.edit.get',$d->id)}}"><i class="fa fa-pencil"></i> Sửa</a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::discounts.remove.get',$d->id)}}"><i class="fa fa-trash"></i> Xóa</a></li>
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
