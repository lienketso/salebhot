@extends('wadmin-dashboard::master')
@section('js')
    <script type="text/javascript">
        // auto close
        $('.accept-withdraw').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận kế toán đã chuyển tuyền thành công',
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
                            url: "{{route('wadmin::admin-completed-all.post')}}",
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
        <li><a href="">Xác nhận chuyển tiền từ kế toán </a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Xác nhận chuyển tiền từ kế toán  </h4>
            <p>Danh sách xác nhận kế toán đã chuyển tiền thành công đến nhà phân phối hay chưa ?</p>
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
                            <a href="{{route('wadmin::admin-confirm-success.get')}}" class="btn btn-default">Làm lại</a>
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
                @php
                    $Login = \Illuminate\Support\Facades\Auth::user();
                    $userroles = $Login->roles->first();
                @endphp
                <div class="action-block">

                    <div class="btn-group mr5">
                        <button type="button" class="btn btn-primary accept-action" data-status="completed">
                            <i class="fa fa-mail-forward"></i> Xác nhận nhanh</button>
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
                        <th>Số tiền chuyển</th>
                        <th>Ngày yêu cầu</th>
                        <th>Người yêu cầu</th>
                        <th>Xác nhận </th>
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
                            <td>{{$d->company->name}} / {{$d->company->phone}}</td>
                            <td> <span class="bag-amount"> {{number_format($d->wallet->balance)}} đ</span></td>
                            <td>
                                <span class="bag-danger"> - {{number_format($d->amount)}} đ</span>
                            </td>
                            <td>{{format_date($d->updated_at)}} lúc {{format_hour($d->updated_at)}}</td>
                            <td>{{$d->users->full_name}} / {{$d->users->phone}}</td>
                            <td>
                                @if($userroles->id==1)
                                    <a href="javascript:void(0);"
                                       class="btn btn-success accept-withdraw tooltips"
                                       data-toggle="tooltip"
                                       data-original-title="Click để xác nhận kế toán đã chuyển tiền thành công, trừ tiền trong ví nhà phân phối"
                                       data-url="{{route('wadmin::admin-confirm-completed.get',$d->id)}}"
                                    ><i class="fa fa-bank"></i> Xác nhận</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
