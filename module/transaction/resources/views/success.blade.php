@extends('wadmin-dashboard::master')
@section('js-init')
    <script type="text/javascript">
        // auto close
        $('.refund-master').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận hoàn đơn',
                content: 'Bạn có chắc chắn muốn hoàn đơn cho đơn hàng này không ?',
                autoClose: 'cancelAction|10000',
                escapeKey: 'cancelAction',
                buttons: {
                    confirm: {
                        btnClass: 'btn-green',
                        text: 'Hoàn đơn hàng',
                        action: function(){
                            location.href = url;
                        }
                    },
                    cancelAction: {
                        text: 'Hủy',
                        action: function(){
                            $.alert('Đã hủy hoàn đơn hàng !');
                        }
                    }
                }
            });
        });


    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách đơn hàng thành công</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách đơn hàng thành công</h4>
            <p>Danh sách đơn hàng thành công </p>
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
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::transaction.success.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th width="">Nhà PP / CV</th>
                        <th>Nội dung</th>
                        <th>Tiền đơn hàng </th>
                        <th class="">Ngày tạo đơn</th>
                        <th class="" width="">Trạng thái</th>
                        <th width="130"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        @php
                            $vat = $d->amount * 0.1;
                        @endphp
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
                                <p>Ngày hết hạn: <strong>{{format_date($d->expiry)}}</strong></p>

                            </td>
                            <td class="order-status">
                                <a class="btn-hoandon tooltips refund-master"
                                   data-toggle="tooltip"
                                   data-original-title="Hoàn đơn cho khách hàng, trừ -{{number_format($d->commission)}} tiền hoa hồng trong ví đại lý đã cộng trước đó"
                                   data-url="{{route('wadmin::transaction.refund.get',$d->id)}}"
                                   href="javascript:void(0)"><i class="fa fa-history"></i> Hoàn đơn</a>
                            </td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td class="order-status">
                                @if($d->order_status=='active')
                                    <span class="order-success"><i class="fa fa-check-circle-o"></i> Đã hoàn thành</span>
                                    <em>Duyệt ngày: {{format_date($d->updated_at)}}</em>
                                @endif

                            </td>
                            <td>
                                <ul class="table-options">
                                    @if($d->order_status!='active')
                                        <li><a href="{{route('wadmin::transaction.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    @endif
                                    <li><a href="{{route('wadmin::transaction.detail.get',$d->id)}}"><i class="fa fa-eye"></i> Xem đơn</a></li>

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
