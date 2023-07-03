@extends('wadmin-dashboard::master')

@section('css')

@endsection

@section('js')

@endsection
@section('js-init')

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::company.index.get')}}">Yêu cầu rút tiền</a></li>
        <li class="active">Xác nhận hoàn tiền</li>
    </ol>

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @if (session('delete'))
                <div class="alert alert-danger">{{session('delete')}}</div>
            @endif
        <form method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Hoàn tiền nhà phân phối: <strong>{{$data->company->name}} - ID : {{$data->company->company_code}}</strong></h4>
                        <p>Bạn cần nhập lý do để hoàn tiền cho nhà phân phối </p>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">
                            <label>Nhập lý do hoàn tiền lại nhà phân phối</label>
                            <textarea id="" name="description" class="form-control" rows="3" placeholder="Lý do hoàn tiền">{{$data->description}}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                        </div>
                    </div>
                </div><!-- panel -->

            </div><!-- col-sm-6 -->

            <!-- ####################################################### -->

            <div class="col-sm-4">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tùy chọn thêm</h4>
                        <p>Thông tin các tùy chọn thêm </p>
                    </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="refund" >Hoàn tiền</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
