@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder.js')}}"></script>
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

            // $(document).on('keyup', '.select2-search__field', function (e) {
            //     e.preventDefault();
            //     let _this = $(e.currentTarget);
            //     let code = _this.val();
            //     let url = _this.attr('data-url');
            //     if(code.length>0){
            //         $.ajax({
            //             type: "GET",
            //             url: url,
            //             dataType: "json",
            //             data: {code},
            //             success: function (response) {
            //
            //                 var options = '';
            //                 // Iterate through the response data and create option elements
            //                 $.each(response, function(index, result) {
            //                     options += '<option value="' + result.company_code + '">' + result.company_code + '</option>';
            //                 });
            //                 console.log(options);
            //             },
            //             error: function (data, status) {
            //                 console.log(data);
            //             }
            //         });
            //     }else{
            //         return false;
            //     }
            // });

    </script>
    <script type="text/javascript">
        $("#select6").select2({ tags: true, maximumSelectionLength: 3 });
        $('.js-example-basic-single').select2();
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::company.index.get')}}">Quản lý nhà phân phối</a></li>
        <li class="active">Thêm nhà phân phối</li>
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
            <input type="hidden" name="director_id" value="{{($userLog->parents()->exists()) ? $userLog->parents->id : 0}}">
            <input type="hidden" name="sale_admin" value="{{ $userCoNppIt->id}}">
            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Thêm nhà phân phối</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm nhà phân phối mới</p>
                    </div>

                    <div class="panel-body">
                         <div class="form-group">
                            <label>Mã NPP (*)</label>
                            <select id="" class="form-control js-example-basic-single"
                                    name="company_code" style="width: 100%"
                                    data-placeholder="Chọn mã NPP" aria-hidden="true">
                                <option value="">Tìm mã nhà phân phối</option>
                                @foreach($currentCompany as $c)
                                    <option value="{{$c->company_code}}" >{{$c->name}} | {{$c->company_code}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên cửa hàng / công ty (*)</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{old('name')}}"
                                   placeholder="Tên NPP">
                        </div>
                        <div class="form-group">
                            <label>Tên liên hệ (*)</label>
                            <input class="form-control"
                                   name="contact_name"
                                   type="text"
                                   value="{{old('name')}}"
                                   placeholder="VD : Nguyễn Văn A">
                        </div>

                        <div class="form-group">
                            <label>Tỉnh / Thành phố (*)</label>
                            <select id="" class="form-control js-example-basic-single" name="city" style="width: 100%"
                                    data-placeholder="Chọn tỉnh thành" aria-hidden="true">
                                <option value="">Chọn tỉnh / Thành phố</option>
                                @foreach($cities as $c)
                                    <option value="{{$c->matp}}" >{{$c->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ cửa hàng / công ty (*)</label>
                            <input class="form-control"
                                   name="address"
                                   type="text"
                                   value="{{old('address')}}"
                                   placeholder="Địa chỉ chi tiết">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control"
                                   name="email"
                                   type="text"
                                   value="{{old('email')}}"
                                   placeholder="Địa chỉ email ( Nếu có )">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại (*)</label>
                            <input class="form-control"
                                   name="phone"
                                   type="text"
                                   value="{{old('phone')}}"
                                   placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <label>Số tài khoản ngân hàng</label>
                            <input class="form-control"
                                   name="bank_number"
                                   type="text"
                                   value="{{old('bank_number')}}"
                                   placeholder="Số tài khoản ngân hàng">
                        </div>
                        <div class="form-group">
                            <label>Tên ngân hàng</label>
                            <input class="form-control"
                                   name="bank_name"
                                   type="text"
                                   value="{{old('bank_name')}}"
                                   placeholder="VD : Ngân hàng Agribank">
                        </div>


                        <div class="form-group">
                            <label>Chi tiết về nhà phân phối</label>
                            <textarea id="editor1" name="content" class="form-control makeMeRichTextarea" rows="3" placeholder="Nội dung bài viết">{{old('content')}}</textarea>
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
                            <select id="" name="user_id" class="form-control" style="width: 100%" >
                                @if($userLog)
                                <option value="{{$userLog->id}}">{{$userLog->full_name}}</option>
                                @endif
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label>Ảnh NPP 01</label>
                            <div class="custom-file">
                                <input type="file" name="thumbnail" value="{{old('thumbnail')}}" class="custom-file-input" id="inputGroupFile01" >
                                <label class="custom-file-label" for="inputGroupFile01">{{old('thumbnail')}}</label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Ảnh NPP 02</label>
                            <div class="custom-file">
                                <input type="file" name="cccd_mt" value="{{old('cccd_mt')}}" class="custom-file-input" id="inputGroupFile02" >
                                <label class="custom-file-label" for="inputGroupFile01">{{old('cccd_mt')}}</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Ảnh NPP 03</label>
                            <div class="custom-file">
                                <input type="file" name="cccd_ms" value="{{old('cccd_ms')}}" class="custom-file-input" id="inputGroupFile03" >
                                <label class="custom-file-label" for="inputGroupFile01">{{old('cccd_ms')}}</label>
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
