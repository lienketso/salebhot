@extends('frontend::customer.master')
@section('js')
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
@endsection
@section('js-init')
<script type="text/javascript">
    $(document).ready(function()
    {
    $('#btnRequest').on('click',function (e){
        $('.form-request-money').toggle();
    });
    $('#smRequest').on('click',function (e) {
        e.preventDefault();
        let _this = $(e.currentTarget);
        let url = _this.attr('data-url');
        let company = _this.attr('data-company');
        let balance_ = _this.attr('data-balance');
        let balance = parseInt(balance_);
        let mess = '';
        let price = $('input[name="amount"]').val();
        var amount = parseInt(price.replace(/,/g, ""));

        if (amount > balance) {
            mess += 'Số dư ví không đủ để thực hiện';
            $('.error-request').show();
            $('.err-request').text(mess);
        } else {
            $('.error-request').hide();
        }
        if (amount < 100000) {
            mess += 'Số tiền nhập phải lớn hơn 100.000';
            $('.error-request').show();
            $('.err-request').text(mess);
        }
        if (price.length <= 0) {
            mess += 'Bạn chưa nhập số tiền cần rút';
            $('.error-request').show();
            $('.err-request').text(mess);
        }

        if (mess.length <= 0) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: {company, balance, amount},
                success: function (result) {
                    console.log(result);
                    $('.success-request').show(300);
                    $('input[name="amount"]').val('');
                },
                error: function (data, status) {
                    $("#btnSubmit").html("Đã có lỗi xảy ra");
                    console.log(data);
                }
            });
        }
    });
    });
</script>
@endsection
@section('content')
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg height="512" viewBox="0 0 486.65 486.65" width="512"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z"></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z"></path>
                            </svg>
                        </a>
                        <h5 class="title mb-0 text-nowrap">Ví của tôi</h5>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="page-content bottom-content">
        <div class="container">
            <div class="title-bar mt-0">
                <h6 class="title mb-0 font-18">Quản lý ví</h6>
            </div>



            <div class="card info-card bg-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="top-area">
                            <h3 class="quantity">{{number_format($data->balance)}} VND</h3>
                            <p class="mb-0">Số dư ví</p>
                        </div>
                        <div class="icon-box-2 ms-auto">
                            <i class="fa fa-credit-card-alt"></i>
                        </div>
                    </div>

                </div>
            </div>

            <div class="button-request-money">
                <button type="button" class="btn btn-info w-100" id="btnRequest">Yêu cầu rút tiền</button>
            </div>

            <div class="form-request-money">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="error-request">
                                <div class="alert alert-warning light alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                        <line x1="12" y1="9" x2="12" y2="13"></line>
                                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                    </svg>
                                    <strong>Lỗi!</strong> <span class="err-request">Số tiền không được vượt quá số dư</span>
                                    <button class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="success-request">
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                    <strong>Success!</strong> Gửi yêu cầu thành công
                                    <button class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>

                            <form>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i class="fa fa-credit-card-alt"></i></span>
                                    <input onkeyup="this.value=FormatNumber(this.value);" type="text" name="amount" class="form-control"
                                           placeholder="Số tiền muốn rút" >
                                </div>
                                <a href="javascript:void(0);"
                                   data-url="{{route('ajax.request-money.post')}}"
                                   data-company="{{$mysuser->id}}"
                                   data-balance="{{$data->balance}}"
                                   id="smRequest"
                                   class="btn btn-primary mt-3  btn-block">Gửi yêu cầu</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="title-bar">
                <span class="title mb-0 font-18">Lịch sử giao dịch</span>
            </div>
            <div class="history-request-money">
                @foreach($history as $d)
                    @if($d->transaction_id!='')
                <p class="text-success"><span class="date-span">{{format_date($d->updated_at)}} lúc {{format_hour($d->updated_at)}}</span>
                    Cộng tiền hoa hồng cho giao dịch thành công đơn hàng
                    <a href="{{route('frontend::customer.order-single.get',$d->transaction_id)}}">#DH{{$d->transaction_id}}</a> số tiền
                    <code>+{{number_format($d->amount)}} đ</code></p>
                    @else
                        <p class="text-warning"><span class="date-span">{{format_date($d->updated_at)}} lúc {{format_hour($d->updated_at)}}</span>
                            Trừ tiền theo giao dịch <code>-{{number_format($d->amount)}} đ</code></p>
                        @endif
                @endforeach

            </div>

        </div>
    </div>
@endsection
