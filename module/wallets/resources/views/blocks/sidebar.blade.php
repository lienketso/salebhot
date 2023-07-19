@php
    $listRoute = [
        'wadmin::wallet.index.get','wadmin::wallet.history.get',
        'wadmin::wallet.withdraw.get','wadmin::wallet.accept.get',
        'wadmin::wallet.list-refund.get','wadmin::wallet.refund.get',
        'wadmin::admin-confirm-success.get','wadmin::list-completed-bank.get'
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
         'wadmin::wallet.accept.get','wadmin::wallet.refund.get'
    ];
    $withdrawRefunded = [
         'wadmin::wallet.list-refund.get'
    ];
    $successBank = [
         'wadmin::admin-confirm-success.get'
    ];
    $completedBank = [
         'wadmin::list-completed-bank.get'
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
        <a href="" ><i class="fa fa-credit-card"></i> <span>Wallet</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}"><a href="{{route('wadmin::wallet.index.get')}}">Quản lý ví</a></li>
            <li class="{{in_array(Route::currentRouteName(), $withdrawRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::wallet.withdraw.get')}}">Admin Xác nhận đi tiền <span class="badge pull-right">{{$countWithdraw}}</span></a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $successBank) ? 'active' : '' }}">
                <a href="{{route('wadmin::admin-confirm-success.get')}}">Admin Xác nhận đã ck <span class="badge pull-right">{{$countTransfer}}</span></a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $completedBank) ? 'active' : '' }}">
                <a href="{{route('wadmin::list-completed-bank.get')}}">Danh sách hoàn thành</a>
            </li>
{{--            <li class="{{in_array(Route::currentRouteName(), $withdrawRefunded) ? 'active' : '' }}">--}}
{{--                <a href="{{route('wadmin::wallet.list-refund.get')}}">Đã hoàn tiền</a>--}}
{{--            </li>--}}
            <li class="{{in_array(Route::currentRouteName(), $historyRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::wallet.history.get')}}">Danh sách giao dịch</a>
            </li>
        </ul>
    </li>
@endif
