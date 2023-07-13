@php
    $listRoute = [
        'wadmin::sales.index.get',
        'wadmin::director.expert.get',
        'wadmin::director.revenue.get'
    ];
    $indexRoute = ['wadmin::sales.index.get'];
    $expertRoute = ['wadmin::director.expert.get',];
    $revenueRoute = ['wadmin::director.revenue.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countNPP = \Company\Models\Company::where('c_type','distributor')->where('sale_admin',$userLog->id)->count();
@endphp
@if ($permissions->contains('name','sales_module'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-sitemap"></i> <span>Dành cho sale</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::sales.index.get')}}"><span class="badge pull-right">{{$countNPP}}</span> Danh sách đại lý</a></li>
        <li class="">
            <a href="#">Đơn hàng thành công</a></li>
        <li class="#"><a href="{{route('wadmin::director.revenue.get')}}">Doanh thu</a></li>
    </ul>
</li>
@endif
