@extends('wadmin-dashboard::master')

@section('js')
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js-init')
<script type="text/javascript">
    $('.js-example-basic-single').select2();
</script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::zalozns.param.index',$template->id)}}">Zalo template tham số</a></li>
        <li class="active">Thêm Zalo template tham số cho "<span style="color: #F87D33">{{$template->name}}</span>"</li>
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
                        <h4 class="panel-title">Thêm Zalo template tham số "<span style="color: #F87D33">{{$template->name}}</span>"</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm Zalo template tham số mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên tham số</label>
                            <input class="form-control"
                                   name="param_key"
                                   type="text"
                                   value="{{old('param_key')}}"
                                   placeholder="tên của tham số (VD : customer_name)">
                        </div>
                        <div class="form-group">
                            <label>Giá trị tham số </label>
                            <select name="param_value" class="form-control js-example-basic-single">
                                <option value="">--Chọn giá trị--</option>
                                <option value="company_code">Mã nhà phân phối</option>
                                <option value="name">Tên</option>
                                <option value="contact_name">Tên liên hệ</option>
                                <option value="phone">Số điện thoại</option>
                                <option value="password">Mật khẩu</option>
                                <option value="license_plate">Biển số xe</option>
                                <option value="products">Sản phẩm</option>
                            </select>

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
