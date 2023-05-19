@extends('frontend::master')
@section('js-init')

    <script type="text/javascript">
        $('.alert-content').hide();
        $('#successID').hide();
        $("#btnContact").on('click',function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let mess = '';
            let name = $('input[name="name"]').val();
            let phone = $('input[name="phone"]').val();
            let title = $('input[name="title"]').val();

            if(name.length<=1){
                mess += 'err';
                $('input[name="name"]').addClass('err_alert');
                $('#sp_name').text('Vui lòng nhập họ tên !');
            }
            if (isNaN(phone) || phone.length<=8) {
                mess += 'err';
                $('input[name="phone"]').addClass('err_alert');
                $('#sp_phone').text('Số điện thoại không đúng định dạng');
            }else{
                $('input[name="phone"]').removeClass('err_alert');
                $('input[name="name"]').removeClass('err_alert');
                $('#sp_phone').text('');
                $('#sp_name').text('');
            }

            if(mess.length <=0 ){
                $('#txt_success').text('Your enquiry has been submitted successfully!');
                $('#successID').show(1000);
                $('.alert-content').hide();
                $('#frmContact').submit();
            }

        })
    </script>
@endsection

@section('content')

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$setting['keyword_16_'.$lang]}}</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->

    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <h3>{{$setting['keyword_16_'.$lang]}}</h3>

                    <div class="content-contact">
                        {!! $setting['site_contact_info_'.$lang] !!}
                    </div>

                    <div class="widget contact-info">

                        <div class="contact-info-box">
                            <div class="contact-info-box-content">
                                <h4>{{$setting['keyword_17_'.$lang]}}</h4>
                                <p>{{$setting['site_address_'.$lang]}}</p>
                            </div>
                        </div>

                        <div class="contact-info-box">
                            <div class="contact-info-box-content">
                                <h4>Email </h4>
                                <p><a href="mailto:{{$setting['site_email_vn']}}" class="__cf_email__" >[{{$setting['site_email_vn']}}]</a></p>
                            </div>
                        </div>

                        <div class="contact-info-box">
                            <div class="contact-info-box-content">
                                <h4>{{$setting['keyword_18_'.$lang]}}</h4>
                                <p>{{$setting['site_hotline_'.$lang]}}</p>
                            </div>
                        </div>

                    </div><!-- Widget end -->

                    <h3>{{$setting['keyword_19_'.$lang]}}</h3>
                    <form id="frmContact" action="" method="post" role="form">
                        <div class="error-container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list_alert">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{$setting['keyword_22_'.$lang]}} *</label>
                                    <input class="form-control form-control-name" name="name" placeholder="" type="text" required>
                                    <span id="sp_name"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{$setting['keyword_18_'.$lang]}} *</label>
                                    <input class="form-control form-control-email" name="phone"
                                           placeholder="" type="text" required>
                                    <span id="sp_phone"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{$setting['keyword_20_'.$lang]}}</label>
                                    <input class="form-control form-control-subject" name="title"
                                           placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{$setting['keyword_21_'.$lang]}}</label>
                            <textarea class="form-control" name="messenger" placeholder="" rows="6" ></textarea>
                        </div>
                        <div class="success-info" id="successID">
                            <p id="txt_success"></p>
                        </div>
                        <div class="text-right"><br>
                            <button class="btn btn-primary solid" id="btnContact" type="button">{{$setting['keyword_19_'.$lang]}}</button>
                        </div>

                    </form>

                    <div class="map-contact">
                        {!! $setting['site_goolge_map'] !!}
                    </div>

                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-12">
                    @include('frontend::blocks.sidebar')
                </div><!-- Sidebar Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->


@endsection
