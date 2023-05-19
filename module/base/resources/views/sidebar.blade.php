<div class="leftpanel">
    <div class="leftpanelinner">

        <!-- ################## LEFT PANEL PROFILE ################## -->
        @php
            use Illuminate\Support\Facades\Auth;
            $userLogin = Auth::user();
        @endphp
        <div class="media leftpanel-profile">
            <div class="media-left">
                <a href="#">
                    <img src="{{ ($userLogin->thumbnail!='') ? upload_url($userLogin->thumbnail) : public_url('admin/themes/images/no-image.png')}}" alt="" class="media-object img-circle">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$userLogin->full_name}} <a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
                <span>{{$userLogin->getRole()}}</span>
            </div>
        </div><!-- leftpanel-profile -->

        <div class="leftpanel-userinfo collapse" id="loguserinfo">
            <h5 class="sidebar-title">Địa chỉ</h5>
            <address>
                {{$userLogin->address}}
            </address>
            <h5 class="sidebar-title">Thông tin</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <label class="pull-left">Email</label>
                    <span class="pull-right">{{$userLogin->email}}</span>
                </li>
                <li class="list-group-item">
                    <label class="pull-left">Điện thoại</label>
                    <span class="pull-right">{{$userLogin->phone}}</span>
                </li>

                <li class="list-group-item">
                    <label class="pull-left">Mạng xã hội</label>
                    <div class="social-icons pull-right">
                        <a href="#"><i class="fa fa-facebook-official"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </li>
                <li class="list-group-item">
                    <a href="{{route('wadmin::users.profile.get',$userLogin->id)}}">Cập nhật thông tin</a>
                </li>
            </ul>
        </div><!-- leftpanel-userinfo -->
        @php
            $dashboardRoute = ['wadmin::dashboard.index.get'];
            $settingRoute = ['wadmin::setting.index.get'];
        @endphp
        <ul class="nav nav-tabs nav-justified nav-sidebar">
            <li class="tooltips active" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
            <li class="tooltips" data-toggle="tooltip" title="Liên hệ"><a data-toggle="tab" data-target="#contactmenu"><i class="tooltips fa fa-envelope"></i></a></li>
            <li class="tooltips" data-toggle="tooltip" title="Cấu hình">
                <a data-toggle="tab" data-target="#settings"><i class="fa fa-cog"></i></a></li>
            <li class="tooltips" data-toggle="tooltip" title="Log Out"><a href="{{ route('wadmin::auth.logout.get') }}"><i class="fa fa-sign-out"></i></a></li>
        </ul>

        <div class="tab-content">

            <!-- ################# MAIN MENU ################### -->

            <div class="tab-pane active" id="mainmenu">
                <h5 class="sidebar-title">Chức năng phổ biến</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk">
                    <li class="{{in_array(Route::currentRouteName(), $dashboardRoute) ? 'active' : '' }}">
                        <a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                </ul>

                <h5 class="sidebar-title">Main Menu</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk">
                    @php do_action('wadmin-register-menu') @endphp

                </ul>
            </div><!-- tab-pane -->


            <!-- ################### CONTACT LIST ################### -->

            <div class="tab-pane" id="contactmenu">
                <div class="input-group input-search-contact">
                    <input type="text" class="form-control" placeholder="Tìm liên hệ">
                    <span class="input-group-btn">
              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
            </span>
                </div>
                @php

                    @endphp
                <h5 class="sidebar-title">Danh sách liên hệ</h5>
                <ul class="media-list media-list-contacts">
                    @include('wadmin-contact::blocks.list')
                </ul>
            </div><!-- tab-pane -->

            <!-- #################### SETTINGS ################### -->

            <div class="tab-pane" id="settings">
                <h5 class="sidebar-title">Cấu hình chung</h5>
                <ul class="list-group list-group-settings">
                    <li class="list-group-item">
                        <h5><a href="{{route('wadmin::setting.index.get')}}">Thông tin website</a></h5>
                        <small>Chỉnh sửa các thông tin trên website (Hotline, địa chỉ, email...)</small>
                    </li>

                </ul>

            </div><!-- tab-pane -->


        </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->
