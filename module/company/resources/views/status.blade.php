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
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
        $('.js-example-basic-single').select2();
        // auto close
        $('.accept-npp').on('click', function(e){
            e.preventDefault();
            let _this = $(e.currentTarget);
            let url = _this.attr('data-url');
            $.confirm({
                title: 'Xác nhận duyệt nhà phân phối',
                content: 'Bạn có chắc chắn muốn duyệt nhà phân phối này ?',
                autoClose: 'cancelAction|10000',
                escapeKey: 'cancelAction',
                buttons: {
                    confirm: {
                        btnClass: 'btn-green',
                        text: 'Duyệt nhà phân phối',
                        action: function(){
                            location.href = url;
                        }
                    },
                    cancelAction: {
                        text: 'Hủy',
                        action: function(){
                            $.alert('Đã hủy duyệt nhà phân phối !');
                        }
                    }
                }
            });
        });
    </script>
@endsection
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách NPP</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách NPP</h4>
            <p>Danh sách NPP</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="name" value="{{old('name',request('name'))}}" placeholder="Tên NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <input type="text" name="company_code" value="{{old('company_code',request('company_code'))}}" placeholder="Mã NPP" class="form-control">
                        </div>
                        <div class="col-sm-2 txt-field">
                            <select name="status" class="form-control">
                                <option value="">Trạng thái</option>
                                <option value="disable" {{(request('status')=='disable') ? 'selected' : ''}}>Chưa xác thực</option>
                                <option value="active" {{(request('status')=='active') ? 'selected' : ''}}>Đã xác thực</option>
                            </select>
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
                            <a href="{{route('wadmin::company.status.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th>Mã NPP</th>
                        <th width="300">Tên NPP</th>
                        <th>Ảnh NPP</th>
                        <th>Hình ảnh 1</th>
                        <th>Hình ảnh 2</th>
                        <th>Chuyên viên </th>
                        <th>Giám đốc vùng </th>
                        <th class="">Duyệt NPP</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$d)
                        <tr>
                            <td>{{$key}}</td>
                            <td><a href="{{route('wadmin::company.edit.get',$d->id)}}">{{$d->company_code}}</a></td>
                            <td class="namego">
                                <h4>{{$d->name}} - {{$d->contact_name}}</h4>
                                <ul>
                                    <li>Địa chỉ : {{$d->address}} - Số điện thoại :  <a title="Click để gọi điện số khách hàng" href="tel:{{$d->phone}}" target="_blank">{{$d->phone}} ( <i class="fa fa-phone"></i> Gọi điện )</a></li>
                                    <li>Số TK ngân hàng : <strong>{{$d->bank_number}}</strong></li>
                                    <li>Ngân hàng : <strong>{{$d->bank_name}}</strong></li>
                                </ul>
                            </td>
                            <td>
                                <div class="product-img bg-transparent border">
                                    <a style="cursor: pointer" data-fancybox="gallery"
                                       data-caption="Hình ảnh 1"
                                       data-src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}">
                                        <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="img-cccd">
                                    <a style="cursor: pointer" data-src="{{ ($d->cccd_mt!='') ? upload_url($d->cccd_mt) : public_url('admin/themes/images/no-image.png')}}"
                                       data-fancybox="gallery"
                                       data-caption="Hình ảnh 2">
                                        <img src="{{ ($d->cccd_mt!='') ? upload_url($d->cccd_mt) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="img-cccd">
                                    <a style="cursor: pointer"  data-src="{{ ($d->cccd_ms!='') ? upload_url($d->cccd_ms) : public_url('admin/themes/images/no-image.png')}}"
                                       data-fancybox="gallery"
                                       data-caption="Hình ảnh 3">
                                        <img src="{{ ($d->cccd_ms!='') ? upload_url($d->cccd_ms) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="op_sale">
                                    <span>{{($d->user()->exists()) ? $d->user->full_name : 'Null'}}</span>
                                </div>
                            </td>
                            <td><strong>{{ ($d->user()->exists() && !is_null($d->user->parents)) ? $d->user->parents->full_name : '' }}</strong></td>
                            <td>
                                @if($d->status=='pending' || $d->status=='disable')
                                    <a data-url="{{route('wadmin::company.change.get',$d->id)}}" title="Click để duyệt nhà phân phối"
                                       class="btn btn-sm btn-warning radius-30 accept-npp"><i class="fa fa-bell-o"></i> Duyệt ngay</a>
                                    <a href="{{route('wadmin::company.fix.get',$d->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-repeat"></i> Cần sửa</a>
                                    @else
                                    <a href="" class="btn btn-sm btn-success radius-30"><i class="fa fa-check-circle"></i> Đã duyệt </a>
                                @endif
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
