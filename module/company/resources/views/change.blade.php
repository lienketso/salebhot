@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder_v1.js')}}"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script type="text/javascript">
        $("#select6").select2({ tags: true, maximumSelectionLength: 3 });
        $('.js-example-basic-single').select2();
        $('.js-select-one').select2();
    </script>

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::company.index.get')}}">Nhà phân phối</a></li>
        <li class="active">Sửa mã nhà phân phối</li>
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
                        <h4 class="panel-title">Sửa nhà phân phối</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa nhà phân phối </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Mã NPP cũ (*)</label>
                            <select id="ha" class="form-control js-example-basic-single" name="old_company_code" style="width: 100%"
                                    data-placeholder="Chọn mã NPP" aria-hidden="true">
                                <option value="">Tìm mã nhà phân phối</option>
                                @foreach($activeCompany as $c)
                                    <option value="{{$c->company_code}}" >{{$c->name}} | {{$c->company_code}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Mã NPP mới (*)</label>
                            <select id="ca" class="form-control js-select-one" name="company_code" style="width: 100%"
                                    data-placeholder="Chọn mã NPP" aria-hidden="true">
                                <option value="">Tìm mã nhà phân phối</option>
                                @foreach($currentCompany as $c)
                                    <option value="{{$c->company_code}}" >{{$c->name}} | {{$c->company_code}}</option>
                                @endforeach

                            </select>
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
                            <button class="btn btn-primary">Lưu lại</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
