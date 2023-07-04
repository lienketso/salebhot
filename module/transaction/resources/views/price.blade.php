@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $('.js-select-single').select2();
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::transaction.index.get')}}">Đơn hàng</a></li>
        <li class="active">Sửa giá trị đơn hàng #{{$data->phone}}</li>
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
        <form method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Sửa giá trị đơn hàng</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa đơn hàng </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên khách hàng (*)</label>
                            <input class="form-control"
                                   name="name"
                                   disabled="disabled"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="VD : Nguyễn Văn A">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại (*)</label>
                            <input class="form-control"
                                   name="phone"
                                   disabled="disabled"
                                   type="text"
                                   value="{{$data->phone}}"
                                   placeholder="VD : 0978xxxxxx">
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
                            <label>Nhà phân phối</label>
                            <select id="" name="company_id" class="form-control" disabled style="width: 100%" >
                                <option value="{{$data->company->id}}">{{$data->company->name}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Giá trị đơn hàng</label>
                            <input class="form-control"
                                   onkeyup="this.value=FormatNumber(this.value);"
                                   name="amount"
                                   type="text"
                                   value="{{number_format($data->amount)}}"
                                   placeholder="">
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
