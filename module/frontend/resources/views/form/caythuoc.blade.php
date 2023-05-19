<form method="get" class="frmDetai">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>{{$setting['keyword_20_'.$lang]}}</label>
                <input type="text" name="name" value="{{(request()->get('name')) ? request()->name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['keyword_20_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>{{$setting['form_key_12_'.$lang]}}</label>
                <input type="text"
                       name="meta_tree_name"
                       value="{{(request()->get('meta_tree_name')) ? request()->meta_tree_name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_12_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>{{$setting['form_key_13_'.$lang]}}</label>
                <input type="text"
                       name="meta_tree_science"
                       value="{{(request()->get('meta_tree_science')) ? request()->meta_tree_science : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_13_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label></label>
                <div class="btnSearch">
                    <button type="submit"><i class="fa fa-search"></i> {{($lang=='vn') ? 'Tìm kiếm' : 'Search'}}</button>
                </div>
            </div>
        </div>
    </div>


</form>
