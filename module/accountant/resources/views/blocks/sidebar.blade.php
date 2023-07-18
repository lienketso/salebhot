@php
    $listRoute = [
        'wadmin::accountant-check.get','wadmin::accountant-confirm-bank.get','wadmin::transferred-company.get'
    ];
    $checkRoute = [
         'wadmin::accountant-check.get'
    ];
    $transferRoute = [
         'wadmin::accountant-confirm-bank.get'
    ];
    $transferredRoute = [
         'wadmin::transferred-company.get'
    ];
@endphp

@php
    use Illuminate\Support\Facades\Auth;
    use Transaction\Models\Transaction;
    use Wallets\Models\WalletTransaction;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
    $countBank = WalletTransaction::where('status','confirm')->count();
@endphp
@if ($permissions->contains('name','accountant_module'))
    <li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
        <a href="" ><i class="fa fa-pie-chart"></i> <span>Kế toán</span></a>
        <ul class="children">
            <li class="{{in_array(Route::currentRouteName(), $checkRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::accountant-check.get')}}">Chuyển tiền đại lý</a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $transferRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::accountant-confirm-bank.get')}}">Xác nhận chuyển khoản <span class="badge pull-right">{{$countBank}}</span></a>
            </li>
            <li class="{{in_array(Route::currentRouteName(), $transferredRoute) ? 'active' : '' }}">
                <a href="{{route('wadmin::transferred-company.get')}}">Đã chuyển khoản</a>
            </li>
        </ul>
    </li>
@endif
