@extends('wadmin-dashboard::master')

@section('js')

@endsection
@section('js-init')

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::setting.index.get')}}">Cấu hình từ ngữ</a></li>
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
                        <h4 class="panel-title">Thông tin cấu hình từ ngữ trên trang web</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để cấu hình thông tin mong muốn</p>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_1_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_1_'.$language)}}"
                                           placeholder="Nhập từ khóa">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_2_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_2_'.$language)}}"
                                           placeholder="Thông báo">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_3_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_3_'.$language)}}"
                                           placeholder="Tin tức mới nhất">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_4_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_4_'.$language)}}"
                                           placeholder="Video nổi bật">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_5_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_5_'.$language)}}"
                                           placeholder="Liên kết khác">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_6_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_6_'.$language)}}"
                                           placeholder="Viện NC Y Dược Tuệ Tĩnh">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_7_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_7_'.$language)}}"
                                           placeholder="Liên hệ viện nghiên cứu">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_8_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_8_'.$language)}}"
                                           placeholder="Mạng xã hội">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_9_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_9_'.$language)}}"
                                           placeholder="Trang chủ">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_10_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_10_'.$language)}}"
                                           placeholder="Xem thêm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_11_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_11_'.$language)}}"
                                           placeholder="Danh mục">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_12_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_12_'.$language)}}"
                                           placeholder="Tác giả">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_13_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_13_'.$language)}}"
                                           placeholder="Bài viết liên quan">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_14_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_14_'.$language)}}"
                                           placeholder="Bài trước">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_15_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_15_'.$language)}}"
                                           placeholder="Bài tiếp theo">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_16_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_16_'.$language)}}"
                                           placeholder="Liên hệ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_17_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_17_'.$language)}}"
                                           placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_18_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_18_'.$language)}}"
                                           placeholder="Điện thoại">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_19_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_19_'.$language)}}"
                                           placeholder="Gửi tin nhắn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_20_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_20_'.$language)}}"
                                           placeholder="Tiêu đề">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_21_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_21_'.$language)}}"
                                           placeholder="Nội dung">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_22_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_22_'.$language)}}"
                                           placeholder="Họ và tên">
                                </div>
                            </div>
                        </div>

                        <div class="panel-form-khac" style="padding-top: 20px">
                            <h4>Từ khóa các form tìm kiếm</h4>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_1_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_1_'.$language)}}"
                                               placeholder="Tên đề tài">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_2_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_2_'.$language)}}"
                                               placeholder="Tác giả">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_3_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_3_'.$language)}}"
                                               placeholder="Đề tài cấp">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_4_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_4_'.$language)}}"
                                               placeholder="Nhà nước">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_5_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_5_'.$language)}}"
                                               placeholder="Bộ">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_6_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_6_'.$language)}}"
                                               placeholder="Tỉnh / Thành phố">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_7_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_7_'.$language)}}"
                                               placeholder="Cơ sở">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_8_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_8_'.$language)}}"
                                               placeholder="Đơn vị triển khai">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_9_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_9_'.$language)}}"
                                               placeholder="Năm nghiệm thu">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_10_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_10_'.$language)}}"
                                               placeholder="Tên nhiệm vụ">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_11_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_11_'.$language)}}"
                                               placeholder="Nhóm nghiên cứu">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_12_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_12_'.$language)}}"
                                               placeholder="Họ">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_13_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_13_'.$language)}}"
                                               placeholder="Tên khoa học">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_14_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_14_'.$language)}}"
                                               placeholder="Ngành">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_15_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_15_'.$language)}}"
                                               placeholder="Tên cây, con, khoáng vật">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_16_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_16_'.$language)}}"
                                               placeholder="Nhóm chủ trị">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_17_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_17_'.$language)}}"
                                               placeholder="Trị cảm sốt 4 mùa">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_18_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_18_'.$language)}}"
                                               placeholder="Trị cảm mạo phong hàn">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_19_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_19_'.$language)}}"
                                               placeholder="Trị cảm mạo phong nhiệt">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_20_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_20_'.$language)}}"
                                               placeholder="Trị cảm thử">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_21_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_21_'.$language)}}"
                                               placeholder="Trị sốt xuất huyết">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_22_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_22_'.$language)}}"
                                               placeholder="Trị sốt rét">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_23_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_23_'.$language)}}"
                                               placeholder="Trị phong thấp">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_24_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_24_'.$language)}}"
                                               placeholder="Trị đau dạ dày">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_25_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_25_'.$language)}}"
                                               placeholder="Trị bệnh trĩ">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_26_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_26_'.$language)}}"
                                               placeholder="Trị mụn nhọt chốc lở">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_27_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_27_'.$language)}}"
                                               placeholder="Thời gian từ">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_28_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_28_'.$language)}}"
                                               placeholder="Thời gian đến">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label></label>
                                    <div class="form-group">
                                        <input class="form-control"
                                               name="form_key_29_{{$language}}"
                                               type="text"
                                               value="{{$setting->getSettingMeta('form_key_29_'.$language)}}"
                                               placeholder="Nguồn">
                                    </div>
                                </div>


                            </div>
                        </div>



                        <div class="form-group" style="padding-top: 50px">
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
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
