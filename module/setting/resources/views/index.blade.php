@extends('wadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
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

        CKEDITOR.replace( 'editor3', {
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
        <li><a href="{{route('wadmin::setting.index.get')}}">Cấu hình chung</a></li>
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
                        <h4 class="panel-title">Thông tin cấu hình chung</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để cấu hình thông tin mong muốn</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề website</label>
                            <input class="form-control"
                                   name="site_name_{{$language}}"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_name_'.$language)}}"
                                   placeholder="Tên website">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề header</label>
                                    <textarea id="editor1" name="site_top_name_{{$language}}"
                                      class="form-control makeMeRichTextarea" rows="3"
                                      placeholder="">{{$setting->getSettingMeta('site_top_name_'.$language)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Mô tả trang web</label>
                            <textarea id="" name="site_description_{{$language}}" class="form-control" rows="3"
                                      placeholder="Mô tả website">{{$setting->getSettingMeta('site_description_'.$language)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Link landing - website ( QRCode )</label>
                            <input class="form-control"
                                   name="link_qr_code"
                                   disabled
                                   type="text"
                                   value="{{$setting->getSettingMeta('link_qr_code')}}"
                                   placeholder="VD : https://lienketso.vn">
                        </div>

                        <div class="form-group">
                            <label>Số hotline</label>
                            <input class="form-control" name="site_hotline_{{$language}}" value="{{$setting->getSettingMeta('site_hotline_'.$language)}}" type="text" placeholder="Số hotline">
                        </div>
                        <div class="form-group">
                            <label>Số hotline 2</label>
                            <input class="form-control" name="site_hotline_2_{{$language}}" value="{{$setting->getSettingMeta('site_hotline_2_'.$language)}}" type="text" placeholder="Số điện thoại khác">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control"
                                   name="site_address_{{$language}}"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_address_'.$language)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control"
                                   name="site_email_{{$language}}"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_email_'.$language)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Iframe google map</label>
                            <textarea id="" name="site_goolge_map"
                                      class="form-control makeMeRichTextarea" rows="4"
                                      placeholder="">{{$setting->getSettingMeta('site_goolge_map')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Link facebook</label>
                            <input class="form-control"
                                   name="site_facebook"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_facebook')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Link Twitter</label>
                            <input class="form-control"
                                   name="site_twitter"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_twitter')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Link Instagram</label>
                            <input class="form-control"
                                   name="site_instagram"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_instagram')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Link Youtube</label>
                            <input class="form-control"
                                   name="site_youtube"
                                   type="text"
                                   value="{{$setting->getSettingMeta('site_youtube')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 1</label>
                            <textarea id="editor2" name="banner_factory_{{$language}}"
                                      class="form-control makeMeRichTextarea" rows="3"
                                      placeholder="Nội dung mục chân trang 1">{{$setting->getSettingMeta('banner_factory_'.$language)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung chân trang 2</label>
                            <textarea id="editor3" name="site_footer_info_1_{{$language}}"
                                      class="form-control makeMeRichTextarea" rows="3"
                                      placeholder="Nội dung mục chân trang 2">{{$setting->getSettingMeta('site_footer_info_1_'.$language)}}</textarea>
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
                        <div class="form-group mb-3">
                            <label>Ảnh logo</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="site_logo" value="{{$setting->getSettingMeta('site_logo')}}"
                                       id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="thumbnail_w" style="padding-top: 10px">
                                <img src="{{ ($setting->getSettingMeta('site_logo')!='null') ? upload_url($setting->getSettingMeta('site_logo')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Hoa hồng cho nhà phân phối (%)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="number" name="commission_rate" value="{{$setting->getSettingMeta('commission_rate')}}"
                                      class="form-control" placeholder="Tỷ lệ %">

                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label>Zalo App ID</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="zalo_app_id" value="{{$setting->getSettingMeta('zalo_app_id')}}"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Zalo App Secret</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="zalo_app_secret" value="{{$setting->getSettingMeta('zalo_app_secret')}}"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Zalo Access token</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="zalo_access_token" value="{{$setting->getSettingMeta('zalo_access_token')}}"
                                       class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Zalo Refresh token</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="zalo_refresh_token" value="{{$setting->getSettingMeta('zalo_refresh_token')}}"
                                       class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>BOT_API_KEY_Telegram ( token to access the HTTP API)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="bot_api_telegram" value="{{$setting->getSettingMeta('bot_api_telegram')}}"
                                       class="form-control" placeholder="Là key mà khi bạn tạo BOT, BotFather đã đưa cho bạn">
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
