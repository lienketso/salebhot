@php
    $listRoute = [
        'wadmin::sales.index.get',
        'wadmin::sales.revenue.get',
        'wadmin::sales.success.get',
        'wadmin::transaction.accept.get'
    ];
    $indexRoute = ['wadmin::sales.index.get'];
    $successRoute = ['wadmin::sales.success.get',];
    $acceptRoute = ['wadmin::transaction.accept.get'];
    $revenueRoute = ['wadmin::sales.revenue.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    use Transaction\Models\Transaction;

    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countNPP = \Company\Models\Company::where('c_type','distributor')->where('sale_admin',$userLog->id)->count();
    $countOrderSale = Transaction::where('sale_admin',$userLog->id)
    ->where('order_status','!=','active')->where('order_status','!=','cancel')->where('order_status','!=','refunded')->count();
@endphp
@if ($permissions->contains('name','sales_module'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-sitemap"></i> <span>Dành cho sale</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::sales.index.get')}}"><span class="badge pull-right">{{$countNPP}}</span> Danh sách đại lý</a></li>
        <li class="{{in_array(Route::currentRouteName(), $acceptRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::transaction.accept.get')}}"><span class="badge pull-right">{{$countOrderSale}}</span> Đơn hàng cần duyệt</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $successRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::sales.success.get')}}">Đơn hàng thành công</a></li>
        <li class="{{in_array(Route::currentRouteName(), $revenueRoute) ? 'active' : '' }}"><a href="{{route('wadmin::sales.revenue.get')}}">Doanh thu</a></li>
    </ul>
</li>
@endif
