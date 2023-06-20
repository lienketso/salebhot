@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder_v1.js')}}"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script type="text/javascript">
        $("#select6").select2({ tags: true, maximumSelectionLength: 3 });
        $('.js-example-basic-single').select2();
    </script>
    <script type="text/javascript">
        function downloadSVG() {
            const png = document.getElementById('svgID').innerHTML;
            const blob = new Blob([png.toString()]);
            const element = document.createElement("a");
            element.download = "QR-{!! $data->slug !!}.png";
            element.href = window.URL.createObjectURL(blob);
            element.click();
            element.remove();
        }
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::company.index.get')}}">Nhà phân phối</a></li>
        <li class="active">Sửa nhà phân phối</li>
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
                        <h4 class="panel-title">Sửa nhà phân phối</h4>
                        <p><strong>{{$data->name}} | <span style="color: green">{{$data->company_code}}</span></strong> </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên cửa hàng / công ty (*)</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="Tên cửa hàng / công ty ">
                        </div>
                        <div class="form-group">
                            <label>Tên liên hệ (*)</label>
                            <input class="form-control"
                                   name="contact_name"
                                   type="text"
                                   value="{{$data->contact_name}}"
                                   placeholder="VD : Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label>Tỉnh / Thành phố (*)</label>
                            <select id="" class="form-control js-example-basic-single" name="city" style="width: 100%"
                                    data-placeholder="Chọn tỉnh thành" aria-hidden="true">
                                <option value="">Chọn tỉnh / Thành phố</option>
                                @foreach($cities as $c)
                                    <option value="{{$c->matp}}" {{($data->city==$c->matp) ? 'selected' : ''}} >{{$c->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ cửa hàng / công ty (*)</label>
                            <input class="form-control"
                                   name="address"
                                   type="text"
                                   value="{{$data->address}}"
                                   placeholder="Địa chỉ chi tiết">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control"
                                   name="email"
                                   type="text"
                                   value="{{$data->email}}"
                                   placeholder="Địa chỉ email">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control"
                                   name="phone"
                                   type="text"
                                   value="{{$data->phone}}"
                                   placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <label>Số tài khoản ngân hàng</label>
                            <input class="form-control"
                                   name="bank_number"
                                   type="text"
                                   value="{{$data->bank_number}}"
                                   placeholder="Số tài khoản ngân hàng">
                        </div>
                        <div class="form-group">
                            <label>Tên ngân hàng</label>
                            <input class="form-control"
                                   name="bank_name"
                                   type="text"
                                   value="{{$data->bank_name}}"
                                   placeholder="VD : Ngân hàng Agribank">
                        </div>

                        <div class="form-group">
                            <label>Nội dung về công ty</label>
                            <textarea id="editor1" name="content" class="form-control makeMeRichTextarea" rows="3" placeholder="Nội dung bài viết">{{$data->content}}</textarea>
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
                            <label>Chuyên viên chăm sóc</label>
                            <select id="" name="user_id" class="form-control js-example-basic-single" style="width: 100%" >
                                <option value="{{$data->user->id}}">{{$data->user->full_name}} - {{$data->user->phone}}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Ảnh NPP 01</label>
                            <div class="custom-file">
                                <input type="file" name="thumbnail" value="" class="custom-file-input" id="inputGroupFile01" >
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Ảnh NPP 02</label>
                            <div class="custom-file">
                                <input type="file" name="cccd_mt" value="" class="custom-file-input" id="inputGroupFile02" >
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{($data->cccd_mt!='') ? upload_url($data->cccd_mt) : public_url('admin/themes/images/no-image.png')}}" width="100">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Ảnh NPP 03</label>
                            <div class="custom-file">
                                <input type="file" name="cccd_ms" value="" class="custom-file-input" id="inputGroupFile03" >
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{($data->cccd_ms!='') ? upload_url($data->cccd_ms) : public_url('admin/themes/images/no-image.png')}}" width="100">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label style="padding-top: 20px">QR Code NPP</label>
                            <div class="qr-code" id="svgID" style="position: relative">
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(500)->errorCorrection('H')
                        ->generate($settingModel->getSettingMeta('link_qr_code').'?npp='.$data->company_code)) !!} ">
                            </div>
                            <div style="padding-top: 20px">
                                <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(500)->errorCorrection('H')
                        ->generate($settingModel->getSettingMeta('link_qr_code').'?npp='.$data->company_code)) !!}" download="qrcode.png">download QR code</a>
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
