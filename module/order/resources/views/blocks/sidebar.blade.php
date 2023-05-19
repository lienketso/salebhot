@php
    $listRoute = [
        'wadmin::order.index.get'
    ];

@endphp

<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::order.index.get')}}"><i class="fa fa-bell-o"></i>
        <span>Đơn hàng</span> </a></li>
