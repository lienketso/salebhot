@extends('frontend::master')
@section('content')
    <section>
        <div class="gap black-layer opc8 overlap144">
            <div class="fixed-bg2" style="background-image: url('{{ ($setting['banner_project'] != '') ? upload_url($setting['banner_project']) : public_url('frontend/assets/images/page-title.jpg')}}');"></div>
            <div class="container">
                <div class="pg-tp-wrp">
                    <h1 itemprop="headline">{{trans('frontend.career')}}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}" title="" itemprop="url">{{trans('frontend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('frontend.career')}}</li>
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
                            <div class="col-md-4 col-sm-6 col-lg-4">
                                <div class="camp-bx">
                                    <div class="camp-thmb">
                                        <a href="{{route('frontend::solution.detail.get',$d->slug)}}" title="{{$d->name}}" itemprop="url">
                                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" alt="camp-img1.jpg" itemprop="image">
                                        </a>
                                        <div class="camp-inf">
                                            <h5 itemprop="headline"><a href="{{route('frontend::solution.detail.get',$d->slug)}}"
                                                                       title="{{$d->name}}" itemprop="url">{{$d->name}}</a></h5>

                                        </div>
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
