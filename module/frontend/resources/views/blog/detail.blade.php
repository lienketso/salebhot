@extends('frontend::master')
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                        @if(!empty($catInfo->parents))
                        <li class="breadcrumb-item"><a href="{{route('frontend::blog.index.get',$catInfo->parents->slug)}}"> {{$catInfo->parents->name}} </a></li>
                        @endif
                        <li class="breadcrumb-item"><a href="{{route('frontend::blog.index.get',$catInfo->slug)}}"> {{$catInfo->name}} </a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->
    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="single-post">

                        <div class="post-title-area">
                            <a class="post-cat" href="{{route('frontend::blog.index.get',$catInfo->slug)}}">{{$catInfo->name}}</a>
                            <h2 class="post-title">
                                {{$data->name}}
                            </h2>
                            @if($data->post_type=='blog')
                            <div class="post-meta">
								<span class="post-author">
									{{$setting['keyword_12_'.$lang]}} : <a href="#">{{$data->user->full_name}}</a>
								</span>
                                <span class="post-date"><i class="fa fa-clock-o"></i> {{format_date($data->created_at)}}</span>
                                <span class="post-hits"><i class="fa fa-eye"></i> {{$data->count_view}}</span>
                            </div>
                                @endif
                        </div><!-- Post title end -->

                        <div class="post-content-area">

                            <div class="entry-content">
                                @if($data->post_type=='blog')
                                    @include('frontend::blog.templates.single-post')
                                @else
                                    @include('frontend::blog.templates.single-product')
                                @endif
                            </div>

                            <!-- Entery content end -->
                            @if(!is_null($data->tags))
                            <div class="tags-area clearfix">
                                <div class="post-tags">
                                    <span>Tags:</span>
                                    {{$data->tags}}
                                </div>
                            </div><!-- Tags end -->
                            @endif

                            <div class="share-items clearfix">
                                <ul class="post-social-icons unstyled">
                                    <li class="facebook">
                                        <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{route('frontend::blog.detail.get',$data->slug)}}">
                                            <i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a>
                                    </li>
                                    <li class="twitter">
                                        <a target="_blank" href="https://twitter.com/intent/tweet?text={{$data->description}}&url={{route('frontend::blog.detail.get',$data->slug)}}&via=Y Dược cổ truyền">
                                            <i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a>
                                    </li>
                                    <li class="gplus">
                                        <a target="_blank" href="https://plus.google.com/share?url={{route('frontend::blog.detail.get',$data->slug)}}">
                                            <i class="fa fa-google-plus"></i> <span class="ts-social-title">Google +</span></a>
                                    </li>
                                    <li class="pinterest">
                                        <a target="_blank" href="https://pinterest.com/pin/create/button/?url={{route('frontend::blog.detail.get',$data->slug)}}&description={{$data->description}}&media={{upload_url($data->thumbnail)}}">
                                            <i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a>
                                    </li>
                                </ul>
                            </div><!-- Share items end -->

                        </div><!-- post-content end -->
                    </div><!-- Single post end -->

                    <nav class="post-navigation clearfix">
                        @if(!empty($prevPost))
                        <div class="post-previous">
                            <a href="{{route('frontend::blog.detail.get',$prevPost->slug)}}">
                                <span><i class="fa fa-angle-left"></i>{{$setting['keyword_14_'.$lang]}}</span>
                                <h3>
                                    {{$prevPost->name}}
                                </h3>
                            </a>
                        </div>
                        @endif
                        @if(!empty($nextPost))
                        <div class="post-next">
                            <a href="{{route('frontend::blog.detail.get',$nextPost->slug)}}">
                                <span>{{$setting['keyword_15_'.$lang]}} <i class="fa fa-angle-right"></i></span>
                                <h3>
                                    {{$nextPost->name}}
                                </h3>
                            </a>
                        </div>
                            @endif
                    </nav><!-- Post navigation end -->

                    @if(!empty($related) && count($related))

                    <div class="related-posts block">
                        <h3 class="block-title"><span>{{$setting['keyword_13_'.$lang]}}</span></h3>

                        <div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
                            @foreach($related as $p)
                            <div class="item">
                                <div class="post-block-style clearfix">
                                    <div class="post-thumb">
                                        <a href="{{route('frontend::blog.detail.get',$p->slug)}}">
                                            <img class="img-fluid"
                                                 src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                                 alt="{{$p->name}}" />
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <h2 class="post-title title-medium">
                                            <a href="{{route('frontend::blog.detail.get',$p->slug)}}">{{$p->name}}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="post-author"><a href="#">{{$p->user->full_name}}</a></span>
                                            <span class="post-date">{{format_date($p->created_at)}}</span>
                                        </div>
                                    </div><!-- Post content end -->
                                </div><!-- Post Block style end -->
                            </div><!-- Item 1 end -->
                            @endforeach


                        </div><!-- Carousel end -->

                    </div><!-- Related posts end -->
                    @endif


                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-12">
                    @include('frontend::blocks.sidebar')
                    @if($catNewsBlog)
                        <div class="widget color-default">
                            <h3 class="block-title"><span>{{$setting['keyword_11_'.$lang]}} </span></h3>
                            <div class="category-blog">
                                <ul>
                                    @foreach($catNewsBlog as $d)
                                        <li><a href="{{route('frontend::blog.index.get',$d->slug)}}"><i class="fa fa-angle-right"></i> {{$d->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div><!-- Sidebar Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->
    @endsection
