@extends('frontend::master')
@section('js')
    <script type="text/javascript" src="{{asset('admin/themes/lib/jquery-ui/jquery-ui.js')}}"></script>
@endsection
@section('js-init')
   <script type="text/javascript">
       //tooger search
       $(document).ready(function(){
           $('#FormSearchCat').hide();
           $(".btnViewSearch").click(function(){
               $("#FormSearchCat").toggle();
           });
       });
   </script>
@endsection
@section('content')

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                        @if(!empty($data->parents) && !is_null($data->parents))
                        <li><a href="{{route('frontend::blog.index.get',$data->parents->slug)}}">{{$data->parents->name}}</a></li>
                        @endif

                        <li>{{$data->name}}</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->


    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="block category-listing category-style2">
                        <h3 class="block-title">
                            <span>{{$data->name}}</span>
                            @if(!empty($formSearch))
                            <a href="{{route('frontend::blog.index.get',$data->slug)}}" class="btnReset"><i class="fa fa-refresh"></i> {{($lang=='vn') ? 'Làm lại' : 'Reset'}}</a>
                            <a class="btnViewSearch" href="javascript:void()"><i class="fa fa-filter"></i> {{($lang=='vn') ? 'Lọc bài viết' : 'Filter'}}</a>
                            @endif
                        </h3>

                        @if(count($data->childs))
                        <ul class="subCategory unstyled">
                            @foreach($data->childs as $child)
                                <li><a href="{{route('frontend::blog.index.get',$child->slug)}}"><i class="fa fa-folder-open-o"></i> {{$child->name}}</a></li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="form-search-cat" id="FormSearchCat">
                            @if($formSearch && !empty($formSearch))
                                @include('frontend::form.'.$formSearch->meta_value)
                            @endif
                        </div>

                            @if($data->type=='blog')
                                @foreach($post as $d)
                                    @include('frontend::blog.templates.blog')
                                @endforeach
                            @endif
                            @if($data->type=='product')
                            <div class="row">
                                @foreach($post as $d)
                                    @include('frontend::blog.templates.product')
                                @endforeach
                            </div>
                            @endif
                            @if($data->type=='file')
                                        <div class="row">
                                            @foreach($post as $d)
                                                <div class="col-lg-6">
                                                @include('frontend::blog.templates.file')
                                                </div>
                                            @endforeach
                                        </div>
                                @endif






                    </div><!-- Block Technology end -->

                    <div class="paging">
                            {{$post->links()}}
                    </div>


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
