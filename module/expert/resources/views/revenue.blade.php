@extends('wadmin-dashboard::master')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
@endsection
@section('js-init')
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Doanh số bán hàng</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Doanh số bán hàng</h4>
            <p>Thông tin doanh số</p>
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
                            <a href="{{route('wadmin::expert.revenue.get')}}" class="btn btn-default"><i class="fa fa-refresh"></i> Làm lại</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

        <div class="panel-body">


                <div class="panel panel-site-traffic">
                    <div class="panel-heading">
                        <ul class="panel-options">
                            <li><a><i class="fa fa-refresh"></i></a></li>
                        </ul>
                        <h4 class="panel-title text-success">Thống kê doanh thu và hoa hồng</h4>
                        <p class="nomargin">Thống kê doanh số và hoa hồng tháng <strong>{{$thang}}</strong> năm <strong>{{date('Y')}}</strong></p>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6 col-sm-4">
                                <div class="bg-revenua panel-success-full">
                                    <div class="pull-left">
                                        <div class="icon fa fa-shopping-cart"></div>
                                    </div>
                                    <div class="pull-left">
                                        <h4 class="panel-title">Đơn hàng trong tháng {{$thang}}</h4>
                                        <h3>{{$totalTransaction}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <div class="bg-revenua panel-warning-full">
                                    <div class="pull-left">
                                        <div class="icon fa fa-usd"></div>
                                    </div>
                                    <div class="pull-left">
                                        <h4 class="panel-title">Doanh số tháng {{$thang}}</h4>
                                        <h3>{{number_format($totalRevenue)}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <div class="bg-revenua panel-info-full">
                                    <div class="pull-left">
                                        <div class="icon fa fa-smile-o"></div>
                                    </div>
                                    <div class="pull-left">
                                        <h4 class="panel-title">Hoa hồng nhận được tháng {{$thang}}</h4>
                                        <h3>{{number_format($totalCommission)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->

                        <div class="mb20"></div>


                    </div><!-- panel-body -->



                </div><!-- panel -->


        </div>
    </div>
@endsection
