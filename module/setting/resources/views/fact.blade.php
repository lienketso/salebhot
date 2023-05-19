@extends('wadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder_v1.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}',
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'editor2', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}',
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::setting.index.get')}}">Cấu hình thông số</a></li>
        <li class="active">Thông tin cấu hình</li>
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
                        <h4 class="panel-title">Thông tin cấu hình checkout</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để cấu hình thông tin mong muốn</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Phí vận chuyển</label>
                            <input class="form-control"
                                   name="fact_name_1_vn"
                                   type="text"
                                   value="{{$setting->getSettingMeta('fact_name_1_vn')}}"
                                   placeholder="Thông tin phí vận chuyển">
                        </div>
                        <div class="form-group">
                            <label>% Giảm giá khuyến mại qua chuyển khoản</label>
                            <input class="form-control"
                                   name="fact_title_1_{{$language}}"
                                   type="number"
                                   min="0"
                                   max="100"
                                   value="{{$setting->getSettingMeta('fact_title_1_'.$language)}}"
                                   placeholder="% giảm giá">
                        </div>

                        <div class="form-group">
                            <label>Nội dung khuyến mại</label>
                            <textarea id="editor1" name="fact_description_{{$language}}" class="form-control" rows="3"
                                      placeholder="">{{$setting->getSettingMeta('fact_description_'.$language)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Thông tin thanh toán chuyển khoản</label>
                            <textarea id="" name="fact_number_1_{{$language}}" class="form-control" rows="3"
                                      placeholder="">{{$setting->getSettingMeta('fact_number_1_'.$language)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung đặt hàng thành công</label>
                            <textarea id="editor2" name="fact_title_2_{{$language}}" class="form-control" rows="3"
                                      placeholder="">{{$setting->getSettingMeta('fact_title_2_'.$language)}}</textarea>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu lại</button>
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
                            <label>Ảnh background trang thanh toán thành công</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="fact_background" value="{{$setting->getSettingMeta('fact_background')}}"
                                       id="ckfinder-input-2" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-2"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="thumbnail_w" style="padding-top: 10px">
                                <img src="{{ ($setting->getSettingMeta('fact_background')!='null') ? upload_url($setting->getSettingMeta('fact_background')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
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
