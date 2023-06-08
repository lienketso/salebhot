@php
    $listRoute = [
        'wadmin::transaction.index.get',
        'wadmin::transaction.edit.get',
        'wadmin::transaction.accept.get',
    ];
    $indexRoute = [
         'wadmin::transaction.index.get'
    ];
    $createRoute = ['wadmin::transaction.create.get','wadmin::transaction.edit.get'];
    $acceptRoute = ['wadmin::transaction.accept.get'];
@endphp

@php
    use Illuminate\Support\Facades\Auth;
    use Transaction\Models\Transaction;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countOrderSale = Transaction::where('sale_admin',$userLog->id)->where('order_status','!=','active')->count();
@endphp
@if ($permissions->contains('name','transaction_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-cart-plus"></i> <span>Đơn hàng</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::transaction.index.get')}}">Tất cả đơn hàng</a></li>
            <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::transaction.create.get')}}">Thêm đơn hàng mới</a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $acceptRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::transaction.accept.get')}}"><span class="badge pull-right">{{$countOrderSale}}</span> Đơn hàng cần duyệt</a>
            </li>
        </ul>
    </li>
@endif
