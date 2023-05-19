@php
    $listRoute = [
        'wadmin::category.index.get', 'wadmin::post.category.get', 'wadmin::category.edit.get'
    ];
    $indexRoute = ['wadmin::category.index.get'];
    $createRoute = ['wadmin::category.create.get'];

@endphp

<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-check-square"></i> <span>Bài viết</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::category.index.get')}}">Danh sách bài viết</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::category.create.get')}}">Thêm mới</a></li>
        <li class=""><a href="">Danh mục</a></li>
    </ul>
</li>
