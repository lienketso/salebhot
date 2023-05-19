
        <li class="clearfix">
            <div class="post-block-style post-float clearfix">
                <div class="post-thumb">
                    <a href="{{route('frontend::blog.detail.get',$p->slug)}}">
                        <img class="img-fluid" src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png') }}" alt="">
                    </a>
                    <a class="post-cat" href="{{route('frontend::blog.index.get',$p->categorys->slug)}}">{{$p->categorys->name}}</a>
                </div><!-- Post thumb end -->

                <div class="post-content">
                    <h2 class="post-title title-small">
                        <a href="{{route('frontend::blog.detail.get',$p->slug)}}">{{$p->name}} </a>
                    </h2>
                </div><!-- Post content end -->
            </div><!-- Post block style end -->
        </li><!-- Li 1 end -->


