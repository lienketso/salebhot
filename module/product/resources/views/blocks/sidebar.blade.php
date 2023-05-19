@php
    $listRoute = [
        'wadmin::product.index.get',
        'wadmin::product.create.get',
        'wadmin::product.edit.get',
        'wadmin::cat.create.get',
        'wadmin::cat.index.get',
        'wadmin::cat.edit.get',
        'wadmin::factory.create.get',
        'wadmin::factory.index.get',
        'wadmin::factory.edit.get'
    ];
    $indexRoute = ['wadmin::product.index.get'];
    $createRoute = ['wadmin::product.create.get'];
    $catRoute = ['wadmin::cat.create.get','wadmin::cat.index.get','wadmin::cat.edit.get'];
    $FacRoute = ['wadmin::factory.create.get','wadmin::factory.index.get','wadmin::factory.edit.get'];
@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','product_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-cubes"></i> <span>Sản phẩm</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::product.index.get')}}">Danh sách sản phẩm</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::product.create.get')}}">Thêm mới</a></li>
        <li class="{{in_array(Route::currentRouteName(), $catRoute) ? 'active' : '' }}"><a href="{{route('wadmin::cat.index.get')}}">Danh mục</a></li>
        <li class="{{in_array(Route::currentRouteName(), $FacRoute) ? 'active' : '' }}"><a href="{{route('wadmin::factory.index.get')}}">Quản lý hãng BH</a></li>
    </ul>
</li>
@endif
