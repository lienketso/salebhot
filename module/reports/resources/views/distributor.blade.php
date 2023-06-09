@extends('wadmin-dashboard::master')
@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js')
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $("#select6").select2({ tags: true, maximumSelectionLength: 3 });
        $('.js-example-basic-single').select2();
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách báo cáo nhà phân phối </a></li>
    </ol>
    <div class="panel panel-site-traffic">
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
                                    <option value="{{$m['value']}}" {{(request('mon')==$m['value'] || date('m')==$m['value']) ? 'selected' : ''}}>Tháng {{$m['value']}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-sm-2 txt-field">
                            <select name="user_id" class="form-control js-example-basic-single">
                                <option value="">Lọc theo chuyên viên</option>
                                @foreach($userChuyenvien as $d)
                                    <option value="{{$d->id}}" {{(request('user_id')==$d->id) ? 'selected' : ''}}>{{$d->full_name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> Lọc dữ liệu</button>
                            <a href="{{route('wadmin::reports.distributor.get')}}" class="btn btn-default"><i class="fa fa-refresh"></i> Làm lại</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="panel-body ">
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
                    <h4 class="panel-title text-success">Thống kê doanh thu và hoa hồng đại lý</h4>
                    <p class="nomargin">Thống kê doanh số và hoa của đại lý tháng <strong>{{$thang}}</strong> năm <strong>{{date('Y')}}</strong></p>
                </div>

                        <div class="col-xs-6 col-sm-4">
                            <div class="bg-revenua panel-success-full">
                                <div class="pull-left">
                                    <div class="icon fa fa-shopping-cart"></div>
                                </div>
                                <div class="pull-left">
                                    <h4 class="panel-title">Tổng đơn hàng trong tháng {{$thang}}</h4>
                                    <h3>{{$totalOrderMonth}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="bg-revenua panel-warning-full">
                                <div class="pull-left">
                                    <div class="icon fa fa-usd"></div>
                                </div>
                                <div class="pull-left">
                                    <h4 class="panel-title">Tổng doanh số tháng {{$thang}}</h4>
                                    <h3>{{number_format($totalAmountMonth)}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <div class="bg-revenua panel-info-full">
                                <div class="pull-left">
                                    <div class="icon fa fa-smile-o"></div>
                                </div>
                                <div class="pull-left">
                                    <h4 class="panel-title">Tổng hoa hồng đại lý tháng {{$thang}}</h4>
                                    <h3>{{number_format(($totalCommissionMonth))}}</h3>
                                </div>
                            </div>
                        </div>


                    <div class="mb20"></div>
                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Nhà phân phối</th>
                        <th>CV phụ trách</th>
                        <th>Giám đốc vùng</th>
                        <th>Đơn hàng thành công</th>
                        <th>Doanh số</th>
                        <th>Hoa hồng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        @php
                            $tienVat = $d->total_amount*0.1;
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <p>{{$d->name}} - {{$d->phone}}</p>
                                <p>Địa chỉ: {{$d->address}}</p>
                                <p>ID: <strong>{{$d->company_code}}</strong></p>
                            </td>
                            <td>{{($d->user()->exists()) ? $d->user->full_name : 'Chưa xác định'}}</td>
                            <td>{{ (!is_null($d->user->parents)) ? $d->user->parents->full_name : 'Chưa xác định' }}</td>
                            <td><span class="bag-count">{{$d->totalOrder}}</span></td>
                            <td><span class="bag-amount">{{number_format($d->total_amount)}}</span></td>
                            <td><span class="bag-commission">{{number_format($d->total_commission)}}</span> </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->withQueryString()->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
