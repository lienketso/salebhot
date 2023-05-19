@extends('wadmin-dashboard::master')

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::menu.index.get')}}">Menu</a></li>
        <li class="active">Thêm Menu</li>
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
                        <h4 class="panel-title">Thêm Menu</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm Menu mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên Menu</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{old('name')}}"
                                   placeholder="Nhập tên menu">
                        </div>

                        <div class="form-group">
                            <label>Loại menu</label>
                            <select id="" name="type" class="form-control" style="width: 100%" data-placeholder="">
                                <option value="0">--Chọn loại menu--</option>
                                <option value="post">Danh mục bài viết</option>
                                <option value="product">Danh mục sản phẩm</option>
                                <option value="link">Liên kết khác</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Link (Nếu có)</label>
                            <input class="form-control"
                                   name="link"
                                   type="text"
                                   value="{{old('link')}}"
                                   placeholder="Nhập đường dẫn">
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
                            <label>Danh mục cha</label>
                            <select id="" name="parent" class="form-control" style="width: 100%" data-placeholder="">
                                <option value="0">--Là danh mục cha--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thứ tự ưu tiên</label>
                            <input class="form-control"
                                   name="sort_order"
                                   type="number"
                                   min="0"
                                   value="{{0}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ (old('status')=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
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
