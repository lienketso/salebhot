<div class="entry-product">
    <div class="info-product-single">
        <div class="row">
            <div class="col-lg-4">
                <div class="img-product-single">
                    <img
                        src="{{ ($data->thumbnail!='') ? upload_url($data->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                        alt="{{$data->name}}">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="info-product">
                    {!! $data->description !!}
                </div>
            </div>
        </div>
    </div>

    {!! $data->content !!}
</div>
