@extends('wadmin-dashboard::master')
@section('js-init')
    <script type="text/javascript">
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
                    alert("Vui lòng chọn ít nhất 1 đơn hàng !");
                } else {
                    if (confirm("Bạn chắc chắn muốn thực hiện hành động này ?")) {
                        var stuId = studentIdArr.join(",");
                        var ids = stuId;
                        $.ajax({
                            url: "{{route('wadmin::transaction.changeall.get')}}",
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
        <li><a href="">Danh sách đơn hàng</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách đơn hàng</h4>
            <p>Danh sách đơn hàng trên trang</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên KH hoặc số điện thoại" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <select name="status" class="form-control">
                                <option value="">Trạng thái</option>
                                <option value="disable" {{(request('status')=='active') ? 'selected' : ''}}>Đã hoàn thành</option>
                                <option value="received" {{(request('status')=='received') ? 'selected' : ''}}>Đang tiếp nhận</option>
                                <option value="active" {{(request('status')=='pending') ? 'selected' : ''}}>Đang xử lý</option>
                                <option value="cancel" {{(request('status')=='cancel') ? 'selected' : ''}}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::transaction.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>

                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="hulk-site">
                            <a href="{{route('wadmin::transaction.index.get')}}" class="btn btn-default btn-quirk ">Tất cả ({{$countAll}})</a>
                        </div>
                        <div class="hulk-site">
                            <a href="{{route('wadmin::transaction.index.get',['status'=>'received'])}}" class="btn btn-success btn-quirk">Đã tiếp nhận ({{$countReceived}})</a>
                        </div>
                        <div class="hulk-site">
                            <a href="{{route('wadmin::transaction.index.get',['status'=>'active'])}}" class="btn btn-primary btn-quirk ">Đã hoàn thành ({{$countActive }})</a>
                        </div>

                        <div class="hulk-site">
                            <a href="{{route('wadmin::transaction.index.get',['status'=>'pending'])}}" class="btn btn-warning btn-quirk">Đang xử lý ({{$countPending}})</a>
                        </div>


                        <div class="hulk-site">
                            <a href="{{route('wadmin::transaction.index.get',['status'=>'cancel'])}}" class="btn btn-danger btn-quirk">Đã hủy ({{$countCancel}})</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel-body">
            <div class="action-block">

                    <div class="btn-group mr5">
                        <button type="button" class="btn btn-primary">Duyệt đơn hàng nhanh</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="accept-action" data-status="received">Đã tiếp nhận đơn hàng</a></li>
                            <li><a class="accept-action" data-status="pending">Đơn hàng đang xử lý</a></li>
                            <li><a class="accept-action" data-status="active">Đơn hàng hoàn thành</a></li>
                            <li class="divider"></li>
                            <li><a class="accept-action" data-status="cancel">Đơn hàng đã hủy</a></li>
                        </ul>
                    </div><!-- btn-group -->

            </div>
            <div class="table-responsive">
                @if (session('edit'))
                    <div class="alert alert-info">{{session('edit')}}</div>
                @endif
                @if (session('create'))
                    <div class="alert alert-success">{{session('create')}}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>
                            <label class="ckbox ckbox-primary">
                                <input class="select-all" type="checkbox" id="checkboxesMain" wfd-id="id0">
                                <span></span>
                            </label>
                        </th>
                        <th>Khách hàng</th>
                        <th width="300">Nhà PP / CV</th>
                        <th>Nội dung</th>
                        <th>Tiền đơn hàng </th>
                        <th class="">Ngày gửi</th>
                        <th class="" width="180">Trạng thái</th>
                        <th width="100"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr id="tr_{{$d->id}}">
                            <td>
                                <label class="ckbox ckbox-primary">
                                    <input type="checkbox" class="checkbox" data-id="{{$d->id}}" wfd-id="{{$d->id}}"><span></span>
                                </label>
                            </td>
                            <td>
                                <p><a href="{{route('wadmin::transaction.edit.get',$d->id)}}">{{$d->name}}</a></p>
                                <p> Số điện thoại : {{$d->phone}}</p>
                            </td>
                            <td>
                                <p>{{($d->company()->exists()) ? $d->company->name.' - ID: '. $d->company->company_code : 'Chưa xác định'}}</p>
                                <p>CV : {{ ($d->userTran()->exists()) ? $d->userTran->full_name : 'Chưa xác định'}}</p>
                            </td>
                            <td>
                                <div class="product-in">
                                    <h4>Sản phẩm</h4>
                                    <ul>
                                        @foreach($d->orderProduct as $p)
                                        <li>{{$p->product->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(!is_null($d->trancategory) || !is_null($d->category))
                                <p>Loại xe: <strong>{{$d->trancategory->name}}</strong></p>
                                @endif

                                <p>Biến số xe: <strong>{{$d->license_plate}}</strong></p>
                                <p>Ngày hết hạn: <strong>{{format_date($d->expiry)}}</strong></p>
                                <p>Tin nhắn: {{$d->message}}</p>
                            </td>
                            <td>
                                <span style="color: #F87D33">{{number_format($d->amount)}}</span>
                                <a href="{{route('wadmin::transaction.price.get',$d->id)}}"><i class="fa fa-pencil"></i> Sửa giá trị</a>
                            </td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td class="order-status">
                                @if($d->order_status=='active')
                                    <span class="order-success"><i class="fa fa-check-circle-o"></i> Đã hoàn thành</span>
                                @endif
                                @if($d->order_status=='disable' || $d->order_status=='pending')
                                    <span class="order-pending"><i class="fa fa-spinner"></i> Đang xử lý</span>
                                @endif
                                    @if($d->order_status=='received')
                                        <span class="order-payment"><i class="fa fa-clock-o"></i> Đã tiếp nhận TT</span>
                                    @endif
                                    @if($d->order_status=='new')
                                        <span class="order-new"><i class="fa fa-exclamation-triangle"></i> Chưa tiếp nhận</span>
                                    @endif
                                    @if($d->order_status=='cancel')
                                        <span class="order-cancel"><i class="fa fa-ban"></i> Đã hủy</span>
                                    @endif
                            </td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::transaction.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a href="{{route('wadmin::transaction.detail.get',$d->id)}}"><i class="fa fa-eye"></i></a></li>

                                </ul>
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
