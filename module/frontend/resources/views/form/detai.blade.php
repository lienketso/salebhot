<form method="get" class="frmDetai">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_1_'.$lang]}}</label>
                <input type="text" name="meta_topic_name" value="{{(request()->get('meta_topic_name')) ? request()->meta_topic_name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_1_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_2_'.$lang]}}</label>
                <input type="text"
                       name="meta_topic_author"
                       value="{{(request()->get('meta_topic_author')) ? request()->meta_topic_author : ''}}"
                       class="form-control"
                       placeholder="VD : Nguyen Van A">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_3_'.$lang]}}</label>
                <select name="meta_topic_level" class="form-control">
                    <option value="">{{($lang=='vn') ? 'Tất cả đề tài' : 'All topics'}}</option>
                    <option value="{{$setting['form_key_4_'.$lang]}}"
                        {{(request()->get('meta_topic_level') && request()->meta_topic_level == $setting['form_key_4_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_4_'.$lang]}}</option>
                    <option value="{{$setting['form_key_5_'.$lang]}}"
                        {{(request()->get('meta_topic_level') && request()->meta_topic_level == $setting['form_key_5_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_5_'.$lang]}}</option>
                    <option value="{{$setting['form_key_6_'.$lang]}}"
                        {{(request()->get('meta_topic_level') && request()->meta_topic_level == $setting['form_key_6_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_6_'.$lang]}}</option>
                    <option value="{{$setting['form_key_7_'.$lang]}}"
                        {{(request()->get('meta_topic_level') && request()->meta_topic_level == $setting['form_key_7_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_7_'.$lang]}}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_8_'.$lang]}}</label>
                <input type="text"
                       name="meta_topic_company"
                       value="{{(request()->get('meta_topic_company')) ? request()->meta_topic_company : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_8_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_9_'.$lang]}}</label>
                <input type="number"
                       min="1900"
                       max="3000"
                       id=""
                       name="meta_topic_expire"
                       value="{{(request()->get('meta_topic_expire')) ? request()->meta_topic_expire : date('Y')}}"
                       class="form-control" placeholder="VD : {{date('Y')}}">
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
