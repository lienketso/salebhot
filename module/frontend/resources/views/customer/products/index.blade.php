@extends('frontend::customer.master')
@section('content')
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg height="512" viewBox="0 0 486.65 486.65" width="512"><path d="m202.114 444.648c-8.01-.114-15.65-3.388-21.257-9.11l-171.875-171.572c-11.907-11.81-11.986-31.037-.176-42.945.058-.059.117-.118.176-.176l171.876-171.571c12.738-10.909 31.908-9.426 42.817 3.313 9.736 11.369 9.736 28.136 0 39.504l-150.315 150.315 151.833 150.315c11.774 11.844 11.774 30.973 0 42.817-6.045 6.184-14.439 9.498-23.079 9.11z"></path><path d="m456.283 272.773h-425.133c-16.771 0-30.367-13.596-30.367-30.367s13.596-30.367 30.367-30.367h425.133c16.771 0 30.367 13.596 30.367 30.367s-13.596 30.367-30.367 30.367z"></path>
                            </svg>
                        </a>
                        <h5 class="title mb-0 text-nowrap">Sản phẩm</h5>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">
        <div class="content-inner pt-0">
            <div class="container p-b30">
    <div class="title-bar">
        <span class="title mb-0 font-18">Danh sách sản phẩm</span>
    </div>
    <div class="row g-3 mb-3">
        @foreach($data as $d)
        <div class="col-12">
            <div class="card-item style-1">
                <div class="dz-media">
                    <img src="{{($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}" alt="{{$d->name}}">
                </div>
                <div class="dz-content">
                    <h6 class="title mb-3"><a href="#">{{$d->name}}</a></h6>
                    <div class="dz-meta">
                        {!! $d->content !!}
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-primary add-btn light" href="{{route('frontend::product.checkout.get',$d->id)}}">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach



    </div>
        </div>
        </div>
    </div>

@endsection
