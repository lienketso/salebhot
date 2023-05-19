@extends('wadmin-dashboard::master')
@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::permission.index.get')}}">Vai trò</a></li>
        <li class="active">Thêm vai trò mới</li>
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
                        <h4 class="panel-title">Thêm quyền mới</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm quyền mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên quyền</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{old('name')}}"
                                   placeholder="ex : admin">
                        </div>
                        <div class="form-group">
                            <label>Tên hiển thị</label>
                            <input class="form-control"
                                   name="display_name"
                                   type="text"
                                   value="{{old('display_name')}}"
                                   placeholder="ex : Vai trò admin">
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <input class="form-control"
                                   name="description"
                                   value="{{old('description')}}"
                                   type="text"
                                   placeholder="ex : Vai trò quản trị cao nhất">
                        </div>
                        <div class="form-group">
                            <label>Module</label>
                            <input class="form-control"
                                   name="module"
                                   value="{{old('module')}}"
                                   type="text"
                                   placeholder="ex : Users">
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
                            <select id="" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active">Đã kích hoạt</option>
                                <option value="disabled">Chưa kích hoạt</option>
                            </select>
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
