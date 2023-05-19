@if(auth()->guard()->check())
    <a href="{{route('wadmin::product.edit.get',$d->id)}}" target="_blank" class="edit-item"><i class="far fa-edit"></i> Edit</a>
    @endif
<div class="card border-0 " >
    <div style="background-image: url('{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/images/no-image.png')}}')"
       class="card-img ratio bg-img-cover-center ratio-1-1">
   </div>

   @if($d->disprice!=0 && $d->disprice>$d->price)
   <div class="badge badge-pink badge-circle ml-auto w-45px h-45px fs-12 d-flex align-items-center justify-content-center mb-2 fix-percent">
    -{{price_percent($d->price,$d->disprice)}}%
</div>
@endif

<div class="card-img-overlay product-a">
    <a href="{{route('frontend::product.detail.get',$d->slug)}}"  class="mb-1 d-block lh-12">
        <div class="dflex-name">
            <p>{{$d->name}}</p>
        </div>
        <div class="dflex-price">
            @if($d->disprice==0)
            <p class="mt-auto text-primary mb-0 font-weight-500 price-bold">
                {{number_format($d->price)}}</p>
                @else
                <p class="mt-auto text-primary mb-0 font-weight-500 price-bold">
                    <span class="text-line-through text-secondary fs-14 d-inline-block mr-2 font-weight-normal">{{number_format($d->disprice)}}</span>
                    {{number_format($d->price)}}</p>
                    @endif
                </div>

                <div class="more-product">
                    <div class="my-auto-fix content-change-vertical">
                        <ul class="list-icon">
                            @if($d->freeship==1)
                            <li><img src="{{upload_url($setting['banner_project'])}}" alt="Icon free ship"></li>
                            @endif
                            @if($d->lapdat==1)
                            <li><img src="{{upload_url($setting['banner_product'])}}" alt="Icon miễn phí lắp đặt"></li>
                            @endif
                            @if($d->thuoctinh!='')
                            <li><img src="{{upload_url($d->thuoctinh)}}" alt="Thuộc tính sản phẩm"></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="btn-add-cart">
        <button type="button" onclick="btnAddCart({{$d->id}})"><i class="far fa-shopping-basket"></i> Mua hàng</button>
    </div>
