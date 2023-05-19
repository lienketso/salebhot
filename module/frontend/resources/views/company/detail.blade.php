@extends('frontend::master')
@section('content')
<div class="page-title">
    <div class="container">
        <div class="page-caption">
            <h2>{{trans('frontend.company_detail')}}</h2>
            <p><a href="{{route('frontend::home')}}" title="Home">{{trans('frontend.home')}}</a> <i class="ti-angle-double-right"></i> {{$data->name}}</p>
        </div>
    </div>
</div>
<section class="padd-top-80 padd-bot-60">
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="detail-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="row">
                            <div class="col-md-4 text-center user_profile_img">
                                <img src="{{ ($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}" class="width-100" alt="{{$data->name}}">
                                <h4 class="meg-0">{{$data->name}}</h4>
                                <span>{{trans('frontend.city')}} : {{$data->city}}</span>

                            </div>
                            <div class="col-md-8 user_job_detail">
                                <div class="col-sm-12 mrg-bot-10">{{trans('frontend.authorized_fee')}} : {{$data->moneyrule}} </div>
                                <div class="col-sm-12 mrg-bot-10">{{trans('frontend.founded_year')}} : {{$data->operating_year}} </div>
                                <div class="col-sm-12 mrg-bot-10">
                                    {{trans('frontend.operating_status')}}  : {{($data->operating_status=='active') ? trans('frontend.on_working') : trans('frontend.off_working')}}
                                </div>
                                <div class="col-sm-12 mrg-bot-10">
                                   {{trans('frontend.field_of_activity')}} {{$data->getallCattegory()}}
                                </div>
                                <div class="col-sm-12 mrg-bot-10">
                                    <button type="button" id="btnPopup" data-id="{{$data->id}}" data-company="{{$data->name}}" data-toggle="modal" data-target="#partner" class="btn-job theme-btn btnPopup">{{trans('frontend.co_operate')}}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>{{trans('frontend.company_description')}}</h4>
                    </div>
                    <div class="detail-wrapper-body">
                       {{$data->description}}
                    </div>
                </div>
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>{{trans('frontend.company_info')}}</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        {!!  $data->content !!}
                    </div>
                </div>
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>{{trans('frontend.product_with_company')}}</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <div class="row">
                            @foreach($productList as $p)
                            <div class="col-lg-3">
                                <div class="listProduct">
                                    <div class="img_product">
                                        <a class="" href="{{route('frontend::product.detail.get',$p->slug)}}"><img src="{{upload_url($p->thumbnail)}}"></a>
                                    </div>
                                    <h3><a href="#">{{$p->name}}</a></h3>
                                    <div class="desc_product">{{cut_string($p->description,70)}}</div>
                                    <p class="btnseemore"><a href="{{route('frontend::product.detail.get',$p->slug)}}">{{trans('frontend.see_product')}}</a></p>
                                </div>
                            </div>
                                @endforeach
                    </div>
                </div>
                </div>


            </div>


        </div>
        <!-- End Row -->

        <div class="row">
            <div class="col-md-12">
                <h4 class="mrg-bot-30">{{trans('frontend.similar_company')}}</h4>
            </div>
        </div>
        <div class="row">
            <!-- Single Job -->
            @foreach($semilarCompany as $row)
            <div class="col-md-3 col-sm-6">
                <div class="utf_grid_job_widget_area"> <span class="job-type full-type">{{$row->city}}</span>

                    <div class="u-content">
                        <div class="avatar box-80">
                            <a href="{{route('frontend::company.detail.get',$row->slug)}}">
                                <img class="img-responsive" src="{{ ($row->thumbnail!='') ? upload_url($row->thumbnail) : public_url('admin/themes/images/no-image.png')}}" alt="{{$data->name}}">
                            </a>
                        </div>
                        <h5><a href="{{route('frontend::company.detail.get',$row->slug)}}">{{$row->name}}</a></h5>
                        <p class="text-muted">{{cut_string($row->description,50)}}</p>
                    </div>
                    <div class="utf_apply_job_btn_item">
                        <a href="{{route('frontend::company.detail.get',$row->slug)}}" class="btn job-browse-btn btn-radius br-light">{{trans('frontend.view_info')}}</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@include('frontend::blocks.newsletter')

    @endsection
