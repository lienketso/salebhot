@extends('wadmin-dashboard::master')
@section('js-init')
    <script type="text/javascript">
        $('.CVSelect').hide();
        $('#selectGDV').attr('disabled',true);
        $('#selectSale').attr('disabled',true);
        $('#Telegram').hide();
        var nodeType = $('select[name="role"]');
        if(nodeType.val() === '6'){
            $('.CVSelect').show();
            $('#selectGDV').attr('disabled',false);
            $('#selectSale').attr('disabled',false);
        }
        if(nodeType.val()==='9'){
            $('#Telegram').show();
        }else{
            $('#Telegram').hide();
        }
        $('select[name="role"]').on('change',function (e){
            var _this = $(e.currentTarget);
            var value = _this.val();
            if(value==='6'){
                $('.CVSelect').show();
                $('#selectGDV').attr('disabled',false);
                $('#selectSale').attr('disabled',false);
            }else{
                $('.CVSelect').hide();
                $('#selectGDV').attr('disabled',true);
                $('#selectSale').attr('disabled',true);
            }

            if(nodeType.val()==='9'){
                $('#Telegram').show();
            }else{
                $('#Telegram').hide();
            }


        });
    </script>
@endsection
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::users.index.get')}}">Thành viên</a></li>
        <li class="active">Sửa thành viên</li>
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
                        <h4 class="panel-title">Sửa thông tin thành viên</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa thành viên </p>
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
                            <label>Tên đăng nhập</label>
                            <input class="form-control"
                                   name="username"
                                   type="text"
                                   value="{{$data->username}}"
                                   placeholder="ex : lienketso">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input class="form-control" name="password" type="password" placeholder="******">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input class="form-control" name="re_password" type="password" placeholder="******">
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
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control " style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{($data->status=='active') ? 'selected' : ''}}>Đã kích hoạt</option>
                                <option value="disable" {{($data->status=='disable') ? 'selected' : ''}}>Chưa kích hoạt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phân quyền sử dụng module</label>
                            <select name="role" class="form-control node_type" style="width: 100%" data-placeholder="Trạng thái">
                                @foreach($listRole as $r)
                                <option value="{{$r->id}}" {{ ($data->roles()->first()->id == $r->id) ? 'selected' : '' }} >{{$r->name}} ({{$r->display_name}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="CVSelect">
                            <div class="GDV" style="padding-bottom: 10px">
                                <div class="form-group">
                                    <label>Giám đốc vùng quản lý</label>
                                    <select id="selectGDV" name="parent" class="form-control" style="width: 100%" >
                                        <option value="">---Chọn giám đốc vùng---</option>
                                        @foreach($userGDV as $d)
                                            <option value="{{$d->id}}" {{ ($data->parent == $d->id) ? 'selected' : '' }} >{{$d->full_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="SaleAdmin" style="padding-bottom: 10px">
                                <div class="form-group">
                                    <label>Sale chốt đơn</label>
                                    <select id="selectSale" name="sale_admin" class="form-control" style="width: 100%" >
                                        <option value="">Chọn sale chốt đơn</option>
                                        @foreach($saleAdmin as $d)
                                            <option value="{{$d->id}}" {{ ($data->sale_admin == $d->id) ? 'selected' : '' }} >{{$d->full_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="Telegram">
                            <label>Username channel của bạn, bắt đầu bằng @. Ví dụ: @baohiemoto</label>
                            <input class="form-control"
                                   name="telegram"
                                   value="{{$data->telegram}}"
                                   type="text"
                                   placeholder="">
                        </div>

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
