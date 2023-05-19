@extends('frontend::master')

@section('js-init')

    <script type="text/javascript">
        $("#sortGo").on('change',function(e){
            $('#sortForm').submit();
        })
    </script>
@endsection

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="page-caption">
                <h2>{{trans('frontend.company_list')}}</h2>
                <p><a href="{{route('frontend::home')}}" title="Home">{{trans('frontend.home')}}</a> <i class="ti-angle-double-right"></i> {{trans('frontend.company')}}</p>
            </div>
        </div>
    </div>

    <section class="padd-top-80 padd-bot-80">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-5">
                    <form method="get" action="">
                    <div class="widget-boxed padd-bot-0">
                        <div class="widget-boxed-body">
                            <div class="search_widget_job">
                                <div class="field_w_search">
                                    <input type="text" name="name" class="form-control" placeholder="{{trans('frontend.search_keywords')}}">
                                </div>
                                <div class="field_w_search">
                                    <input type="text" name="city" class="form-control" placeholder="{{trans('frontend.all_locations')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget-boxed padd-bot-0">
                        <div class="widget-boxed-header br-0">
                            <h4>{{trans('frontend.categories')}} <a href="#qualification" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
                        </div>
                        <div class="widget-boxed-body collapse" id="qualification">
                            <div class="side-list no-border">
                                <ul>
                                    @foreach($allCategory as $key=>$row)
                                    <li> <span class="custom-checkbox">
                  <input type="checkbox" name="category[]" value="{{$row->id}}" id="{{$row->id}}">
                  <label for="12"></label>
                  </span> {{$row->name}}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 padd-top-10 text-center">
                        <button type="submit" class="btn btn-m theme-btn full-width">{{trans('frontend.search')}}</button>
                    </div>
                    </form>
                </div>

                <!-- Start Job List -->
                <div class="col-md-9 col-sm-7">
                    <div class="row mrg-bot-20">
                        <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                            <h4 class="job_vacancie">{{trans('frontend.total')}} {{$countCompany}} {{trans('frontend.companies')}} </h4>
                        </div>
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="fl-right short_by_filter_list">
                                <div class="search-wide short_by_til">
                                    <h5>{{trans('frontend.short_by')}}</h5>
                                </div>
                                <div class="search-wide full">
                                    <form method="get" name="sort_form" id="sortForm">
                                    <select id="sortGo" class="wide form-control" name="sort_order" style="display: none;">
                                        <option value="1">{{trans('frontend.most_recent')}}</option>
                                        <option value="2">{{trans('frontend.most_viewed')}}</option>
{{--                                        <option value="4">{{trans('frontend.most_search')}}</option>--}}
                                    </select>
                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>

                @foreach($data  as $row)
                    <!-- Single Verticle job -->
                    <div class="job-verticle-list">
                        <div class="vertical-job-card">
                            <div class="vertical-job-header">
                                <div class="vrt-job-cmp-logo">
                                    <a href="{{route('frontend::company.detail.get',$row->slug)}}">
                                        <img src="{{ ($row->thumbnail!='') ? upload_url($row->thumbnail) : public_url('admin/themes/images/no-image.png')}}" class="img-responsive" alt="{{$row->name}}">
                                    </a>
                                </div>
                                <h4><a href="{{route('frontend::company.detail.get',$row->slug)}}">{{$row->name}}</a></h4>
                                <span class="com-tagline">{{($row->operating_status=='active') ? trans('frontend.on_working') : trans('frontend.off_working')}}</span>
                                <span class="pull-right vacancy-no">No. <span class="v-count">1</span></span>
                            </div>
                            <div class="vertical-job-body">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <ul class="can-skils">
                                            <li><strong>{{trans('frontend.authorized_fee')}} : </strong>{{$row->moneyrule}}</li>
                                            <li><strong>{{trans('frontend.city')}} : </strong>{{$row->city}}</li>
                                            <li><strong>{{trans('frontend.categories')}}  : </strong>
                                                <div>
                                                    {{$row->getallCattegory()}}
                                                </div>
                                            </li>
                                            <li><strong>{{trans('frontend.founded_year')}} : </strong>{{$row->operating_year}}</li>
                                            <li><strong>{{trans('frontend.description')}}  : </strong>{{$row->description}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div class="vrt-job-act">
                                            <a href="javascript:void(0)" id="btnPopup" data-id="{{$row->id}}" data-company="{{$row->name}}" data-toggle="modal" data-target="#partner"
                                               class="btn-job theme-btn job-apply btnPopup">{{trans('frontend.co_operate')}}</a>
                                            <a href="{{route('frontend::company.detail.get',$row->slug)}}" title="" class="btn-job light-gray-btn">{{trans('frontend.view_info')}}</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="clearfix"></div>
                    <div class="utf_flexbox_area padd-0">
                        {{$data->links()}}
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </section>

    @include('frontend::blocks.newsletter')

    @endsection
