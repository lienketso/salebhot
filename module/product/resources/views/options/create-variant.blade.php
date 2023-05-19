<!-- Modal -->
<div class="modal fade" id="variantModal" tabindex="-1" role="dialog" aria-labelledby="variantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-variant" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="variantModalLabel">Thêm mới biến thể sản phẩm </h5>
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
                                    <input type="hidden" name="option_id[]" value="{{$val->id}}">
                                    <select name="option_value_id[]" class="form-control">
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
                                <input type="text" name="sku_price" onkeyup="this.value=FormatNumber(this.value);" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input type="text" name="sku_variant" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Barcode</label>
                                <input type="text" name="sku_barcode" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary"
                        id="btnAddVariant"
                        data-url="{{route('ajax.option.variant.add')}}"
                        data-product="{{$data->id}}"
                >Lưu lại</button>
            </div>


        </div>


    </div>
</div>

