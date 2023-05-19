<div class="trending-bar d-md-block d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="trending-title">{{$setting['keyword_2_'.$lang]}}</h3>
                <div id="trending-slide" class="owl-carousel owl-theme trending-slide">
                    @if(!empty($thongbao) || count($thongbao))
                        @foreach($thongbao as $p)
                    <div class="item">
                        <div class="post-content">
                            <h2 class="post-title title-small">
                                <a href="{{route('frontend::page.index.get',$p->slug)}}">{{$p->name}}</a>
                            </h2>
                        </div><!-- Post content end -->
                    </div><!-- Item 1 end -->
                        @endforeach
                    @endif

                </div><!-- Carousel end -->
            </div><!-- Col end -->
        </div><!--/ Row end -->
    </div><!--/ Container end -->
</div><!--/ Trending end -->

<div id="top-bar" class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="ts-date">
                    <i class="fa fa-calendar-check-o"></i>{{sw_get_current_weekday()}}
                </div>
                <ul class="unstyled top-nav">
                    @if($quicklinks)
                        @foreach($quicklinks as $d)
                    <li><a href="{{$d->link}}" target="{{$d->target}}">{{$d->name}}</a></li>
                        @endforeach
                    @endif

                </ul>
            </div><!--/ Top bar left end -->

            <div class="col-md-4 top-social text-lg-right text-md-center">
                <ul class="unstyled language-top">
                    <span class="global-icon"><i class="fa fa-globe"></i></span>
                    <li>
                        <a title="Tiếng Việt" href="{{route('frontend::lang','vn')}}">
                            <span class="social-icon">VN</span>
                        </a>
                        <a title="Tiếng Anh" href="{{route('frontend::lang','en')}}">
                            <span class="social-icon">EN</span>
                        </a>
                        <a title="中国" href="{{route('frontend::lang','ch')}}">
                            <span class="social-icon">CH</span>
                        </a>

                    </li>
                </ul><!-- Ul end -->
            </div><!--/ Top social col end -->
        </div><!--/ Content row end -->
    </div><!--/ Container end -->
</div><!--/ Topbar end -->

<!-- Header start -->
<header id="header" class="header-fix">
    <div class="container">
        <div class="row align-item-center">
            <div class="col-md-2 col-sm-12">
                <div class="logo-header">
                    <a href="{{route('frontend::home')}}">
                        <img src="{{ ($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/images/logos/logo.png')}}"
                             alt="Logo viện nghiên cứu y dược tuệ tĩnh">
                    </a>
                </div>
            </div><!-- logo col end -->

            <div class="col-md-10 col-sm-12">
                <div class="ad-banner">
                    {!! $setting['site_top_name_'.$lang] !!}
                </div>
            </div><!-- header right end -->
        </div><!-- Row end -->
    </div><!-- Logo and banner area end -->
</header><!--/ Header end -->

<div class="main-nav clearfix">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg col">
                <div class="site-nav-inner float-left">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- End of Navbar toggler -->

                    <div id="navbarSupportedContent" class="collapse navbar-collapse navbar-responsive-collapse">
                        @include('frontend::blocks.menu')

                    </div><!--/ Collapse end -->

                </div><!-- Site Navbar inner end -->
            </nav><!--/ Navigation end -->

            <div class="nav-search">
                <span id="search"><i class="fa fa-search"></i></span>
            </div><!-- Search end -->

            <div class="search-block" style="display: none;">
                <input type="text" class="form-control" placeholder="{{$setting['keyword_1_'.$lang]}}">
                <span class="search-close">&times;</span>
            </div><!-- Site search end -->

        </div><!--/ Row end -->
    </div><!--/ Container end -->

</div><!-- Menu wrapper end -->
