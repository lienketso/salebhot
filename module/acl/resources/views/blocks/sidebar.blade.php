@php
    $listRoute = [
        'wadmin::role.index.get', 'wadmin::role.create.get', 'wadmin::role.edit.get','wadmin::permission.index.get','wadmin::permission.create.get','wadmin::permission.edit.get',
    ];
    $roleRoute = ['wadmin::role.index.get','wadmin::role.create.get','wadmin::role.edit.get'];
    $permissionRoute = ['wadmin::permission.index.get','wadmin::permission.create.get','wadmin::permission.edit.get'];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','role_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-user-secret"></i> <span>Phân quyền </span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $roleRoute) ? 'active' : '' }}"><a href="{{route('wadmin::role.index.get')}}">Role</a></li>
{{--        <li class="{{in_array(Route::currentRouteName(), $permissionRoute) ? 'active' : '' }}"><a href="{{route('wadmin::permission.index.get')}}">Permissions</a></li>--}}
    </ul>
</li>
    @endif
