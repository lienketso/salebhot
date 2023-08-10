@extends('wadmin-dashboard::master')
@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js')
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script>
        $('.js-example-basic-single').select2();
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Tổng hợp nhà phân phối</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Tổng hợp nhà phân phối</h4>
            <p>Thông tin tổng hợp nhà phân phối</p>
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
                            <select name="u" class="form-control js-example-basic-single">
                                <option value="">Lọc theo sale</option>
                                @foreach($users as $m)
                                    <option value="{{$m->id}}" {{(request('u')==$m->id) ? 'selected' : ''}}>{{$m->full_name}} - {{$m->phone}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::reports.total.sale-distributor')}}" class="btn btn-default"><i class="fa fa-refresh"></i> Làm lại</a>
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
                    <h4 class="panel-title text-success">Tổng hợp nhà phân phối</h4>
                    <p class="nomargin">Tổng hợp nhà phân phối theo tiêu chí:

                    </p>
                </div>
                <div class="panel-body">


                    <div class="mb20"></div>

                    <table class="table nomargin">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sales</th>
                            <th>Số lượng nhà phân phối</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$d)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$d->full_name}} - {{$d->phone}}</td>
                                <td><span class="bag-commission">{{$d->countCompany}} </span></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div><!-- panel-body -->



            </div><!-- panel -->


        </div>
    </div>
@endsection
