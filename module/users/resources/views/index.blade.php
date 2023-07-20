@extends('wadmin-dashboard::master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.changeGroup').on('change',function (e){
                e.preventDefault();
                let _this = $(e.currentTarget);
                var saleleader = _this.val();
                var sale = _this.attr('data-sale');
                let url = _this.attr('data-url');

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {sale,saleleader},
                    success: function (result) {
                        alert('chọn trưởng nhóm thành công !');
                        _this.css('border-color','#1aa71c');
                    },
                    error: function (data, status) {
                        console.log(data);
                    }
                });
            })
        })
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách user</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách user</h4>
            <p>Danh sách user trên trang</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-5">
                            <input type="text" name="name" placeholder="Tên hoặc email" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::users.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-5">
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::users.create.get')}}">Thêm mới</a>
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
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Quyền / Nhóm</th>
                        <th class="">Ngày tạo</th>
                        <th class="">Trạng thái</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        @php
                            $urole = $d->roles()->first();
                        @endphp
                        <tr>
                            <td>
                                <div class="product-img bg-transparent border">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </td>
                            <td>{{$d->email}}</td>
                            <td>
                                <p>{{$d->full_name}}</p>
                                @if($d->saleAdmin()->exists())
                                <p>Sale chăm sóc : {{$d->saleAdmin->full_name}}</p>
                                @endif
                            </td>
                            <td>
                                <p>{{$d->getRole()}} </p>
                                @if($d->is_leader==0 && $urole->id==9)

                                <select name="sale_leader_{{$d->id}}"
                                        data-sale="{{$d->id}}"
                                        data-url="{{route('wadmin::users.change-leader.get')}}"
                                        class="form-control select2-hidden-accessible changeGroup">
                                    <option value="">--Chọn trưởng nhóm--</option>
                                    @foreach($userSale as $s)
                                        <option value="{{$s->id}}" {{($s->id==$d->sale_leader)?'selected':''}}>{{$s->full_name}}</option>
                                    @endforeach
                                </select>

                                @endif
                            </td>
                            <td>{{$d->created_at}}</td>
                            <td><a href="#" class="btn btn-sm btn-success radius-30">Đã kích hoạt</a></td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::users.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::users.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
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
