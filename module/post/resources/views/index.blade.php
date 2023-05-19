@extends('wadmin-dashboard::master')
@section('js')
    <link href="{{asset('admin/libs/select2/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('admin/libs/select2/select2.min.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-basic-search').select2();
        });
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách bài viết</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách bài viết</h4>
            <p>Danh sách bài viết trên trang</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-3 col-lg-3">
                            <input type="text" name="name" placeholder="Nhập tiêu đề" class="form-control">
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <select name="category" class="form-control js-basic-search">
                                <option value="">Tất cả danh mục</option>
                                @if($category && count($category))
                                    @foreach($category as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <select name="user_post" class="form-control js-basic-search">
                                <option value="">Tất cả tác giả</option>
                                @if($userPost  && count($userPost ))
                                    @foreach($userPost  as $d)
                                        <option value="{{$d->id}}">{{$d->full_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-1 col-lg-2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::post.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-2 col-lg-1" >
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::post.create.get')}}">Thêm mới</a>
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
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Người soạn</th>
                        <th>Lượt xem</th>
                        <th class="">Ngày tạo</th>
                        <th class="">Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <div class="product-img bg-transparent border">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </td>
                            <td>{{$d->name}}</td>
                            <td>{{$d->getCategory()}}</td>
                            <td>{{$d->getUserPost->full_name}}</td>
                            <td>{{$d->count_view}}</td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td>
                                @if($permissionPost->contains('name','status_active'))
                                <a title="Click để duyệt bài nhanh hoặc ẩn bài viết" href="{{route('wadmin::post.change.get',$d->id)}}"
                                   class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                    {{($d->status=='active') ? 'Đã duyệt' : 'Tạm ẩn'}}</a></td>
                            @else
                                <a href="#"
                                   class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                    {{($d->status=='active') ? 'Đã duyệt' : 'Tạm ẩn'}}</a>
                                @endif
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::post.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::post.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
