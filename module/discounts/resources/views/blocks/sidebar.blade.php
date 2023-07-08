@php
    $listRoute = [
        'wadmin::discounts.index.get', 'wadmin::discounts.create.get', 'wadmin::discounts.edit.get'
    ];
    $indexRoute = ['wadmin::discounts.index.get'];
    $createRoute = ['wadmin::discounts.create.get'];
@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','discounts_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-subscript"></i> <span>Quản lý chiết khấu</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::discounts.index.get')}}">Danh sách chiết khấu</a></li>
            <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::discounts.create.get')}}">Thêm mới</a></li>
        </ul>
    </li>
@endif
