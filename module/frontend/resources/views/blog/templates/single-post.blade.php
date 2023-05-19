<div class="entry-post">
    @if(!empty($metaPost) && count($metaPost))
    <div class="meta-post-single">
        <div class="row">
            @foreach($metaPost as $d)
                @php
                    $val = json_decode($d->meta_value);
                @endphp
            <div class="col-lg-4">
                <div class="item-meta">
                    <p><strong>{{$val->title}}</strong> : {{$val->name}}</p>
                </div>
            </div>
            @endforeach

        </div>
        @endif
    </div>
    {!! $data->content !!}
</div>
