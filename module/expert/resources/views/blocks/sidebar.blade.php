@php
    $listRoute = [
        'wadmin::expert.index.get',
        'wadmin::expert.pending.get',
        'wadmin::expert.create.get',
        'wadmin::expert.edit.get',
        'wadmin::expert.revenue.get'
    ];
    $indexRoute = ['wadmin::expert.index.get'];
    $pendingRoute = ['wadmin::expert.pending.get'];
    $createRoute = ['wadmin::expert.create.get'];
    $revenueRoute = ['wadmin::expert.revenue.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countDisable= $userLog->getCompanyCV()->count();

@endphp
@if ($permissions->contains('name','expert_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-smile-o"></i> <span>Dành cho chuyên viên</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::expert.index.get')}}">NPP đã được duyệt</a></li>
        <li class="{{in_array(Route::currentRouteName(), $pendingRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::expert.pending.get')}}"><span class="badge pull-right">{{$countDisable}}</span> NPP chưa duyệt </a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::expert.create.get')}}">Thêm mới NPP</a></li>
        <li class="{{in_array(Route::currentRouteName(), $revenueRoute) ? 'active' : '' }}"><a href="{{route('wadmin::expert.revenue.get')}}">Doanh số</a></li>
    </ul>
</li>
@endif
