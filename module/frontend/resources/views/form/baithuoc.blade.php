<form method="get" class="frmDetai">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['keyword_20_'.$lang]}}</label>
                <input type="text" name="name" value="{{(request()->get('name')) ? request()->name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['keyword_20_'.$lang]}}">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_16_'.$lang]}}</label>
                <select name="meta_data_group" class="form-control">
                    <option value="">{{($lang=='vn') ? 'Tất cả các nhóm' : 'All group'}}</option>
                    <option value="{{$setting['form_key_17_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_17_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_17_'.$lang]}}</option>
                    <option value="{{$setting['form_key_18_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_18_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_18_'.$lang]}}</option>
                    <option value="{{$setting['form_key_19_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_19_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_19_'.$lang]}}</option>
                    <option value="{{$setting['form_key_20_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_20_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_20_'.$lang]}}</option>
                    <option value="{{$setting['form_key_21_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_21_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_21_'.$lang]}}</option>
                    <option value="{{$setting['form_key_22_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_22_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_22_'.$lang]}}</option>
                    <option value="{{$setting['form_key_23_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_23_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_23_'.$lang]}}</option>
                    <option value="{{$setting['form_key_24_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_24_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_24_'.$lang]}}</option>
                    <option value="{{$setting['form_key_25_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_25_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_25_'.$lang]}}</option>
                    <option value="{{$setting['form_key_26_'.$lang]}}"
                        {{(request()->get('meta_data_group') && request()->meta_data_group == $setting['form_key_26_'.$lang] ) ? 'selected' : ''}}>{{$setting['form_key_26_'.$lang]}}</option>
                </select>
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
