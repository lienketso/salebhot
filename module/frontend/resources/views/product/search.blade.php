@extends('frontend::master')
@section('content')


    <section class="py-8 page-title border-top mt-1" data-animated-id="1">
    <div class="container">
        <h1 class="fs-40 mb-1 text-capitalize text-center">{{trans('frontend.search_result')}}</h1>
    </div>
</section>


    <section style="background: #F6F6F6">
        <div class="gap">
            <div class="container">
                <div class="result_name" style="padding: 20px 0">{{trans('frontend.have_result')}} <strong>{{count($data)}}</strong> {{trans('frontend.result_with_keyword')}}  <span>"{{$name}}"</span></div>
                <div class="evnt-sec remove-ext5">
                    <div class="row">


                                @foreach($data as $d)
                                    <div class="col-md-4 col-sm-6 col-lg-4">
                                        @include('frontend::product.item-product',$d)
                                    </div>
                                @endforeach

                    </div>
                </div>
                <div class="pgn-wrp text-center" style="padding: 50px 0">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </section>

    @endsection
