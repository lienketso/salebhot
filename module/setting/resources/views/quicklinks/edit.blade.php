@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $("#select1").select2({  });
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::link.index.get')}}">Link nhanh</a></li>
        <li class="active">Thêm link nhanh</li>
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
                        <h4 class="panel-title">Thêm link nhanh</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm slink nhanh mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="Tiêu đề link">
                        </div>

                        <div class="form-group">
                            <label>Link đến</label>
                            <input class="form-control"
                                   name="link"
                                   type="text"
                                   value="{{$data->link}}"
                                   placeholder="VD : https://metahaus.vn/gioi-thieu">
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
                            <label>Vị trí hiển thị</label>
                            <select id="" name="display" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="0" {{ ($data->display ==0 ) ? 'selected' : ''}}>Không chọn</option>
                                <option value="1" {{ ($data->display ==1 ) ? 'selected' : ''}}>Top</option>
                                <option value="2" {{ ($data->display ==2 ) ? 'selected' : ''}}>Chân trang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thứ tự ưu tiên</label>
                            <input class="form-control"
                                   name="sort_order"
                                   type="number"
                                   min="0"
                                   value="{{$data->sort_order}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ ($data->status=='active') ? 'selected' : ''}}>Đăng ngay</option>
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Đợi duyệt</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Target</label>
                            <select id="" name="target" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="_self" {{ ($data->target =='_seft' ) ? 'selected' : ''}}>Trên trang</option>
                                <option value="_blank" {{ ($data->target =='_blank' ) ? 'selected' : ''}}>Nhẩy trang mới</option>
                                <option value="_parent" {{ ($data->target =='_parent' ) ? 'selected' : ''}}>Mở trên tab</option>
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
