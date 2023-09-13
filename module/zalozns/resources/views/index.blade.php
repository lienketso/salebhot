@extends('wadmin-dashboard::master')

@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách template zalo zns</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách template zalo zns</h4>
            <p>Danh sách template zalo zns</p>
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
                            <a href="{{route('wadmin::zalozns.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>

                        <div class="col-sm-2 col-lg-1" >
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::zalozns.create.get')}}"><i class="fa fa-plus"></i> Thêm mới</a>
                            </div>
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
                        <th>Tên template</th>
                        <th>Mã template</th>
                        <th>Loại template</th>
                        <th>Trạng thái</th>
                        <th>Tham số</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr id="tr_{{$d->id}}">
                            <td>{{$key+1}}</td>
                            <td>
                                {{$d->name}}
                            </td>
                            <td>{{$d->template_number}}</td>
                            <td>{{$d->template_model}}</td>
                            <td>{{$d->status}}</td>
                            <td><a href="{{route('wadmin::zalozns.param.index',$d->id)}}"><i class="fa fa-eye"></i> Xem</a></td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::zalozns.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::zalozns.delete.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
