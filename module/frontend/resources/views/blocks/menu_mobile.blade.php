@php
    $menus = getAllmenu();
@endphp

<ul>
    @foreach($menus as $menu)
        @if(count($menu->childs))
    <li class="menu-item-has-children"><a href="{{$menu->link}}" title="{{$menu->name}}" itemprop="url">{{$menu->name}}</a>
        @include('frontend::blocks.menu_mobile_sub',['childs' => $menu->childs])
    </li>
        @else
            <li> <a title="" itemprop="url" href="{{$menu->link}}">{{$menu->name}}</a></li>
        @endif
    @endforeach
</ul>
