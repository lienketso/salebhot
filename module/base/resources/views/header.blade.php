<div class="headerpanel">

    <div class="logopanel">
        <h2><a href="{{route('wadmin::dashboard.index.get')}}">Baohiemoto</a></h2>
    </div><!-- logopanel -->

    <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

        <div class="searchpanel">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
          </span>
            </div><!-- input-group -->
        </div>

        <div class="header-right">
            <ul class="headermenu">

{{--                <li>--}}
{{--                    <div class="btn-group">--}}
{{--                        <button type="button" class="btn btn-logged" data-toggle="dropdown">--}}
{{--                            <img src="{{public_url('admin/themes/images/').session()->get('lang')}}.svg" width="40" />--}}
{{--                            {{(session()->get('lang')=='vn') ? 'Tiếng Việt' : 'English'}}--}}
{{--                            <span class="caret"></span>--}}
{{--                        </button>--}}
{{--                        <ul class="dropdown-menu pull-right">--}}
{{--                            <li><a href="{{route('dashboard.lang',['lang'=>'vn'])}}"><img src="{{public_url('admin/themes/images/vn.svg')}}" width="20" /> Tiếng Việt</a></li>--}}
{{--                            <li><a href="{{route('dashboard.lang',['lang'=>'en'])}}"><img src="{{public_url('admin/themes/images/en.svg')}}" width="20" /> English</a></li>--}}
{{--                            <li><a href="{{route('dashboard.lang',['lang'=>'ch'])}}"><img src="{{public_url('admin/themes/images/zh.png')}}" width="20" /> Tiếng Trung</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li>
                    <button id="chatview" class="btn btn-chat alert-notice">
                        <span class="badge-alert"></span>
                    </button>
                </li>
            </ul>
        </div><!-- header-right -->
    </div><!-- headerbar -->
</div><!-- header-->
