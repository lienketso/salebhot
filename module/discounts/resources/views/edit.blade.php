@extends('wadmin-dashboard::master')

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::discounts.index.get')}}">Mã chiết khấu</a></li>
        <li class="active">Sửa mã chiết khấu</li>
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
                        <h4 class="panel-title">Sửa mã chiết khấu</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa mã chiết khấu </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề (*)</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="Tên mã chiết khấu VD : Mã chiết khấu 10%">
                        </div>

                        <div class="form-group">
                            <label>Mã chiết khấu</label>
                            <input class="form-control"
                                   name="discount_code"
                                   type="text"
                                   disabled="disabled"
                                   value="{{$data->discount_code}}"
                                   placeholder="Tự động sinh mã">
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
                            <label>Tỷ lệ chiết khấu (%) (*)</label>
                            <input class="form-control"
                                   name="value"
                                   type="number"
                                   min="0"
                                   max="100"
                                   value="{{$data->value}}"
                                   placeholder="Tỷ lệ % chiết khấu cho đơn hàng">
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
                                <option value="active" {{ ($data->status=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ảnh đại diện ( Nếu có )</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="thumbnail" value="{{$data->thumbnail}}"
                                       id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="col-xs-12">
                                <img src="{{($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}"
                                     id="imgreview" style="width: 100px; padding: 10px 0;">
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
