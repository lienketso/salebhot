@extends('wadmin-dashboard::master')
@section('js')
    <script type="text/javascript">
        // auto close
        $('.accept-withdraw').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận yêu cầu rút tiền',
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
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::wallet.withdraw.get')}}" class="btn btn-default">Làm lại</a>
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

                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Nhà phân phối</th>
                        <th>Số dư cuối</th>
                        <th>Số tiền đã rút</th>
                        <th>Ngày yêu cầu</th>
                        <th>Ngày duyệt</th>
                        <th>Người duyệt</th>
                        <th>Refund</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr id="tr_{{$d->id}}">
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
                                @if($d->status=='transferred')
                                    <a href="{{route('wadmin::wallet.refund.get',$d->id)}}"
                                       class="btn btn-danger refund-withdraw tooltips"
                                       data-toggle="tooltip"
                                       data-original-title="Click xác nhận hoàn tiền lại theo giao dịch"
                                    ><i class="fa fa-check-circle"></i> Hoàn lại tiền</a>
                                </td>
                             @endif


                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
