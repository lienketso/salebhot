<form method="get" class="frmDetai">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['keyword_20_'.$lang]}}</label>
                <input type="text" name="meta_community_name" value="{{(request()->get('meta_community_name')) ? request()->name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['keyword_20_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_2_'.$lang]}}</label>
                <input type="text"
                       name="meta_community_author"
                       value="{{(request()->get('meta_community_author')) ? request()->meta_community_author : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_2_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_29_'.$lang]}}</label>
                <input type="text"
                       name="meta_community_source"
                       value="{{(request()->get('meta_community_source')) ? request()->meta_community_source : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_29_'.$lang]}}">
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_27_'.$lang]}}</label>
                <input type="date"
                       name="meta_community_start"
                       value="{{(request()->get('meta_community_start')) ? request()->meta_community_start : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_27_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_28_'.$lang]}}</label>
                <input type="date"
                       name="meta_community_end"
                       value="{{(request()->get('meta_community_end')) ? request()->meta_community_end : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_28_'.$lang]}}">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label></label>
                <div class="btnSearch">
                    <button type="submit"><i class="fa fa-search"></i> {{($lang=='vn') ? 'Tìm kiếm' : 'Search'}}</button>
                </div>
            </div>
        </div>

    </div>


</form>
