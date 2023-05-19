<div class="list-hot-cathome">
    <div class="post-overaly-style clearfix">
        <div class="post-thumb">
            <a href="{{route('frontend::blog.detail.get',$p->slug)}}">
                <img class="img-fluid" src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png') }}" alt="">
            </a>
        </div>

        <div class="post-content">
            <a class="post-cat" href="{{route('frontend::blog.index.get',$p->categorys->slug)}}">{{$p->categorys->name}}</a>
            <h2 class="post-title">
                <a href="{{route('frontend::blog.detail.get',$p->slug)}}">{{$p->name}}</a>
            </h2>
            <div class="post-meta">
                <span class="post-date">{{format_date($p->created_at)}}</span>
            </div>
        </div><!-- Post content end -->
    </div><!-- Post Overaly Article end -->
</div>

