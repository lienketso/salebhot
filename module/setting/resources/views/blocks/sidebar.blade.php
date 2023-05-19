@php
    $listRoute = [
        'wadmin::setting.index.get', 'wadmin::setting.fact.get', 'wadmin::setting.keyword.get','wadmin::setting.about.get'
    ];
    $indexRoute = ['wadmin::setting.index.get'];
    $AboutRoute = ['wadmin::setting.about.get'];
    $factRoute = ['wadmin::setting.fact.get'];
    $keywordRoute = ['wadmin::setting.keyword.get'];
    $LinkRoute = ['wadmin::link.index.get'];
@endphp

@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','setting_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-gears"></i> <span>Cấu hình</span></a>
    <ul class="children">
{{--        <li class="{{in_array(Route::currentRouteName(), $AboutRoute) ? 'active' : '' }}"><a href="{{route('wadmin::setting.about.get')}}">Trang giới thiệu</a></li>--}}
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::setting.index.get')}}">Cấu hình chung</a></li>
{{--        <li class="{{in_array(Route::currentRouteName(), $LinkRoute) ? 'active' : '' }}"><a href="{{route('wadmin::link.index.get')}}">Link nhanh</a></li>--}}
{{--        <li class="{{in_array(Route::currentRouteName(), $LinkRoute) ? 'active' : '' }}"><a href="{{route('wadmin::search.index.get')}}">Form tìm kiếm</a></li>--}}
{{--        <li class="{{in_array(Route::currentRouteName(), $keywordRoute) ? 'active' : '' }}"><a href="{{route('wadmin::setting.keyword.get')}}">Từ khóa trên trang</a></li>--}}
    </ul>
</li>
@endif
