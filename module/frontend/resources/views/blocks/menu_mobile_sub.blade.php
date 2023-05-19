<ul>
    @foreach($childs as $child)
    <li><a href="{{ $child->link }}" title="{{ $child->name }}" itemprop="url">{{ $child->name }}</a></li>
    @endforeach
</ul>
