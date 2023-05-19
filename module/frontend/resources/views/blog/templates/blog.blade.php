<div class="post-block-style post-list clearfix">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="post-thumb thumb-float-style">
                <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                    <img class="img-fluid"
                         src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                         alt="{{$d->name}}" />
                </a>
                <a class="post-cat" href="{{route('frontend::blog.index.get',$d->categorys->slug)}}">{{$d->categorys->name}}</a>
            </div>
        </div><!-- Img thumb col end -->

        <div class="col-lg-8 col-md-6">
            <div class="post-content">
                <h2 class="post-title title-large">
                    <a href="{{route('frontend::blog.detail.get',$d->slug)}}">{{$d->name}}</a>
                </h2>
                <div class="post-meta">
                    <span class="post-author"><a href="#">{{$d->getUserPost->full_name}}</a></span>
                    <span class="post-date">{{format_date($d->created_at)}}</span>
                    <span class="post-comment pull-right"><i class="fa fa-comments-o"></i>
											<a href="#" class="comments-link"><span>{{$d->count_view}}</span></a></span>
                </div>
                <p>{{cut_string($d->description,300)}}</p>
                <a class="blog-more" href="{{route('frontend::blog.detail.get',$d->slug)}}">{{$setting['keyword_10_'.$lang]}} <i class="fa fa-angle-double-right"></i></a>
            </div><!-- Post content end -->
        </div><!-- Post col end -->
    </div><!-- 1st row end -->
</div><!-- 1st Post list end -->
