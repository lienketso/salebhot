@extends('frontend::master')

<section class="d-flex flex-column bg-img-cover-center vh-100 pt-xxl-13 custom-height-sm" style="background-image: url('images/bg-about-us-02.jpg')">
    <div class="d-flex flex-column h-100 justify-content-center">
        <div class="container container-xxl">
            <h1 class="fs-60 mb-4">About Us</h1>
            <p class="mb-0 mxw-435px">We believe in crafting pieces where sustainability and style go hand in hand.
                Made from materials like recycled</p>
        </div>
    </div>
</section>

@section('content')
    <section>
        <div class="gap black-layer opc8 overlap144">
            <div class="fixed-bg2" style="background-image: url('{{ ($setting['about_banner_page']!='null') ? upload_url($setting['about_banner_page']) :  public_url('admin/themes/images/no-image.png')}}');"></div>
            <div class="container">
                <div class="pg-tp-wrp">
                    <h1 itemprop="headline">{{$setting['about_main_title_'.$lang]}}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}" title="" itemprop="url">{{trans('frontend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{$setting['about_main_title_'.$lang]}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="cybersecurity-area ptb-100">
        <div class="gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cybersecurity-img">
                        <img src="{{ ($setting['about_section_1_img']!='null') ? upload_url($setting['about_section_1_img']) :  public_url('admin/themes/images/no-image.png')}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cybersecurity-content">
                        <h2>{{$setting['about_section_1_title_'.$lang]}}</h2>
                        <p>{{$setting['about_section_1_desc_'.$lang]}}</p>
                        <div class="row">
                            @foreach( $decodeCheck as $chunk)
                            <div class="col-lg-6 col-sm-6">
                                <ul class="cybersecurity-item">
                                    @foreach($chunk as $c)
                                    <li>
                                        <i class="fas fa-check"></i>
                                        {{$c}}
                                    </li>
                                    @endforeach


                                </ul>
                            </div>
                            @endforeach



                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

    <section class="electronic-area bg-color ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="electronic-content">
                        <h2>{{$setting['about_section_2_title_'.$lang]}}</h2>
                        <div class="electronic-tab-wrap">
                            <div class="tab electronic-tab">
                                <ul class="tabs active">
                                    @foreach($pageList as $key=>$d)
                                    <li class="{{($key==0) ? 'current' : ''}}">
                                        <a href="#">
                                            {{$d->name}}
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                                <div class="tab_content">
                                    @foreach($pageList as $key=> $d)
                                    <div class="tabs_item" style="{{($key!=0) ? 'display:none ' : ''}}">
                                        {!!$d->content!!}
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="electronic-img">
                        <img src="{{ ($setting['about_section_2_img']!='null') ? upload_url($setting['about_section_2_img']) :  public_url('admin/themes/images/no-image.png')}}"
                             alt="{{$setting['about_section_2_title_'.$lang]}}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="complete-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pl-0">
                    <div class="complete-img">
                        <img src="{{ ($setting['about_section_3_img']!='null') ? upload_url($setting['about_section_3_img']) :  public_url('admin/themes/images/no-image.png')}}"
                             alt="{{$setting['about_section_3_title_'.$lang]}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="complete-content">
                        <h2>{{$setting['about_section_3_title_'.$lang]}}</h2>
                        <p>{{$setting['about_section_3_desc_'.$lang]}}</p>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-security">
                                    <i class="fa fa-check"></i>
                                    <h3>{{$setting['about_section_box_title_1_'.$lang]}}</h3>
                                    <p>{{$setting['about_section_box_content_1_'.$lang]}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-security">
                                    <i class="fa fa-check"></i>
                                    <h3>{{$setting['about_section_box_title_2_'.$lang]}}</h3>
                                    <p>{{$setting['about_section_box_content_2_'.$lang]}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-security mb-0 mb-rs-need">
                                    <i class="fa fa-check"></i>
                                    <h3>{{$setting['about_section_box_title_3_'.$lang]}}</h3>
                                    <p>{{$setting['about_section_box_content_3_'.$lang]}}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-security mb-0">
                                    <i class="fa fa-check"></i>
                                    <h3>{{$setting['about_section_box_title_4_'.$lang]}}</h3>
                                    <p>{{$setting['about_section_box_content_4_'.$lang]}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>



    @endsection
