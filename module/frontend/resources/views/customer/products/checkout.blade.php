@extends('frontend::customer.master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function()
        {
            // $('#successID').hide();
            $('#errorNPP').hide();
            $("#btnBooking").on('click' , function(e)
            {
                e.preventDefault();
                let _this = $(e.currentTarget);
                let mess = '';
                let name = $('input[name="name"]').val();
                let phone = $('input[name="phone"]').val();
                let seat = $('#seatID').val();
                if (name.length <= 0) {
                    mess += 'err';
                    $('input[name="name"]').addClass('err_alert');
                    $('#sp_name').text('Vui lòng nhập họ tên !');
                    $('input[name="name"]').focus();
                    $('#txt_success').text('');
                }else{
                    $('input[name="name"]').removeClass('err_alert');
                    $('#sp_name').text('');
                }
                if (isNaN(phone) || phone.length<=5) {
                    mess += 'err';
                    $('input[name="phone"]').addClass('err_alert');
                    $('#sp_phone').text('Số điện thoại không đúng !');
                    $('#txt_success').text('');
                    $('input[name="phone"]').focus();
                }else{
                    $('input[name="phone"]').removeClass('err_alert');
                    $('#sp_phone').text('');
                }
                if(seat.length<=0){
                    mess += 'err';
                    $('#seatID').addClass('err_alert');
                }else{
                    $('#seatID').removeClass('err_alert');
                }

                // if ($('#checker').is(':checked')) {
                //     mess += 'err';
                //     let discount = $('input[name="discount"]:checked').val();
                //
                // }

                if(mess.length <=0 ) {
                   $('#postBooking').submit();
                }
            });

            //áp dụng chiết khấu
            var editChecked = $('#checker').prop('checked');
            if(editChecked===true){
                $('#showDiscount').show();
            }else{
                $('#showDiscount').hide();
            }

            $('#checker').on('click',function(e){
                var isChecked = $('#checker').prop('checked');
                if(isChecked===true){
                    $('#showDiscount').show();
                }else{
                    $('#showDiscount').hide();
                    $('input[name="discount"]').prop('checked',false);
                    $('input[name="discount_amount"]').val(0);
                    $('input[name="discount_id"]').val(0);
                    var reamount = $('input[name="amount"]').val();
                    $('input[name="sub_total"]').val(reamount);
                }
            });
            //số chỗ on change
            $('#seatID').on('change',function (e){
                e.preventDefault();
                let _this = $(e.currentTarget);
                var price = $(this).find('option:selected').data('price');
                var vat = price*0.1;
                $('input[name="amount"]').val(price);
                $('#BHvalue').text(price.toLocaleString());
                $('#BHvat').text(vat.toLocaleString());
                var total = price+vat;
                $('#BHtotal').text(total.toLocaleString());
                $('input[name="amount"]').val(total);
                $('input[name="vat"]').val(vat);
                $('input[name="price"]').val(price);
                $('input[name="sub_total"]').val(total);
                $('#amountCK').text(total.toLocaleString());

            });

            $('input[name="discount"]').on('change',function (e){
                e.preventDefault();
                var vat = $('input[name="vat"]').val();
                var price = $('input[name="price"]').val();

                let _this = $(e.currentTarget);
                let id = _this.attr('data-id');
                var selectedValue = $('input[name="discount"]:checked').val();

                var chietkhau = (100-selectedValue)/100;
                var truthue = price*chietkhau;

                let phaitra = parseInt(vat)+parseInt(truthue);
                let discountAmount = price-(price*chietkhau);

                $('#amountCK').text(phaitra.toLocaleString());
                $('input[name="sub_total"]').val(phaitra);
                $('input[name="discount_amount"]').val(discountAmount);
                $('input[name="discount_id"]').val(id);
            })

        });

    </script>
