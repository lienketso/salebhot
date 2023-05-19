@extends('wadmin-dashboard::master')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
@endsection
@section('js-init')
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách NPP</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách NPP</h4>
            <p>Danh sách NPP</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <select name="status" class="form-control">
                                <option value="">Trạng thái</option>
                                <option value="disable" {{(request('status')=='disable') ? 'selected' : ''}}>Chưa xác thực</option>
                                <option value="active" {{(request('status')=='active') ? 'selected' : ''}}>Đã xác thực</option>
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="number" min="1" name="count" value="{{old('count',request('count'))}}" placeholder="Số lượng npp cần lấy ra" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a class="export-npp btn btn-danger" href="{{route('wadmin::company.export.get')}}" >Export excel</a>
                            <a href="{{route('wadmin::company.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::company.create.get')}}">Thêm mới</a>
                            </div>
                        </div>
{{--                        <a href="{{route('wadmin::company.export.get')}}">export</a>--}}
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
                        <th>Ảnh NPP</th>
                        <th>Mã NPP</th>
                        <th>Tên NPP</th>
                        <th>CMT/CCCD mặt trước</th>
                        <th>CMT/CCCD mặt sau</th>
                        <th>Chuyên viên cs</th>
                        <th class="">Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <div class="product-img bg-transparent border">
                                    <a href="{{route('wadmin::company.edit.get',$d->id)}}">
                                        <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td><a href="{{route('wadmin::company.edit.get',$d->id)}}">{{$d->company_code}}</a></td>
                            <td class="namego">
                                <h4>{{$d->name}} - {{$d->contact_name}}</h4>
                                <ul>
                                    <li>Địa chỉ : {{$d->city}} - Số điện thoại : {{$d->phone}}</li>
                                    <li>Email : {{$d->email}}</li>
                                </ul>
                            </td>
                            <td>
                                <div class="img-cccd">
                                    <a style="cursor: pointer" data-src="{{ ($d->cccd_mt!='') ? upload_url($d->cccd_mt) : public_url('admin/themes/images/no-image.png')}}"
                                       data-fancybox="gallery"
                                       data-caption="CMT/CCCD Mặt trước">
                                    <img src="{{ ($d->cccd_mt!='') ? upload_url($d->cccd_mt) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="img-cccd">
                                    <a style="cursor: pointer"  data-src="{{ ($d->cccd_ms!='') ? upload_url($d->cccd_ms) : public_url('admin/themes/images/no-image.png')}}"
                                       data-fancybox="gallery"
                                       data-caption="CMT/CCCD Mặt sau">
                                    <img src="{{ ($d->cccd_ms!='') ? upload_url($d->cccd_ms) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="op_sale">
                                    <select name="user_id">
                                        <option value="">--Chọn chuyên viên--</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" {{($user->id==$d->user_id) ? 'selected' : ''}}>{{$user->full_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </td>
                            <td><a href="{{route('wadmin::company.change.get',$d->id)}}"
                                   class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                    {{($d->status=='active') ? 'Đang hiển thị' : 'Tạm ẩn'}}</a></td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::company.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::company.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
