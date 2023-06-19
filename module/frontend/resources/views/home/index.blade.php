@extends('frontend::master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="c-order tab-sm-100 col-md-6">

            <!-- side -->
            <div class="left">
                <article class="side-text">
                    <h2>Mua xe như ý, Bảo hiểm hợp lý</h2>
                    <p>Liên hệ ngay <span>info@baohiemoto.vn</span></p>
                </article>
                <div class="left-img">
                    <img src="{{asset('frontend/assets/images/left-bg.gif')}}" alt="BeRifma">
                </div>
                <ul class="links">
                    <li><a href="{{route('frontend::customer.index.get')}}"><i class="fa-solid fa-usd"></i> Doanh thu của bạn</a></li>
                    <li><a href="https://baohiemoto.vn/"><i class="fa-solid fa-users"></i> Trở thành đại lý</a></li>
                    <li><a href="https://baohiemoto.vn/"><i class="fa-solid fa-info-circle"></i> baohiemoto.vn</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-sm-100 offset-md-1 col-md-5">
            <div class="right">

                    <div class="alert alert-warning" id="errorNPP">
                        <strong id="err_npp"></strong>
                    </div>

                <!-- form -->
                <form method="post" action="{{route('frontend::home.booking.post')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="npp" value="{{request()->get('npp')}}">
                    <!-- step 1 -->
                    <div class="form-inner lightSpeedIn">
                        <div class="input-field">
                            <label><i class="fa-regular fa-user"></i>Họ và tên <span>*</span></label>
                            <input required type="text" name="name" id="mail-name" value="{{old('name')}}" placeholder="VD : Nguyễn Văn A">
                            <span id="sp_name"></span>
                        </div>

                        <div class="input-field">
                            <label for="phone"><i class="fa-solid fa-phone"></i>Số điện thoại <span>*</span></label>
                            <input type="text" required name="phone" id="phone" value="{{old('phone')}}" placeholder="VD : 0979xxxxxx">
                            <span id="sp_phone"></span>
                        </div>

                        <div class="input-field">
                            <label for="license_plate"><i class="fa-regular fa-paper-plane"></i>Biển số xe <span>*</span></label>
                            <input required type="text" name="license_plate" id="license_plate" value="{{old('license_plate')}}" placeholder="VD : 30H888.88">
                            <span></span>
                        </div>
                        <div class="input-field">
                            <label for="expiry"><i class="fa-regular fa-calendar"></i>Ngày hết hạn </label>
                            <input type="date" name="expiry" id="expiry" value="{{old('expiry')}}" placeholder="VD : 15/10/2023">
                            <span></span>
                        </div>
                        <div class="input-field">
                            <label for="message"><i class="fa-solid fa-message"></i>Tin nhắn </label>
                            <input type="text" name="message" id="message" value="{{old('message')}}" placeholder="Bạn cần hỗ trợ thêm ?">
                            <span></span>
                        </div>
                        <div class="check-field">
                            <label><i class="fa-regular fa-user"></i>Sản phẩm bảo hiểm <span>*</span></label>
                            <div class="row">
                                <div class="tab-100 col-md-12">
                                    @foreach($listProduct as $k=>$val)
                                    <div class="check-single">
                                        <input type="checkbox" name="products[]" value="{{$val->id}}" {{($k==0) ? 'checked' : ''}}>
                                        <label>{{$val->name}}</label>
                                    </div>
                                    @endforeach


                                </div>

                            </div>
                        </div>
                        <div class="input-field">
                            <label for="message"><i class="fa-solid fa-car"></i>Loại xe </label>
                            <select name="category" class="slc-category">
                            	@foreach($category as $cat)
                            	<option value="{{$cat->id}}">{{$cat->name}}</option>
                            	@endforeach
                            </select>
                            <span></span>
                        </div>
                        <fieldset id="radio-step" class="fields-radio">
                            <h4>Hãng cung cấp</h4>
                            @foreach($listFactory as $d)
                            <label class="factory-radio"> {{$d->name}}
                                <input type="radio" name="factory" value="{{$d->id}}">
                                <span class="checkmark"></span>
                            </label>
                            @endforeach

                        </fieldset>
                    </div>
                    <div class="mess-success">
                        <p id="txt_success"></p>
                    </div>
                    <!-- step Button -->
                    <div class="submit">
                        <button id="btnSubmit" data-url="{{route('ajax.create.booking.get')}}"
                                type="button">Đăng ký tư vấn<span><i class="fa-solid fa-thumbs-up"></i></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
