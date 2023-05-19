<!-- Modal -->
<div class="modal fade" id="variantModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="variantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-variant" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="variantModalLabel">Sửa biến thể sản phẩm </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-thuoc-tinh">

                    <div class="row">
                        {{csrf_field()}}
                        @if(!empty($data->options))
                            @foreach($data->options as $key=>$val)
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>{{$val->name}}</label>
                                        <input type="hidden" name="option_id_{{$sku->id}}[]" value="{{$val->id}}">
                                        <select name="option_value_id_{{$sku->id}}[]" class="form-control" disabled>
                                            <option value="">Chọn {{$val->name}}</option>
                                            @if(!empty($val->optionValues))
                                                @foreach($val->optionValues as $d)
                                                    <option value="{{$d->id}}">{{$d->value}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" name="sku_price_{{$sku->id}}" value="{{number_format($sku->price)}}" onkeyup="this.value=FormatNumber(this.value);" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input type="text" name="sku_variant_{{$sku->id}}" value="{{$sku->name}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Barcode</label>
                                <input type="text" name="sku_barcode_{{$sku->id}}" value="{{$sku->barcode}}" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary"
                        id="btnEditVariant"
                        data-url="{{route('ajax.option.variant.edit')}}"
                        data-product="{{$data->id}}"
                        data-sku="{{$sku->id}}"
                >Lưu lại</button>
            </div>


        </div>


    </div>
</div>
