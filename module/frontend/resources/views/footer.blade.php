<footer id="footer" class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12 footer-widget">
                    <h3 class="widget-title">{{$setting['keyword_6_'.$lang]}}</h3>
                    <div class="info-footer-text">
                        {!! $setting['banner_factory_'.$lang] !!}
                    </div><!-- List post block end -->

                </div><!-- Col end -->

                <div class="col-lg-4 col-sm-12 footer-widget widget-categories">
                    <h3 class="widget-title">{{$setting['keyword_7_'.$lang]}}</h3>
                    <div class="info-footer">
                        {!! $setting['site_footer_info_1_'.$lang] !!}
                    </div>

                </div><!-- Col end -->


                <div class="col-lg-4 col-sm-12 footer-widget">
                    <h3 class="widget-title">{{$setting['keyword_8_'.$lang]}}</h3>
                    <ul class="social-icon">
                        <li><a href="{{$setting['site_facebook']}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{$setting['site_twitter']}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{$setting['site_instagram']}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="{{$setting['site_youtube']}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div><!-- Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->


</footer><!-- Footer end -->

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="copyright-info">
                    <span>Copyright © {{date('Y')}} Bản quyền thuộc VNC YDCT Tuệ Tĩnh </span>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                @if($quicklinksFooter && count($quicklinksFooter))
                <div class="footer-menu">
                    <ul class="nav unstyled">
                        @foreach($quicklinksFooter as $d)
                        <li><a href="{{$d->link}}">{{$d->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div><!-- Row end -->

        <div id="back-to-top" class="back-to-top">
            <button class="btn btn-primary" title="Back to Top">
                <i class="fa fa-angle-up"></i>
            </button>
        </div>

    </div><!-- Container end -->
</div><!-- Copyright end -->
