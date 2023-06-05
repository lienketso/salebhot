@php
    $listRoute = [
        'wadmin::commission.index.get', 'wadmin::commission.create.get', 'wadmin::commission.edit.get'
    ];
    $indexRoute = ['wadmin::commission.index.get'];
    $createRoute = ['wadmin::commission.create.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','commission_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-bar-chart-o"></i> <span>Báo cáo</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::commission.index.get')}}">Báo cáo giám đốc vùng</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::commission.create.get')}}">Báo cáo chuyên viên</a>
        </li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::commission.create.get')}}">Báo cáo nhà phân phối</a>
        </li>
    </ul>
</li>
    @endif
