<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->name }} <span><a href="{{route('wadmin::menu.edit.get',$child->id)}}"><i class="fa fa-pencil"></i></a>
                                <a class="example-p-6" href="javascript:void(0)" data-url="{{route('wadmin::menu.remove.get',$child->id)}}"><i class="fa fa-trash"></i></a></span>

        </li>
        @if(count($child->childs))
            @include('wadmin-menu::blocks.manageChild',['childs' => $child->childs])
        @endif
    @endforeach
</ul>
