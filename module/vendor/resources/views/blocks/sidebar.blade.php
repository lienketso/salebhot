@php
    $listRoute = [
        'wadmin::vendor.index.get', 'wadmin::vendor.create.get', 'wadmin::vendor.edit.get'
    ];
    $indexRoute = ['wadmin::vendor.index.get'];
    $createRoute = ['wadmin::vendor.create.get'];
@endphp

<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-user-secret"></i> <span>Sản phẩm nhà máy</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::vendor.index.get')}}">Danh sách sản phẩm</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::vendor.create.get')}}">Thêm mới</a></li>
    </ul>
</li>
