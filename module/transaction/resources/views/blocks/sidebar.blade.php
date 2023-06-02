@php
    $listRoute = [
        'wadmin::transaction.index.get',
        'wadmin::transaction.edit.get'
    ];
    $indexRoute = [
         'wadmin::transaction.index.get'
    ];
    $createRoute = ['wadmin::transaction.create.get','wadmin::transaction.edit.get'];
@endphp

@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','transaction_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-cart-plus"></i> <span>Đơn hàng</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::transaction.index.get')}}">Tất cả đơn hàng</a></li>
            <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::transaction.create.get')}}">Thêm đơn hàng mới</a></li>
        </ul>
    </li>
@endif
