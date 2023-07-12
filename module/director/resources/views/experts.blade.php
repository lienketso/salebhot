@extends('wadmin-dashboard::master')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $('.js-example-basic-single').select2();
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách chuyên viên</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách chuyên viên</h4>
            <p>Danh sách chuyên viên</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên CV / SĐT / Địa chỉ" class="form-control">
                        </div>

                        <div class="col-sm-2 txt-field">
                            <select name="city" class="form-control js-example-basic-single">
                                <option value="">Tỉnh/Thành Phố</option>
                                @foreach($cities as $c)
                                    <option value="{{$c->matp}}" {{(request('city')==$c->matp) ? 'selected' : ''}}>{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 txt-field">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::director.expert.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th>Chuyên viên</th>
                        <th>Số điện thoại</th>
                        <th>Khu vực</th>
                        <th>Địa chỉ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $d->full_name }}</td>
                            <td>{{$d->phone}}</td>
                            <td>{{($d->city()->exists()) ? $d->city->name : ''}}</td>
                            <td class="">{{$d->address}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->withQueryString()->links()}}
            </div>
        </div>
    </div>
@endsection
