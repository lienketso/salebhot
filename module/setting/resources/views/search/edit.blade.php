@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $("#select1").select2({  });
    </script>
    <script type="text/javascript">

        //add new search
        var i=0;
        $('#addSearch').on('click',function (e){
            i++;
            let html = '<div class="row" id="search'+i+'"><div class="col-lg-10"><div class="form-list-search"><input type="text" name="meta_value[]" class="form-control" placeholder="Tên trường search"></div> </div><div class="col-lg-2"><div class="btn-search-list"><button type="button" data-id="search'+i+'" class="delSearch">Xóa</button></div></div></div>';
            $('#SearchList').append(html);
        });
        //remove search
        $(document).on('click', '.delSearch', function(){
            var button_id = $(this).attr("data-id");
            $('#'+button_id+'').remove();
        });


    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::search.index.get')}}">Form search</a></li>
        <li class="active">Thêm Form search</li>
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
                        <h4 class="panel-title">Thêm Form search</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin sửa form search</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề form</label>
                            <input class="form-control"
                                   name="meta_key"
                                   type="text"
                                   value="{{$data->meta_key}}"
                                   placeholder="Tiêu đề form">
                        </div>

                        <div class="form-group">
                            <select name="category" class="form-control" id="select1">
                                <option value="">---Hiển thị trong danh mục</option>
                                @foreach($category as $d)
                                    <option value="{{$d->id}}" {{($d->id==$data->category) ? 'selected' : ''}}>{{$d->name}}</option>
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
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ (old('status')=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
