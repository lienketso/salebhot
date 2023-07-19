@extends('wadmin-dashboard::master')
@section('js')
    <script type="text/javascript">
        // auto close
        $('.accept-withdraw').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận đã chuyển khoản thành công cho đại lý',
                content: 'Bạn có chắc chắn muốn xác nhận yêu cầu',
                autoClose: 'cancelAction|10000',
                escapeKey: 'cancelAction',
                buttons: {
                    confirm: {
                        btnClass: 'btn-green',
                        text: 'Xác nhận ngay',
                        action: function(){
                            location.href = url;
                        }
                    },
                    cancelAction: {
                        text: 'Hủy xác nhận',
                        action: function(){
                            $.alert('Đã hủy xác nhận !');
                        }
                    }
                }
            });
        });

        //check all
        $(document).ready(function() {
            $('#checkboxesMain').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".checkbox").prop('checked', true);
                } else {
                    $(".checkbox").prop('checked', false);
                }
            });
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#checkboxesMain').prop('checked', true);
                } else {
                    $('#checkboxesMain').prop('checked', false);
                }
            });
            $('.accept-action').on('click', function(e) {
                e.preventDefault();
                let status = $(this).attr('data-status');
                var studentIdArr = [];
                $(".checkbox:checked").each(function() {
                    studentIdArr.push($(this).attr('data-id'));
                });

                if (studentIdArr.length <= 0) {
                    alert("Vui lòng chọn ít nhất 1 nhà phân phối !");
                } else {
                    if (confirm("Bạn chắc chắn muốn thực hiện hành động này ?")) {
                        var stuId = studentIdArr.join(",");
                        var ids = stuId;
                        $.ajax({
                            url: "{{route('wadmin::accountant-transferred-all.post')}}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {ids,status},
                            success: function(data) {
                                alert('Xác nhận thành công !')
                                window.location.reload();
                            },
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });


    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Yêu cầu rút tiền </a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Yêu cầu rút tiền đã duyệt </h4>
            <p>Danh sách yêu cầu rút tiền đã duyệt</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}"
                                   placeholder="Mã NPP / Tên / Số điện thoại"
                                   class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="date" name="updated_at" value="{{old('updated_at',request('updated_at'))}}"
                                   placeholder="Ngày duyệt"
                                   class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::accountant-confirm-bank.get')}}" class="btn btn-default">Làm lại</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="panel-body">

            <div class="table-responsive">
                @if (session('edit'))
                    <div class="alert alert-info">{{session('edit')}}</div>
                @endif
                @if (session('create'))
                    <div class="alert alert-success">{{session('create')}}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger">{{session('delete')}}</div>
                @endif

                    <div class="action-block">

                        <div class="btn-group mr5">
                            <button type="button" class="btn btn-primary">Xác nhận nhanh</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="accept-action" data-status="transferred">Xác nhận</a></li>
                            </ul>
                        </div><!-- btn-group -->

                    </div>

                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>
                            <label class="ckbox ckbox-primary">
                                <input class="select-all" type="checkbox" id="checkboxesMain">
                                <span></span>
                            </label>
                        </th>
                        <th>STT</th>
                        <th>Nhà phân phối</th>
                        <th>Số dư cuối</th>
                        <th>Số tiền đã chuyển</th>
                        <th>Ngày yêu cầu</th>
                        <th>Ngày duyệt</th>
                        <th>Người duyệt</th>
                        <th>Xác nhận</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr id="tr_{{$d->id}}">
                            <td>
                                <label class="ckbox ckbox-primary">
                                    <input type="checkbox" class="checkbox" data-id="{{$d->id}}" wfd-id="{{$d->id}}"><span></span>
                                </label>
                            </td>
                            <td>{{$key+1}}</td>
                            <td>{{$d->company->name}}</td>
                            <td> <span class="bag-amount"> {{number_format($d->wallet->balance)}} đ</span></td>
                            <td>
                                <span class="bag-danger"> - {{number_format($d->amount)}} đ</span>
                            </td>
                            <td>{{format_date($d->created_at)}} lúc {{format_hour($d->created_At)}}</td>
                            <td>{{format_date($d->updated_at)}} lúc {{format_hour($d->updated_at)}}</td>
                            <td>{{($d->admins()->exists()) ? $d->admins->full_name : 'Null'}}</td>
                            <td>

                                    <a href="{{route('wadmin::accountant-transferred.get',$d->id)}}"
                                       class="btn btn-info refund-withdraw tooltips"
                                       data-toggle="tooltip"
                                       data-original-title="Click xác nhận đã chuyển tiền cho đại lý"
                                    ><i class="fa fa-check-circle"></i> Xác nhận </a>
                            </td>



                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->withQueryString()->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
