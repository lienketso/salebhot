@extends('frontend::master')
@section('content')
    <section>
        <div class="gap black-layer opc8 overlap144">
            <div class="fixed-bg2" style="background-image: url('{{($setting['banner_factory']!='') ? upload_url($setting['banner_factory']) : public_url('frontend/assets/images/tech.png')}}');"></div>
            <div class="container">
                <div class="pg-tp-wrp">
                    <h1 itemprop="headline">{{trans('frontend.factory_information')}}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}" title="Trang chủ" itemprop="url">{{trans('frontend.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('frontend::factory.index.get')}}"
                                                       title="{{trans('frontend.factory_information')}}"
                                                       itemprop="url">{{trans('frontend.factory_information')}}</a></li>
                        <li class="breadcrumb-item active">{{$data->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="about_factory">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="img_factory_detail">
                                <img src="<?= upload_url($data->image) ?>" alt="<?= $data->name; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info_factory">
                                <h4>{{$data->name}}</h4>
                                <div class="desc_fact">
                                    {{$data->description}}
                                </div>
                                <div class="content_fact">
                                    {!! $data->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_factory">
                    <div class="title_main_fac">
                        <h4>{{trans('frontend.product')}}</h4>
                        <p>{{$setting['keyword_8_'.$lang]}} <span>{{$data->name}}</span></p>
                    </div>
                    <div class="list_product_fact">
                        <div class="row">
                        @if(!empty($productByFac))
                            @foreach($productByFac as $d)
                            <div class="col-lg-3">
                                <div class="item_product_fac">
                                    <a href="{{route('frontend::product.detail.get',$d->slug)}}">
                                        <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}"
                                             alt="{{$d->name}}">
                                        <div class="desc_pro_fact">
                                        <h3>{{$d->name}}</h3>
                                            <div class="none_hover" >
                                            <p>{{cut_string($d->description,60)}}</p>
                                            <span>{{trans('frontend.view_info')}} <i class="fa fa-arrow-right"></i></span>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </div>
                                @endforeach
                            @else
                                <p>Sản phẩm đang được cập nhật ...</p>
                            @endif


                        </div>
                        <div class="pgn-wrp text-center">
                            {{$productByFac->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
