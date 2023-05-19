@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách Subscribe</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách Subscribe</h4>
            <p>Danh sách Subscribe trên trang</p>
        </div>


        <div class="panel-body">
            <div class="table-responsive">

                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>Ngày đăng ký</th>
                        <th>Setting</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{$d->email}}</td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td>
                                <ul class="table-options">
                                    <li><a class="example-p-6" data-url="{{route('wadmin::newsletter.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
