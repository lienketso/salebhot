@if(isset($listContact))
    @foreach($listContact as $c)
<li class="media">
    <a href="{{route('wadmin::contact.change.get',$c->id)}}">
        <div class="media-left">
            <san>{{format_date($c->created_at)}}</san>
        </div>
        <div class="media-body">
            <h4 class="media-heading">{{$c->name}}</h4>
            <span><i class="fa fa-phone"></i> {{$c->phone}}</span>
        </div>
        <div class="mess_contact">
            <p>Tiêu đề : {{$c->title}}</p>
            <p>Mội dung : {{$c->messenger}}</p>
        </div>
    </a>
</li>
@endforeach
    @endif
