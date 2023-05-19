<div class="sidebar sidebar-right">

    @if($videoHome && count($videoHome))
        <div class="widget">
            <h3 class="block-title"><span>{{$setting['keyword_4_'.$lang]}}</span></h3>
            <div class="video-tab clearfix">
                <div class="tab-content">
                    @foreach($videoHome as $key=>$p)
                        <div class="tab-pane {{($key==0) ? 'active' : ''}} animated fadeIn" id="video{{$p->id}}">
                            <div class="clearfix">
                                <div class="post-thumb">
                                    <img class="img-fluid"
                                         src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png') }}"
                                         alt="{{$p->name}}" />
                                    <a class="popup" href="{{$p->description}}?autoplay=1&amp;loop=1">
                                        <div class="video-icon">
                                            <i class="fa fa-play"></i>
                                        </div>
                                    </a>
                                </div><!-- Post thumb end -->
                                <div class="post-content-video">
                                    <h2 class="post-title-video">
                                        <a href="#">{{$p->name}}</a>
                                    </h2>
                                </div><!-- Post content end -->
                            </div><!-- Post Overaly Article end -->
                        </div><!--Tab pane 1 end-->
                    @endforeach

                </div><!-- Tab content end -->
            </div>

            <div class="list-video-home">
                <ul class="nav nav-tabs-s">
                    @foreach($videoHome as $key=>$p)
                        <li class="nav-item ">
                            <a class="post-thumb-link {{($key==0) ? 'active' : ''}} animated fadeIn" href="#video{{$p->id}}" data-toggle="tab">
                                <div class="post-thumb-video">
                                    <img class="img-fluid"
                                         src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png') }}"
                                         alt="{{$p->name}}" />
                                </div><!-- Post thumb end -->
                                <h3>{{$p->name}}</h3>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    @if($banner && count($banner))
        <div class="widget color-default">
            <h3 class="block-title"><span>{{$setting['keyword_5_'.$lang]}}</span></h3>

            @foreach($banner as $p)
                <div class="item-ads text-center">
                    <a href="{{$p->link}}">
                        <img class="img-fluid" src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png') }}"
                             alt="{{$p->name}}" />
                    </a>
                </div>
            @endforeach
        </div><!-- Popular news widget end -->

    @endif

</div><!-- Sidebar right end -->
