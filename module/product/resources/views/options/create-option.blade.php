<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới thuộc tính ( Kích thước , mầu sắc... )</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-thuoc-tinh">
                    <div class="form-group">
                        <label>Tên thuộc tính</label>
                        <input type="text" name="option_name" placeholder="Tên thuộc tính" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Loại thuộc tính</label>
                        <select name="visual" class="form-control">
                            <option value="color">Mầu sắc</option>
                            <option value="size">Kích thước</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="SaveOption" data-product="{{$data->id}}" data-url="{{route('ajax.product.option.create')}}">Lưu lại</button>
            </div>
        </div>
    </div>
</div>
