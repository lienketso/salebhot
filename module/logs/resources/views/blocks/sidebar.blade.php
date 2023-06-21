@php
    $listRoute = [
        'wadmin::logs.index.get',
    ];
    $indexRoute = [
         'wadmin::logs.index.get'
    ];

@endphp

@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','logs_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-history"></i> <span>Logs</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::logs.index.get')}}">Hành động các tài khoản</a>
            </li>
            <li class="#">
                <a href="#">Hành động khách hàng</a>
            </li>

        </ul>
    </li>
@endif
