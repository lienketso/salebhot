@php
    $listRoute = [
        'wadmin::newsletter.index.get'
    ];

@endphp

<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('wadmin::newsletter.index.get')}}"><i class="fa fa-bell-o"></i>
        <span>News Letter</span> </a></li>
