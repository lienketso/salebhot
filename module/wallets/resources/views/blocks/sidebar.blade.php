@php
    $listRoute = [
        'wadmin::wallet.index.get'
    ];
    $indexRoute = [
         'wadmin::wallet.index.get'
    ];

@endphp

@php
    use Illuminate\Support\Facades\Auth;
    use Transaction\Models\Transaction;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','transaction_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-credit-card"></i> <span>Wallet</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::wallet.index.get')}}">Quản lý ví</a></li>
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
                <a href="#">Danh sách giao dịch</a>
            </li>

        </ul>
    </li>
@endif
