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
    </script>

    <script type="text/javascript">
        var i=0;
        $('#btnAddList').on('click',function(e){
            i++;
            $('#listCheckId').append('<div class="row padb10" id="list'+i+'"><div class="col-lg-1"><div class="count_list"><i class="fa fa-check-circle"></i></div></div><div class="col-lg-8"><div class="form-group"><input class="form-control" name="about_section_list_1_title_{{$language}}[]" type="text" value="" placeholder="Tiêu đề list"></div></div><div class="col-lg-3"><button type="button" class="delete_list" id="'+i+'"><i class="fa fa-trash"></i> Xóa</button></div></div>');
        });
        //remove list
        $(document).on('click', '.delete_list', function(){
            var button_id = $(this).attr("id");
            $('#list'+button_id+'').remove();
        });
        //remove list
        $(document).on('click', '.delete_list_e', function(){
            var button_id = $(this).attr("id");
            $('#ed'+button_id+'').remove();
        });
        //box add
        $('#btnAddBox').on('click',function (e) {
           $('#addBoxId').append('<div class="row padb10" id="box"><div class="col-lg-1"><div class="count_list"><i class="fa fa-lock"></i></div></div><div class="col-lg-4"><div class="form-group"><input class="form-control" name="about_section_box_title_{{$language}}[]" type="text" value="" placeholder="Tiêu đề box"></div></div><div class="col-lg-4"><div class="form-group"><input class="form-control" name="about_section_box_content_{{$language}}[]" type="text" value="" placeholder="Mô trả box"></div></div><div class="col-lg-3"><button type="button" class="delete_box_e" id="b_"><i class="fa fa-trash"></i> Xóa</button></div></div>');
        });
    </script>

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::setting.index.get')}}">Thông tin trang giới thiệu</a></li>
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
                        <h4 class="panel-title">Thông tin trang giới thiệu</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để cấu hình thông tin mong muốn</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control"
                                   name="about_main_title_{{$language}}"
                                   type="text"
                                   value="{{$setting->getSettingMeta('about_main_title_'.$language)}}"
                                   placeholder="Tiêu đề trang giới thiệu">
                        </div>

                        <div class="form-group">
                            <label>Ảnh banner trang</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="about_banner_page" value="{{$setting->getSettingMeta('about_banner_page')}}" id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="thumbnail_w" style="padding-top: 10px">
                                <img src="{{ ($setting->getSettingMeta('about_banner_page')!='null') ? upload_url($setting->getSettingMeta('about_banner_page')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                            </div>
                        </div>
                        <div class="info_ss_list">
                            <h3>Thông tin section 1</h3>
                            <div class="form-group">
                                <label>Tiêu đề section 1</label>
                                <input class="form-control"
                                       name="about_section_1_title_{{$language}}"
                                       type="text"
                                       value="{{$setting->getSettingMeta('about_section_1_title_'.$language)}}"
                                       placeholder="Tiêu đề section 1">
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <div class="input-group col-xs-12" style="display: flex">
                                    <input type="text" name="about_section_1_img" value="{{$setting->getSettingMeta('about_section_1_img')}}"
                                           id="ckfinder-input-2" class="form-control file-upload-info" placeholder="Upload Image">
                                    <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-2"  type="button">Chọn ảnh</button>
							</span>
                                </div>
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{ ($setting->getSettingMeta('about_section_1_img')!='null') ? upload_url($setting->getSettingMeta('about_section_1_img')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="" name="about_section_1_desc_{{$language}}" class="form-control" rows="3"
                                          placeholder="Mô tả website">{{$setting->getSettingMeta('about_section_1_desc_'.$language)}}</textarea>
                            </div>

                            <div class="list_about_section_1">
                                <div class="button_add_list">
                                    <button type="button" id="btnAddList"><i class="fa fa-plus-square"></i> Thêm list</button>
                                </div>

                                <div id="listCheckId">
                                @foreach($checkList as $key=>$c)
                                <div class="row padb10" id="ede_{{$key}}">
                                    <div class="col-lg-1">
                                        <div class="count_list"><i class="fa fa-check-circle"></i></div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_list_1_title_{{$language}}[]"
                                                   type="text"
                                                   value="{{$c}}"
                                                   placeholder="Tiêu đề list">
                                        </div>
                                    </div>
                                    <div class="col-lg-3"><button type="button" class="delete_list_e" id="e_{{$key}}"><i class="fa fa-trash"></i> Xóa</button></div>
                                </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>

                        <div class="info_ss_list">
                            <h3>Thông tin section 2</h3>
                            <div class="form-group">
                                <label>Tiêu đề section 2</label>
                                <input class="form-control"
                                       name="about_section_2_title_{{$language}}"
                                       type="text"
                                       value="{{$setting->getSettingMeta('about_section_2_title_'.$language)}}"
                                       placeholder="Tiêu đề section 2">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <div class="input-group col-xs-12" style="display: flex">
                                    <input type="text" name="about_section_2_img" value="{{$setting->getSettingMeta('about_section_2_img')}}"
                                           id="ckfinder-input-3" class="form-control file-upload-info" placeholder="Upload Image">
                                    <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-3"  type="button">Chọn ảnh</button>
							</span>
                                </div>
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{ ($setting->getSettingMeta('about_section_2_img')!='null') ? upload_url($setting->getSettingMeta('about_section_2_img')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </div>

                        </div>

                        <div class="info_ss_list">
                            <h3>Thông tin section 3</h3>
                            <div class="form-group">
                                <label>Tiêu đề section 3</label>
                                <input class="form-control"
                                       name="about_section_3_title_{{$language}}"
                                       type="text"
                                       value="{{$setting->getSettingMeta('about_section_3_title_'.$language)}}"
                                       placeholder="Tiêu đề section 3">
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <div class="input-group col-xs-12" style="display: flex">
                                    <input type="text" name="about_section_3_img" value="{{$setting->getSettingMeta('about_section_3_img')}}"
                                           id="ckfinder-input-4" class="form-control file-upload-info" placeholder="Upload Image">
                                    <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-4"  type="button">Chọn ảnh</button>
							</span>
                                </div>
                                <div class="thumbnail_w" style="padding-top: 10px">
                                    <img src="{{ ($setting->getSettingMeta('about_section_3_img')!='null') ? upload_url($setting->getSettingMeta('about_section_3_img')) :  public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="" name="about_section_3_desc_{{$language}}" class="form-control" rows="3"
                                          placeholder="Mô tả ngắn">{{$setting->getSettingMeta('about_section_3_desc_'.$language)}}</textarea>
                            </div>


                            <div class="addBox" id="addBoxId">
                                <div class="row padb10" id="box">
                                <div class="col-lg-1">
                                    <div class="count_list"><i class="fa fa-lock"></i></div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="about_section_box_title_1_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('about_section_box_title_1_'.$language)}}"
                                               placeholder="Tiêu đề box 1">
                                    </div>
                                </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_content_1_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_content_1_'.$language)}}"
                                                   placeholder="Mô trả box 1">
                                        </div>
                                    </div>
                            </div>

                                <div class="row padb10" id="box">
                                    <div class="col-lg-1">
                                        <div class="count_list"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_title_2_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_title_2_'.$language)}}"
                                                   placeholder="Tiêu đề box 2">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_content_2_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_content_2_'.$language)}}"
                                                   placeholder="Mô trả box 2">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padb10" id="box">
                                    <div class="col-lg-1">
                                        <div class="count_list"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_title_3_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_title_3_'.$language)}}"
                                                   placeholder="Tiêu đề box 3">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_content_3_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_content_3_'.$language)}}"
                                                   placeholder="Mô trả box 3">
                                        </div>
                                    </div>
                                </div>

                                <div class="row padb10" id="box">
                                    <div class="col-lg-1">
                                        <div class="count_list"><i class="fa fa-lock"></i></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_title_4_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_title_4_'.$language)}}"
                                                   placeholder="Tiêu đề box 4">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control"
                                                   name="about_section_box_content_4_{{$language}}"
                                                   type="text"
                                                   value="{{$setting->getSettingMeta('about_section_box_content_4_'.$language)}}"
                                                   placeholder="Mô trả box 4">
                                        </div>
                                    </div>
                                </div>

                            </div>

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
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
