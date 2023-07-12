@php
    $listRoute = [
        'wadmin::director.index.get',
        'wadmin::director.expert.get',
        'wadmin::director.revenue.get'
    ];
    $indexRoute = ['wadmin::director.index.get'];
    $expertRoute = ['wadmin::director.expert.get',];
    $revenueRoute = ['wadmin::director.revenue.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;

@endphp
@if ($permissions->contains('name','director_module'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-sitemap"></i> <span>Giám đốc vùng</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::director.index.get')}}">Danh sách đại lý</a></li>
        <li class="{{in_array(Route::currentRouteName(), $expertRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::director.expert.get')}}"> Danh sách chuyên viên </a></li>
        <li class="{{in_array(Route::currentRouteName(), $revenueRoute) ? 'active' : '' }}"><a href="{{route('wadmin::director.revenue.get')}}">Doanh thu</a></li>
    </ul>
</li>
@endif
