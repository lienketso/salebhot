@extends('frontend::master')

@section('js-init')

@endsection

@section('content')
<section class="bg-color-3" data-animated-id="1">
    <div class="container">
        <nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between">
            <ol class="breadcrumb py-3 mr-6">
                <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('frontend::product.index.get',$catInforName->slug)}}"> {{$catInforName->name}} </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
            </ol>

        </nav>
    </div>
</section>
<section class="pt-10 pb-lg-15 pb-11" data-animated-id="2">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-7 mb-6 mb-md-0 pr-md-6 pr-lg-9">
                <div class="galleries position-relative">

                    <div class="slick-slider slider-for" data-slick-options='{"slidesToShow": 1, "autoplay":false,"dots":false,"arrows":false,"asNavFor": ".slider-nav"}'>
                        <div class="box">
                            <div class="card p-0 hover-change-image rounded-0 border-0">
                                <a href="{{ ($data->thumbnail!='') ? upload_url($data->thumbnail) : asset('frontend/assets/images/no-image.png')}}" class="card-img ratio ratio-1-1 bg-img-cover-center" data-gtf-mfp="true" data-gallery-id="02"
                                 style="background-image:url('{{ ($data->thumbnail!='') ? upload_url($data->thumbnail) : asset('frontend/assets/images/no-image.png')}}')">
                             </a>
                         </div>
                     </div>
                     @if($imageAttach)
                     @foreach($imageAttach as $d)
                     <div class="box">
                        <div class="card p-0 hover-change-image rounded-0 border-0">
                            <a href="{{public_url($d->path_name)}}" class="card-img ratio ratio-1-1 bg-img-cover-center" data-gtf-mfp="true" data-gallery-id="02"
                             style="background-image:url('{{public_url($d->path_name)}}')">
                         </a>
                     </div>
                 </div>
                 @endforeach
                 @endif

             </div>
             <div class="slick-slider slider-nav mt-1 mx-n1" data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":false,"arrows":false,"asNavFor": ".slider-for","focusOnSelect": true,"responsive":[{"breakpoint": 768,"settings": {"slidesToShow": 3,"arrows":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false}}]}'>
                @if($imageAttach)
                <div class="box px-0">
                    <div class="bg-white p-1 h-100 rounded-0">
                        <img src="{{ ($data->thumbnail!='') ? upload_url($data->thumbnail) : asset('frontend/assets/images/no-image.png')}}" alt="Image 1" class="h-100 w-100">
                    </div>
                </div>
                @foreach($imageAttach as $d)
                <div class="box px-0">
                    <div class="bg-white p-1 h-100 rounded-0">
                        <img src="{{public_url($d->path_name)}}" alt="Image 2" class="h-100 w-100">
                    </div>
                </div>
                @endforeach
                @endif


            </div>
        </div>
    </div>
    <div class="col-md-5">
        @if(auth()->guard()->check())
        <div class="edit-admin">
            <a href="{{route('wadmin::product.edit.get',$data->id)}}" target="_blank"><i class="far fa-edit"></i> Sửa sản phẩm</a>
        </div>
        @endif
        <p class="text-muted fs-12 font-weight-500 letter-spacing-05 text-uppercase mb-3">{{$catInforName->name}}</p>
        <h2 class="fs-30 fs-lg-40 mb-2">{{$data->name}}</h2>
        @if($data->sku!='')
        <p class="sku-detail">Mã sản phẩm : {{$data->sku}}</p>
        @endif
        @if($data->disprice==0)
        <p class="fs-20 text-primary mb-4">
            <strong style="color: #c00">{{number_format($data->price)}}</strong></p>
            @else
            <p class="mt-auto text-primary mb-0 font-weight-500 price-bold">
                <span class="text-line-through text-secondary fs-14 d-inline-block mr-2 font-weight-normal">{{number_format($data->disprice)}}</span>
                <strong style="color: #c00">{{number_format($data->price)}}</strong>
                <span class="percent-detail">-{{price_percent($data->price,$data->disprice)}}%</span>
            </p>
                @endif
                <!-- <p class="mb-5">{{$data->description}}</p> -->
                <div class="thongso-detail">
                    {!! $data->product_meta !!}
                </div>
                <form method="get" action="{{route('frontend::cart.single.get')}}">
                    @if(!empty($data->meta->colors))
                    <div class="form-group shop-swatch mb-6">
                        <label class="mb-3"><span class="text-primary fs-16 font-weight-bold">Mầu sắc :</span></label>
                        @foreach($data->meta->colors as $key=>$color)
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="buy{{$key}}" name="colors" class="custom-control-input" >
                                <label class="custom-control-label" for="buy{{$key}}">{{$color['name']}} -  <strong>{{$color['price']}}</strong></label>
                            </div>
                        @endforeach
                    </div>
                    @endif

                     @if(!empty($data->meta->size))
                            <div class="form-group shop-swatch mb-6">
                            <p class="text-primary font-weight-bold mb-3">Kích thước : </p>
                            @foreach($data->meta->size as $key=>$size)
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="size{{$key}}" name="size" class="custom-control-input" >
                                <label class="custom-control-label" for="size{{$key}}">{{$size['name']}} - <strong> {{$size['price']}}</strong></label>
                            </div>
                            @endforeach
                            </div>
                        @endif


                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <button type="submit" class="btn btn-primary btn-block mb-4 border-ra25">Mua hàng
                    </button>

                    <div class="hotline-detail">
                        <a href="tel:{{str_replace(' ','',$setting['site_hotline_vn'])}}">Hotline liên hệ {{$setting['site_hotline_vn']}}</a>
                    </div>

                    <ul class="list-inline px-xl-8 mb-4 d-flex align-items-center justify-content-center">
                        <li class="list-inline-item mr-5">
                            <img class="" src="{{asset('frontend/assets')}}/images/p1.png" alt="Visa">
                        </li>
                        <li class="list-inline-item mr-5">
                            <img class="" src="{{asset('frontend/assets')}}/images/p2.png" alt="Visa">
                        </li>
                        <li class="list-inline-item mr-5">
                            <img class="" src="{{asset('frontend/assets')}}/images/p3.png" alt="Visa">
                        </li>
                        <li class="list-inline-item mr-5">
                            <img class="" src="{{asset('frontend/assets')}}/images/p4.png" alt="Visa">
                        </li>
                        <li class="list-inline-item mr-5">
                            <img class="" src="{{asset('frontend/assets')}}/images/p5.png" alt="Visa">
                        </li>
                    </ul>
                </form>

            </div>
        </div>
    </div>
