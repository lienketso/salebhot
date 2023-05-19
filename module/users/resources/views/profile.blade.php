@extends('wadmin-dashboard::master')

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li class="active">Sửa thông tin tài khoản</li>
    </ol>

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Sửa thông tin tài khoản</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa tài khoản </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Email (Có thể sử dụng để đăng nhập)</label>
                            <input class="form-control"
                                   name="email"
                                   type="text"
                                   value="{{$data->email}}"
                                   placeholder="ex : thanhan1507@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input class="form-control"
                                   name="username"
                                   type="text"
                                   value="{{$data->username}}"
                                   placeholder="ex : lienketso">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input class="form-control" name="password" type="password" placeholder="Để đổi mật khẩu vui lòng nhập vào trường này">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input class="form-control" name="re_password" type="password" placeholder="Để đổi mật khẩu vui lòng nhập vào trường này">
                        </div>
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input class="form-control"
                                   name="full_name"
                                   type="text"
                                   value="{{$data->full_name}}"
                                   placeholder="ex : Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control"
                                   name="address"
                                   value="{{$data->address}}"
                                   type="text"
                                   placeholder="ex : Nam An Khánh, Hoài Đức">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control"
                                   name="phone"
                                   value="{{$data->phone}}"
                                   type="text"
                                   placeholder="ex : 0979823452">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>
                    </div>
                </div><!-- panel -->

            </div><!-- col-sm-6 -->

            <!-- ####################################################### -->

            <div class="col-sm-4">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tùy chọn thêm</h4>
                        <p>Thông tin các tùy chọn thêm </p>
                    </div>
                    <div class="panel-body">

                        <div class="form-group mb-3">
                            <label>Ảnh đại diện</label>
                            <div class="custom-file">
                                <input type="file" name="thumbnail" value="" class="custom-file-input" id="inputGroupFile01" >
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
