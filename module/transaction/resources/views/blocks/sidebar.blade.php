@php
    $listRoute = [
        'wadmin::transaction.index.get'
    ];

@endphp

<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::transaction.index.get')}}"><i class="fa fa-cart-plus"></i>
        <span>Đơn hàng</span> </a></li>
