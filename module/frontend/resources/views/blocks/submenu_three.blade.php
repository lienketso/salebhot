<ul class="dropdown-menu dropdown-submenu pt-3 pb-0 pb-xl-3 x-animated x-fadeInLeft">
@foreach($childs->childss as $childsss)
    <li class="dropdown-item">
        <a class="dropdown-link" href="{{$childsss->link}}">{{$childsss->name}}</a>
    </li>
@endforeach
</ul>
