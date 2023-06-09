@php
    $listRoute = [
        'wadmin::reports.distributor.get', 'wadmin::reports.experts.get', 'wadmin::reports.director.get','wadmin::reports.total.distributor',
        'wadmin::reports.total.sale-distributor'
    ];
    $indexRoute = ['wadmin::reports.distributor.get'];
    $createRoute = ['wadmin::reports.experts.get'];
    $directorRoute = ['wadmin::reports.director.get'];
    $totalDRoute = ['wadmin::reports.total.distributor'];
    $totalSaleDRoute = ['wadmin::reports.total.sale-distributor'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','report_distributor'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-bar-chart-o"></i> <span>Báo cáo</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $directorRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::reports.director.get')}}">Báo cáo giám đốc vùng</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::reports.experts.get')}}">Báo cáo chuyên viên</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::reports.distributor.get')}}">Báo cáo nhà phân phối</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $totalDRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::reports.total.distributor')}}">Tổng hợp nhà phân phối</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $totalSaleDRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::reports.total.sale-distributor')}}">NPP cho sales</a>
        </li>
    </ul>
</li>
    @endif
