@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $('.js-select-single').select2();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var editChecked = $('#checker').prop('checked');
            if(editChecked===true){
                $('#showChietkhau').show();
            }else{
                $('#showChietkhau').hide();
            }

            let defaultAmount = {{$data->amount}};
            $('#checker').on('click',function(e){
                var isChecked = $('#checker').prop('checked');
                if(isChecked===true){
                    $('#showChietkhau').show();
                    $('input[name="amount"]').attr('readonly',true);

                }else{
                    $('#showChietkhau').hide();
                    $('input[name="discount"]').prop('checked',false);
                    $('input[name="amount"]').attr('readonly',false);
                    $('#amountCK').text(defaultAmount.toLocaleString());
                }
            });

            $('input[name="discount"]').on('change',function (e){
                e.preventDefault();
                let _this = $(e.currentTarget);
                let id = _this.attr('data-id');
                var selectedValue = $('input[name="discount"]:checked').val();
                var amount = {{$data->amount}};
                var sauVat = {{$sauVat}};
                var tyle = selectedValue/100;
                var chietkhau = sauVat*tyle;
                var totalAmount = amount - chietkhau;
                $('#amountCK').text(totalAmount.toLocaleString());
                $('input[name="sub_total"]').val(totalAmount);
                $('input[name="discount_amount"]').val(chietkhau);
                $('input[name="discount_id"]').val(id);
                // $('input[name="amount"]').val(totalAmount.toLocaleString());
            })

        });
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::transaction.index.get')}}">Đơn hàng</a></li>
        <li class="active">Sửa đơn hàng #{{$data->name}}</li>
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
                        <h4 class="panel-title">Sửa đơn hàng</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa đơn hàng </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên khách hàng (*)</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="VD : Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại (*)</label>
                            <input class="form-control"
                                   name="phone"
                                   type="text"
                                   value="{{$data->phone}}"
                                   placeholder="VD : 0978xxxxxx">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control"
                                   name="email"
                                   type="text"
                                   value="{{$data->email}}"
                                   placeholder="VD : admin@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Biển số xe</label>
                            <input class="form-control"
                                   name="license_plate"
                                   type="text"
                                   value="{{$data->license_plate}}"
                                   placeholder="VD : 30H34536">
                        </div>
                        <div class="form-group">
                            <label>Ngày hết hạn</label>
                            <input class="form-control"
                                   name="expiry"
                                   type="date"
                                   value="{{show_date_input($data->expiry)}}"
                                   placeholder="VD : 16/06/2023">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea id="" name="message" class="form-control" rows="3" placeholder="Mô tả ngắn">{{$data->message}}</textarea>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
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
                            <label>Chọn nhà phân phối</label>
                            <select id="" name="company_id" class="form-control js-select-single" style="width: 100%" >
                                <option value="">Chọn nhà phân phối</option>
                                @foreach($company as $c)
                                    <option value="{{$c->id}}" {{ ($data->company_id==$c->id) ? 'selected' : ''}}>{{$c->company_code}} - {{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Chọn sản phẩm</label>
                            @foreach($products as  $d)
                                <label class="ckbox ckbox-primary">
                                    <input type="checkbox" value="{{$d->id}}" wfd-id="id{{$d->id}}" name="products[]"
                                        {{(in_array($d->id,$currentProduct) ? 'checked' : '')}} ><span> {{$d->name}}</span>
                                </label>
                            @endforeach
                        </div>



                        <div class="form-group">
                            <h4>Hãng</h4>
                            @foreach($hangsx as $h)
                                <label class="rdiobox">
                                    <input type="radio" name="factory" value="{{$h->id}}" {{($data->factory==$h->id) ? 'checked' : ''}}>
                                    <span>{{$h->name}}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>Giá trị đơn hàng</label>
                            <input class="form-control"
                                   onkeyup="this.value=FormatNumber(this.value);"
                                   name="amount"
                                   type="text"
                                   value="{{number_format($data->amount)}}"
                                   placeholder="">
                            <input type="hidden" name="sub_total" value="{{$data->amount}}">
                            <input type="hidden" name="discount_amount" value="">
                            <input type="hidden" name="discount_id" value="">
                        </div>
                        <div class="form-group">
                            <label class="ckbox ckbox-primary">
                                <input type="checkbox" name="discount_show" id="checker" value="1"
                                       {{($data->discount()->exists()) ? 'checked' : ''}}
                                ><span>Lựa chọn chiết khấu</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <div id="showChietkhau">
                                @foreach($discounts as $d)
                                <label class="rdiobox rdiobox-success">
                                    <input type="radio" name="discount"
                                           value="{{$d->value}}"
                                           data-id="{{$d->id}}"
                                           {{($data->discount_id==$d->id) ? 'checked' : ''}}
                                    >
                                    <span>{{$d->name}}</span>
                                </label>
                                @endforeach

                                <h3 class="priceSale">Giá trị đơn hàng:
                                    <span id="amountCK">{{ ($data->discount_amount==0) ? number_format($data->amount) : number_format($data->sub_total)}}</span>
                                </h3>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Cập nhật trạng thái đơn hàng</label>

                            <ul>
                                <li><b class="alert-info">Đã tiếp nhận đơn hàng</b> : Sale admin đã xác nhận đơn hàng </li>
                                <li><b class="alert-warning">Đang xử lý</b> : đang xử lý đơn hàng </li>
                                <li><b class="alert-success">Đơn hàng thành công</b>: Xác nhận đơn hàng hoàn thành cộng doanh thu và hoa hồng cho đại lý, chuyên viên, giám đốc vùng </li>
                                <li><b class="alert-danger">Đơn hàng đã hủy</b> : Đơn hàng đã hủy</li>
                            </ul>

                            <select id="" name="order_status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                    <option value="new" {{ ($data->order_status=='new') ? 'selected' : ''}}>---Chọn trạng thái---</option>
                                    <option value="received" {{ ($data->order_status=='received') ? 'selected' : ''}}>Đã tiếp nhận thông tin</option>
                                    <option value="pending" {{ ($data->order_status=='pending') ? 'selected' : ''}}>Đang xử lý</option>
                                    <option value="active" {{ ($data->order_status=='active') ? 'selected' : ''}}>Đơn hàng thành công</option>
                                    <option value="cancel" {{ ($data->order_status=='cancel') ? 'selected' : ''}}>Đơn hàng đã hủy</option>
                            </select>
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
