@php
    $listRoute = [
        'wadmin::zalozns.index.get','wadmin::zalozns.create.get','wadmin::zalozns.edit.get','wadmin::zalozns.param.index'
    ];
    $indexRoute = [
         'wadmin::zalozns.index.get'
    ];
    $createRoute = [
         'wadmin::zalozns.create.get'
    ];
    $editRoute = [
         'wadmin::zalozns.edit.get'
    ];


@endphp

@php
    use Illuminate\Support\Facades\Auth;
    use Wallets\Models\WalletTransaction;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countTransfer = WalletTransaction::where('status','transferred')->count();
@endphp
@if ($permissions->contains('name','wallets_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-meh-o"></i> <span>Zalo template</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::zalozns.index.get')}}">Zalo ZNS template</a></li>
            <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::zalozns.create.get')}}">Thêm mới</a>
            </li>

        </ul>
    </li>
@endif
