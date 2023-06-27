@extends('wadmin-dashboard::master')

@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Lịch sử biến động ví </a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Lịch sử biến động ví </h4>
            <p>Lịch sử biến động ví đại lý</p>
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
                            <a href="{{route('wadmin::wallet.history.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th>STT</th>
                        <th>Loại giao dịch</th>
                        <th>Nhà phân phối</th>
                        <th>Đơn hàng</th>
                        <th>Số tiền</th>
                        <th>Ngày giao dịch</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr id="tr_{{$d->id}}">
                            <td>{{$key+1}}</td>
                            <td>
                                @if($d->transaction_type=='plus')
                                <span class="bag-commission">Cộng tiền</span>
                                    @else
                                    <span class="bag-danger">Trừ tiền</span>
                                    @endif
                            </td>
                            <td>{{$d->company->name}}</td>
                            <td>@if($d->transaction_type=='plus') DH{{$d->transaction->id}} @else Yêu cầu rút tiền @endif</td>
                            <td>
                                @if($d->transaction_type=='plus')
                                <span class="bag-amount">+ {{number_format($d->amount)}}</span>
                                    @else
                                    <span class="bag-danger"> - {{number_format($d->amount)}}</span>
                                    @endif
                            </td>
                            <td>{{format_date($d->created_at)}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
