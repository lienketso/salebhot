@extends('frontend::master')
@section('content')
    <section>
        <div class="gap black-layer opc8 overlap144">
            <div class="fixed-bg2" style="background-image: url('{{ ($setting['banner_product'] != '') ? upload_url($setting['banner_product']) : public_url('frontend/assets/images/page-title.jpg')}}');"></div>
            <div class="container">
                <div class="pg-tp-wrp">
                    <h1 itemprop="headline">{{trans('frontend.product')}}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}" title="" itemprop="url">{{trans('frontend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('frontend.product')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="blg-sec remove-ext5">
                    <div class="row">
                        @foreach($data as $d)
                            <div class="col-md-4 col-sm-6 col-lg-3" >
                                <div class="tm-bx">
                                    <div class="tm-thmb">
                                        <a href="{{route('frontend::product.index.get',$d->slug)}}" title="{{$d->name}}" itemprop="url">
                                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}"
                                                 alt="{{$d->name}}" itemprop="image">
                                        </a>
                                    </div>
                                    <div class="tm-inf fix-desc">
                                        <h5 itemprop="headline" class="title_gp">
                                            <a href="{{route('frontend::product.index.get',$d->slug)}}" title="{{$d->name}}" itemprop="url">{{$d->name}}</a>
                                        </h5>
                                        <div class="desc_gp">
                                            {{$d->meta_desc}}
                                        </div>
                                        <div class="btn-tuvan"><a href="{{route('frontend::product.index.get',$d->slug)}}">{{trans('frontend.solution_consulting')}}</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="pgn-wrp text-center">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </section>

@endsection
