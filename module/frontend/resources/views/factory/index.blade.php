@extends('frontend::master')
@section('content')
    <section>
        <div class="gap black-layer opc6 overlap144">
            <div class="fixed-bg2" style="background-image: url('{{($setting['banner_factory']!='') ? upload_url($setting['banner_factory']) : public_url('frontend/assets/images/tech.png')}}');">

            </div>
            <div class="container">
                <div class="pg-tp-wrp">
                    <h1 itemprop="headline">{{trans('frontend.factory_information')}}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}" title="" itemprop="url">{{trans('frontend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('frontend.factory_member')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="desc_uud text-center">
                   {!! $setting['site_footer_info_'.$lang] !!}
                </div>
                <div class="pgn-wrp">
                    <div class="list_factory">
                        @foreach($data as $d)
                        <div class="item_factory">
                            <div class="img_factory">
                                <a href="{{route('frontend::factory.detail.get',$d->slug)}}">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}"
                                         alt="{{$d->name}}" ></a>
                            </div>
                            <div class="info_fac">
                                <h3><a href="{{route('frontend::factory.detail.get',$d->slug)}}">{{$d->name}}</a></h3>
                                <p>{{$d->description}}</p>
                                <div class="btn_fac">
                                    <a href="{{route('frontend::factory.detail.get',$d->slug)}}">{{trans('frontend.view_info')}}</a>
                                    <a href="{{$d->link}}" target="_blank">{{trans('frontend.view_website')}}</a>
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
