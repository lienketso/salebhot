@php
    $listRoute = [
        'wadmin::company.index.get', 'wadmin::company.create.get', 'wadmin::company.edit.get','wadmin::company.index.get','wadmin::company.create.get',
        'wadmin::company.edit.get','wadmin::company.status.get'
    ];
    $indexRoute = ['wadmin::company.index.get'];
    $createRoute = ['wadmin::company.create.get'];
    $statusRoute = ['wadmin::company.status.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','company_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-smile-o"></i> <span>Quản lý NPP</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::company.index.get')}}">Danh sách NPP</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}"><a href="{{route('wadmin::company.create.get')}}">Thêm mới</a></li>
        <li class="{{in_array(Route::currentRouteName(), $statusRoute) ? 'active' : '' }}">
            <span class="badge pull-right">{{$countComPending}}</span> <a href="{{route('wadmin::company.status.get')}}">Duyệt NPP</a>
        </li>
    </ul>
</li>
@endif
