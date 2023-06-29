@php
    $listRoute = [
        'wadmin::wallet.index.get','wadmin::wallet.history.get','wadmin::wallet.withdraw.get','wadmin::wallet.accept.get'
    ];
    $indexRoute = [
         'wadmin::wallet.index.get'
    ];
    $historyRoute = [
         'wadmin::wallet.history.get'
    ];
    $withdrawRoute = [
         'wadmin::wallet.withdraw.get'
    ];
    $withdrawDoneRoute = [
         'wadmin::wallet.accept.get'
    ];

@endphp

@php
    use Illuminate\Support\Facades\Auth;
    use Transaction\Models\Transaction;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','wallets_index'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-credit-card"></i> <span>Wallet</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::wallet.index.get')}}">Quản lý ví</a></li>
            <li class="{{in_array(Route::currentRouteName(), $historyRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::wallet.history.get')}}">Danh sách giao dịch</a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $withdrawRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::wallet.withdraw.get')}}">Yêu cầu rút tiền <span class="badge pull-right">{{$countWithdraw}}</span></a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $withdrawDoneRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::wallet.accept.get')}}">Yêu cầu đã duyệt</a>
            </li>
        </ul>
    </li>
@endif
