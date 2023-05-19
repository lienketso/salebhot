<div class="col-md-6">
    <div class="post-block-style post-grid clearfix">
        <div class="post-thumb">
            <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                <img class="img-fluid"
                     src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                     alt="{{$d->name}}">
            </a>
        </div>
        <a class="post-cat" href="{{route('frontend::blog.index.get',$d->categorys->slug)}}">{{$d->categorys->name}}</a>
        <div class="post-content">
            <h2 class="post-title title-large title-product">
                <a href="{{route('frontend::blog.detail.get',$d->slug)}}">{{$d->name}}</a>
            </h2>
        </div><!-- Post content end -->
    </div><!-- Post Block style end -->
</div>
