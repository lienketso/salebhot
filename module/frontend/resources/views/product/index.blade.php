@extends('frontend::master')
@section('js-init')

@endsection
@section('content')
<section class="py-8 page-title border-top mt-1" data-animated-id="1">
    <div class="container">
        <h1 class="fs-40 mb-1 text-capitalize text-center">{{$catInfor->name}}</h1>
    </div>
</section>

<section class="pb-10 pb-lg-15 overflow-hidden">
    <div class="container container-xxl">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-3 mb-6 mb-lg-0 pr-xxl-8" data-animate="fadeInLeft">
                <h2 class="fs-30 fs-md-56 mb-5">{{($lang=='vn') ? 'Sản phẩm' : 'Best'}}<br>
                    {{($lang=='vn') ? 'Bán chạy' : 'Seller'}}</h2>
                <p class="mb-0 font-weight-500">{{($lang=='vn') ? 'Những sản phẩm hiện đang bán chạy nhất của TvrStore' : 'Products best seller in TvrStore'}}</p>
                <div class="pt-8 pt-lg-11 d-flex custom-arrow">
                    <a href="#" class="arrow slick-prev"><i class="far fa-arrow-left"></i></a>
                    <a href="#" class="arrow slick-next"><i class="far fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="category-slider pl-xxl-9 pr-lg-6" data-animate="fadeInRight">
                <div class="slick-slider custom-nav custom-slider-01" data-slick-options='{"slidesToShow": 2,"infinite":true,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1200,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>
                    @foreach($bestSeller as $d)
                    <div class="box">
                        @if(auth()->guard()->check())
                            <a href="{{route('wadmin::product.edit.get',$d->id)}}" target="_blank" class="edit-item"><i class="far fa-edit"></i> Edit</a>
                            @endif
                        <div class="card border-0">
                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/images/no-image.png')}}" alt="Chairs" class="card-img">
                            <div class="card-img-overlay d-inline-flex flex-column px-7 pt-6 pb-7">
                                <h3 class="card-title fs-20 fs-md-40">{{$d->name}}</h3>
                                <div class="mt-auto">
                                    <a href="{{route('frontend::product.detail.get',$d->slug)}}"
                                       class="text-uppercase fs-14 letter-spacing-05 border-bottom border-light-dark border-hover-primary font-weight-bold">{{($lang=='vn') ? 'Mua ngay' : 'Shop Now'}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<section data-animated-id="2">
    <div class="container container-xxl">
        <div class="d-flex mb-7">
            <div class="d-flex align-items-center text-primary font-weight-500" data-canvas="true" data-canvas-options="{&quot;container&quot;:&quot;.filter-canvas&quot;}">
                <button type="button" class="border-0 pl-0 pr-2 fs-12 bg-transparent">
                    <i class="far fa-align-left"></i>
                </button>
                Bộ lọc
            </div>
            <div class="ml-auto">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle fs-14" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sắp xếp mặc định
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">
                        <a class="dropdown-item text-primary fs-14" href="{{route('frontend::product.index.get',$catInfor->slug)}}?sort=za">Giá cao đến thấp</a>
                        <a class="dropdown-item text-primary fs-14" href="{{route('frontend::product.index.get',$catInfor->slug)}}?sort=az">Giá thấp đến cao</a>
                        <a class="dropdown-item text-primary fs-14" href="{{route('frontend::product.index.get',$catInfor->slug)}}">Mặc định</a>
                    </div>
                </div>
            </div>
        </div>


        @if(!empty($catCon) && count($catCon)>0)
            <div class="listCategoryParent">
                @foreach($catCon as $con)
                    <div class="item-catParent">
                        <h4>{{$con->name}}</h4>
                        @if(!empty($con->getProductCat))
                            <div class="list-product-parent">
                                <div class="row mb-7 overflow-hidden">
                                @foreach($con->getProductCat as $d)
                                    {{--item-latest--}}
                                    <div class="col-sm-6 col-lg-3 mb-6 fadeInUp animated" data-animate="fadeInUp">
                                        @include('frontend::product.item-product',$d)
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="btn-xem-parent">
                            <a href="{{route('frontend::product.index.get',$con->slug)}}">Xem tất cả</a>
                        </div>

                    </div>
                @endforeach

            </div>
        @else

        <div class="row mb-7 overflow-hidden">

            @foreach($data as $d)
            {{--item-latest--}}
                <div class="col-sm-6 col-lg-3 mb-6 fadeInUp animated" data-animate="fadeInUp">
                    @include('frontend::product.item-product',$d)
                </div>
            @endforeach

            <nav class="pb-11 pb-lg-14 overflow-hidden">
                {{$data->links()}}
            </nav>
        </div>
        @endif

    </div>
</section>

<div class="canvas-sidebar filter-canvas">
    <div class="canvas-overlay">
    </div>
    <form class="h-100">
        <div class="card border-0 pt-5 pb-8 pb-sm-13 h-100">
            <div class="px-6 pl-sm-8 text-right">
                <span class="canvas-close d-inline-block text-right fs-24 mb-1 ml-auto lh-1 text-primary"><i class="fal fa-times"></i></span>
            </div>
            <div class="card-header bg-transparent py-0 px-6 px-sm-8 border-bottom">
                <h3 class="fs-30 mb-5">
                    Lọc theo
                </h3>
                <p class="fs-15 text-primary mb-3">{{$data->count()}} Sản phẩm trong “ {{$catInfor->name}} ”</p>
            </div>
            <div class="card-body px-6 px-sm-8 pt-7 overflow-y-auto">
                <div class="card border-0 mb-7">
                    <div class="card-header bg-transparent border-0 p-0">
                        <h3 class="card-title fs-20 mb-0">
                            Danh mục sản phẩm
                        </h3>
                    </div>
                    <div class="card-body px-0 pt-4 pb-0">
                        <ul class="list-unstyled mb-0">
                            @foreach($allCatProduct as $key=>$val)
                            <li class="mb-1">
                                <a href="{{route('frontend::product.index.get',$val->slug)}}" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">{{$val->name}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>


            </div>

        </div>
    </form>
</div>
@endsection
