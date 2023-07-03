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
            <li class="active">Thêm thành viên</li>
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
                            <h4 class="panel-title">Thêm thành viên mới</h4>
                            <p>Bạn cần nhập đầy đủ các thông tin để thêm thành viên mới</p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Email (Có thể sử dụng để đăng nhập)</label>
                                <input class="form-control"
                                       name="email"
                                       type="email"
                                       value="{{old('email')}}"
                                       placeholder="ex : thanhan1507@gmail.com">
                            </div>
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input class="form-control"
                                       name="username"
                                       type="text"
                                       value="{{old('username')}}"
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
                                       value="{{old('full_name')}}"
                                       placeholder="ex : Nguyễn Văn A">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control"
                                       name="address"
                                       value="{{old('address')}}"
                                       type="text"
                                       placeholder="ex : Nam An Khánh, Hoài Đức">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control"
                                       name="phone"
                                       value="{{old('phone')}}"
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
                                <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                    <option value="active" {{ (old('status')=='active') ? 'selected' : ''}}>Đã kích hoạt</option>
                                    <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Chưa kích hoạt</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phân quyền sử dụng module</label>
                                <select id="" name="role" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                    @foreach($listRole as $r)
                                        <option value="{{$r->id}}" >{{$r->name}} ({{$r->display_name}})</option>
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
                                                <option value="{{$d->id}}" >{{$d->full_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="SaleAdmin" style="padding-bottom: 10px">
                                    <div class="form-group">
                                        <label>Sale chốt đơn</label>
                                        <select id="selectSale" name="sale_admin" class="form-control" style="width: 100%" >
                                            @foreach($saleAdmin as $d)
                                                <option value="{{$d->id}}" >{{$d->full_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="Telegram">
                                <label>ID nhóm Telegram</label>
                                <input class="form-control"
                                       name="telegram"
                                       value="{{old('telegram')}}"
                                       type="text"
                                       placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label>Ảnh đại diện</label>
                                <div class="custom-file">
                                    <input type="file" name="thumbnail" value="{{old('thumbnail')}}" class="custom-file-input" id="inputGroupFile01" >
                                    <label class="custom-file-label" for="inputGroupFile01">{{old('thumbnail')}}</label>
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