</section>


<section class="pb-11 pb-lg-13" data-animated-id="4">
    <div class="container">
        <div class="collapse-tabs">
            <ul class="nav nav-pills mb-3 justify-content-center d-md-flex d-none" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show fs-lg-32 fs-24 font-weight-800 p-0 mr-md-10 mr-4" id="pills-description-tab"
                    data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="false">Chi tiết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-lg-32 fs-24 font-weight-800 p-0 mr-md-10 mr-4" id="pills-infomation-tab"
                    data-toggle="pill" href="#pills-infomation" role="tab" aria-controls="pills-infomation" aria-selected="false">Những câu hỏi thường gặp</a>
                </li>
                {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link fs-lg-32 fs-24 font-weight-600 p-0" id="pills-reviews-tab" data-toggle="pill"--}}
                    {{--                           href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="true">Đánh giá (3)</a>--}}
                {{--                    </li>--}}
            </ul>
            <div class="tab-content bg-white-md shadow-none py-md-5 p-0">
                <div id="collapse-tabs-accordion-01">
                    <div class="tab-pane tab-pane-parent fade show active" id="pills-description" role="tabpanel">
                        <div class="card border-0 bg-transparent">
                            <div class="card-header border-0 d-block d-md-none bg-transparent px-0 py-1" id="headingDetails-01">
                                <h5 class="mb-0">
                                    <button class="btn lh-2 fs-18 py-1 px-6 shadow-none w-100 collapse-parent border text-primary" data-toggle="false" data-target="#description-collapse-01" aria-expanded="true" aria-controls="description-collapse-01">
                                        Chi tiết
                                    </button>
                                </h5>
                            </div>
                            <div id="description-collapse-01" class="collapsible collapse show" aria-labelledby="headingDetails-01" data-parent="#collapse-tabs-accordion-01" style="">
                                <div id="accordion-style-01" class="accordion accordion-01 border-md-0 border p-md-0 p-6">

                                    <div class="mt-6 mt-md-10 mx-auto mb-0">{!! $data->content !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-pane-parent fade" id="pills-infomation" role="tabpanel">
                        <div class="card border-0 bg-transparent">
                            <div class="card-header border-0 d-block d-md-none bg-transparent px-0 py-1" id="headinginfomation-01">
                                <h5 class="mb-0">
                                    <button class="btn lh-2 fs-18 py-1 px-6 shadow-none w-100 collapse-parent border collapsed text-primary" data-toggle="collapse" data-target="#infomation-collapse-01" aria-expanded="false" aria-controls="infomation-collapse-01">
                                        Câu hỏi thường gặp
                                    </button>
                                </h5>
                            </div>
                            <div id="infomation-collapse-01" class="collapsible collapse" aria-labelledby="headinginfomation-01" data-parent="#collapse-tabs-accordion-01" style="">
                                <div id="accordion-style-01-2" class="accordion accordion-01 border-md-0 border p-md-0 p-6 ">
                                    <div class="mxw-830 mx-auto pt-md-4">
                                        <div class="table-responsive mb-md-7">
                                            {!! $data->chapter !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-11 pb-lg-15">
    <div class="container container-xxl">
        <h2 class="fs-md-40 fs-30 mb-9 text-center">Có thể bạn sẽ thích</h2>
        <div class="slick-slider" data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>
            @foreach($relatedProduct as $d)
            <div class="box">
                {{--item-latest--}}
                @include('frontend::product.item-product',$d)
            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection
