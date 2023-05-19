<ul class="dropdown-menu pt-3 pb-0 pb-xl-3 x-animated x-fadeInUp">
    @foreach($childs as $child)
        @if(count($child->childs))
    <li class="dropdown-item dropdown dropright">
        <a class="dropdown-link dropdown-toggle" href="{{ $child->link }}" data-toggle="dropdown">
            {{ $child->name }}
        </a>
        @if(!empty($childs->childss) && count($childs->childss))
            @include('frontend::blocks.submenu_three',['childss' => $childs->childss])
        @endif

    </li>
            @else
            <li class="dropdown-item">
                <a class="dropdown-link" href="{{ $child->link }}">
                    {{ $child->name }}
                </a>
            </li>
        @endif
    @endforeach

</ul>

