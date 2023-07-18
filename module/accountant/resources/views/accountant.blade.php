@extends('wadmin-dashboard::master')
@section('js')
    <script type="text/javascript">
        // auto close
        $('.accept-withdraw').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận gửi admin duyệt',
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
                            url: "{{route('wadmin::accountant.request-all.post')}}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {ids,status},
                            success: function(data) {
                                alert('Cập nhật thành công !')
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
        <li><a href="">Gửi yêu cầu admin duyệt chuyển tiền </a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Gửi yêu cầu admin duyệt chuyển tiền </h4>
            <p>Gửi yêu cầu admin duyệt chuyển tiền cho đại lý</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-success" name="export" value="1"><i class="fa fa-file-excel-o"></i> Xuất Excel</button>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::accountant-check.get')}}" class="btn btn-default">Làm lại</a>
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
                            <button type="button" class="btn btn-primary">Gửi xác nhận nhanh</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="accept-action" data-status="sent">Gửi admin xác nhận</a></li>
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
                        <th>Mã </th>
                        <th>Số tài khoản </th>
                        <th>Ngân hàng </th>
                        <th>Số dư ví</th>
                        <th>Gửi admin duyệt</th>
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
                            <td>{{$d->getDistributor->name}} / <strong>{{$d->getDistributor->contact_name}}</strong></td>
                            <td>{{$d->getDistributor->company_code}}</td>
                            <td>{{$d->getDistributor->bank_number}}</td>
                            <td>{{$d->getDistributor->bank_name}}</td>
                            <td> <span class="bag-amount"> {{number_format($d->balance)}} đ</span></td>
                            <td class="order-status">
                                @if($d->send_admin=='unsent')
                                <a href="javascript:void(0);"
                                   class="btn btn-success accept-withdraw tooltips"
                                   data-toggle="tooltip"
                                   data-original-title="Click để gửi admin duyệt yêu cầu chuyển tiền cho đại lý"
                                   data-url="{{route('wadmin::accountant-withdraw.post',$d->id)}}"
                                ><i class="fa fa-paper-plane-o"></i> Gửi admin duyệt</a>
                                @else
                                    <span class="order-new"><i class="fa fa-check-circle-o"></i> Đã gửi admin</span>
                                @endif
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
