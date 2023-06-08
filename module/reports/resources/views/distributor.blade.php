@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách báo cáo nhà phân phối </a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách báo cáo nhà phân phối</h4>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">

                        <div class="col-sm-2 txt-field">
                            <select name="mon" class="form-control">
                                <option value="">Lọc theo tháng</option>
                                @foreach($monthList as $m)
                                    <option value="{{$m['value']}}" {{(request('mon')==$m['value']) ? 'selected' : ''}}>Tháng {{$m['value']}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::reports.distributor.get')}}" class="btn btn-default"><i class="fa fa-refresh"></i> Làm lại</a>
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
                <div class="panel-heading">
                    <ul class="panel-options">
                        <li><a><i class="fa fa-refresh"></i></a></li>
                    </ul>
                    <h4 class="panel-title text-success">Thống kê doanh thu và hoa hồng</h4>
                    <p class="nomargin">Thống kê doanh số và hoa hồng tháng <strong>{{$thang}}</strong> năm <strong>{{date('Y')}}</strong></p>
                </div>
                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>Nhà phân phối</th>
                        <th>Đơn hàng</th>
                        <th>Doanh số</th>
                        <th>Hoa hồng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <p>{{$d->name}} - {{$d->phone}}</p>
                                <p>Địa chỉ: {{$d->address}}</p>
                                <p>ID: <strong>{{$d->company_code}}</strong></p>
                            </td>
                            <td><span class="bag-count">{{$d->totalOrder}}</span></td>
                            <td><span class="bag-amount">{{number_format($d->total_amount)}}</span></td>
                            <td><span class="bag-commission">{{number_format($d->total_amount*$commissionRate)}}</span> </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
