@php
    $menus = getAllmenu();
    $allCat = getAllCategory();
@endphp

@if(!empty($menus))

    <ul class="nav navbar-nav">
        @foreach($menus as $menu)
        @if(count($menu->childs))
        <li class="dropdown">
            <a href="{{$menu->link}}" class="dropdown-toggle" data-toggle="dropdown">{{$menu->name}} <i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu" role="menu">
                @foreach($menu->childs as $c)
                    @if(count($c->childs))
                <li class="dropdown-submenu">
                    <a href="{{$c->link}}">{{$c->name}}</a>

                    <ul class="dropdown-menu">
                        @foreach($c->childs as $cc)
                        <li><a href="{{$cc->link}}">{{$cc->name}}</a></li>
                        @endforeach
                    </ul>

                </li>
                    @else
                        <li><a href="{{$c->link}}">{{$c->name}}</a></li>
                    @endif
                    @endforeach

            </ul><!-- End dropdown -->
        </li><!-- Features menu end -->
            @else
                <li>
                    <a href="{{$menu->link}}">{!! ($menu->is_home==1) ? '<i class="fa fa-home"></i>' : '' !!} {{$menu->name}}</a>
                </li>
            @endif
        @endforeach

    </ul>
@endif

