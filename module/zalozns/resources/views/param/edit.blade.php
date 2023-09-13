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
        <li><a href="{{route('wadmin::zalozns.param.index',$data->template_id)}}">Zalo template tham số</a></li>
        <li class="active">Sửa Zalo template tham số cho "<span style="color: #F87D33">{{$data->template->name}}</span>"</li>
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
                        <h4 class="panel-title">Sửa Zalo template tham số "<span style="color: #F87D33">{{$data->template->name}}</span>"</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để Sửa Zalo template tham số mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề ( mô tả tham số )</label>
                            <input class="form-control"
                                   name="title"
                                   type="text"
                                   value="{{$data->title}}"
                                   placeholder="tên của tham số (VD : Tên khách hàng)">
                        </div>
                        <div class="form-group">
                            <label>Tên tham số</label>
                            <input class="form-control"
                                   name="param_key"
                                   type="text"
                                   value="{{$data->param_key}}"
                                   placeholder="tên của tham số (VD : customer_name)">
                        </div>
                        <div class="form-group">
                            <label>Giá trị tham số </label>
                            <select name="param_value" class="form-control js-example-basic-single">
                                <option value="">--Chọn giá trị--</option>
                                <option value="company_code" {{($data->param_value=='company_code') ? 'selected' : ''}}>Mã nhà phân phối</option>
                                <option value="name" {{($data->param_value=='name') ? 'selected' : ''}}>Tên khách hàng / Tên nhà phân phối</option>
                                <option value="contact_name" {{($data->param_value=='contact_name') ? 'selected' : ''}}>Tên liên hệ nhà phân phối</option>
                                <option value="phone" {{($data->param_value=='phone') ? 'selected' : ''}}>Số điện thoại</option>
                                <option value="password" {{($data->param_value=='password') ? 'selected' : ''}}>Mật khẩu</option>
                                <option value="license_plate" {{($data->param_value=='license_plate') ? 'selected' : ''}}>Biển số xe</option>
                                <option value="products" {{($data->param_value=='products') ? 'selected' : ''}}>Sản phẩm</option>
                                <option value="id" {{($data->param_value=='id') ? 'selected' : ''}}>Mã đơn hàng</option>
                                <option value="order_status" {{($data->param_value=='order_status') ? 'selected' : ''}}>Trạng thái đơn hàng</option>
                                <option value="sub_total" {{($data->param_value=='sub_total') ? 'selected' : ''}}>Giá đơn hàng</option>
                                <option value="commission" {{($data->param_value=='commission') ? 'selected' : ''}}>Hoa hồng nhà phân phối</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Kiểu dữ liệu </label>
                            <select name="type" class="form-control">
                                <option value="string" {{($data->type=='string') ? 'selected' : ''}}>Kiểu chuỗi ( String )</option>
                                <option value="number" {{($data->type=='number') ? 'selected' : ''}}>Kiểu số (Integer)</option>
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
                            <label>Thứ tự sắp xếp</label>
                            <input class="form-control"
                                   name="sort_order"
                                   type="number"
                                   value="{{$data->sort_order}}"
                                   placeholder="Từ thấp đến cao">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ ($data->status=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
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