@endsection
@section('content')
    <header class="header">
        <div class="main-bar sticky-header">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg height="512" viewBox="0 0 486.65 486.65" width="512"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z"></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z"></path>
                            </svg>
                        </a>
                        <h5 class="title mb-0 text-nowrap">Checkout</h5>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">
        <div class="container bottom-content">
            <div class="content clearfix">
                <div class="product-detail">
                    <ul class="list-icons">
                        <li><a href="javascript:void(0)">
                                <span class="align-middle me-2"><i class="fa fa-check text-info"></i></span> {{$data->name}}</a></li>
                    </ul>
                </div>
                <section id="DZWizardSteps-p-0" role="tabpanel" aria-labelledby="DZWizardSteps-h-0" class="body current book-section" aria-hidden="false">
                    @if(session()->has('error'))
                        <div class="alert alert-danger solid alert-square "><strong>Error!</strong> {{session('error')}}</div>
                    @endif
                   <form method="post" action="" id="postBooking">
                       {{csrf_field()}}
                    <input type="hidden" name="products[]" value="{{$data->id}}">

                    <div class="mb-2 input-group input-group-icon">
                        <div class="form-item">
                            <label class="form-label title-head">Tên chủ xe (*)</label>
                            <input type="text" name="name" class="form-control" placeholder="Họ và tên chủ xe">
                            <span id="sp_name"></span>
                        </div>
                    </div>

                    <div class="mb-2 input-group input-group-icon">
                        <div class="form-item">
                            <label class="form-label title-head">Số điện thoại (*)</label>
                            <input type="number" name="phone" class="form-control" placeholder="Số điện thoại chủ xe">
                            <span id="sp_phone"></span>
                        </div>
                    </div>
                    <div class="mb-2 input-group input-group-icon">
                        <div class="form-item">
                            <label class="form-label title-head">Biển số xe</label>
                            <input type="text" name="license_plate" class="form-control" placeholder="VD: 30H74064">
                        </div>
                    </div>
                    <div class="mb-2 input-group input-group-icon">
                        <div class="form-item">
                            <label class="form-label title-head">Ngày hết hạn</label>
                            <input type="date" name="expiry" class="form-control" placeholder="Ngày hết hạn bảo hiểm">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label title-head">Loại xe</label>
                        <select name="category" class="mb-2 dz-form-select form-select" aria-label="Default select example">
                            <option selected="" value="" class="selected">Chọn loại xe</option>
                            @foreach($category as $d)
                            <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label title-head">Hãng bảo hiểm</label>
                        <div class="radio circle-radio">
                            @foreach($listFactory as $key=>$d)
                            <label class="radio-label">{{$d->name}}
                                <input type="radio" {{($key==0) ? 'checked="checked"' : ''}} name="factory" value="{{$d->id}}" >
                                <span class="checkmark"></span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                       <div class="mb-2">
                           <label class="form-label title-head">Số ghế ngồi (*)</label>
                           <select id="seatID" name="seat_id" class="mb-2 dz-form-select form-select" style="width: 100%" >
                               <option value="">Chọn số ghế ngồi</option>
                               @foreach($seats as $c)
                                   <option value="{{$c->id}}"
                                           data-price="{{$c->price}}"
                                       {{($c->id==$data->seat_id) ? 'selected' : ''}}
                                   >{{$c->name}}</option>
                               @endforeach
                           </select>
                       </div>

                       <div class="mb-2">
                           <div class="bao-discount">
                               <label class="label-discount">Áp dụng chiết khấu ?
                                   <input type="checkbox" name="show_discount" value="1" id="checker">
                                   <span class="checkmark"></span>
                               </label>
                           </div>
                       </div>

                       <div class="mb-2">
                           <div class="showDiscount" id="showDiscount">
                               <input type="hidden" name="amount" value="">
                               <input type="hidden" name="discount_amount" value="">
                               <input type="hidden" name="discount_id" value="">
                               <input type="hidden" name="sub_total" value="">
                               <input type="hidden" name="vat" value="">
                               <input type="hidden" name="price" value="">
                                @foreach($discountList as $key=>$d)
                                   <label>
                                   <div class="toast style-1 fade mb-2 show">

                                       <div class="toast-body">
                                           <input type="radio" name="discount"
                                                  value="{{$d->value}}"
                                                  data-id="{{$d->id}}"
                                           >
                                           <div class="toast-content ms-3 me-2">
                                               <strong>{{$d->name}}</strong>
                                           </div>
                                       </div>

                                   </div>
                                   </label>
                               @endforeach

                           </div>
                       </div>

                       <div class="mb-2">
                           <h3 class="priceSale">Giá trị đơn hàng:
                               <span id="amountCK">{{  number_format($data->price) }}</span>
                           </h3>
                       </div>

                    <div class="form-submit-check">
                        <a href="javascript:void(0)" id="btnBooking" class="btn btn-primary text-start w-100">
                            <svg class="cart me-4" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.1776 17.8443C16.6362 17.8428 15.3854 19.0912 15.3839 20.6326C15.3824 22.1739 16.6308 23.4247 18.1722 23.4262C19.7136 23.4277 20.9643 22.1794 20.9658 20.638C20.9658 20.6371 20.9658 20.6362 20.9658 20.6353C20.9644 19.0955 19.7173 17.8473 18.1776 17.8443Z" fill="white"></path>
                                <path d="M23.1278 4.47973C23.061 4.4668 22.9932 4.46023 22.9251 4.46012H5.93181L5.66267 2.65958C5.49499 1.46381 4.47216 0.574129 3.26466 0.573761H1.07655C0.481978 0.573761 0 1.05574 0 1.65031C0 2.24489 0.481978 2.72686 1.07655 2.72686H3.26734C3.40423 2.72586 3.52008 2.82779 3.53648 2.96373L5.19436 14.3267C5.42166 15.7706 6.66363 16.8358 8.12528 16.8405H19.3241C20.7313 16.8423 21.9454 15.8533 22.2281 14.4747L23.9802 5.74121C24.0931 5.15746 23.7115 4.59269 23.1278 4.47973Z" fill="white"></path>
                                <path d="M11.3404 20.5158C11.2749 19.0196 10.0401 17.8418 8.54244 17.847C7.0023 17.9092 5.80422 19.2082 5.86645 20.7484C5.92617 22.2262 7.1283 23.4008 8.60704 23.4262H8.67432C10.2142 23.3587 11.4079 22.0557 11.3404 20.5158Z" fill="white"></path>
                            </svg>
                            XÁC NHẬN MUA HÀNG
                        </a>
                    </div>
                   </form>
                </section>
                <!-- Delivery -->

            </div>

        </div>
    </div>
@endsection
