{{--cơ sở dữ liệu bài thuốc--}}
<div class="form-group">
    <label>Nhóm chủ trị</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_data_group][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_data_group','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_16_'.$lang) : $postModel->getPostMetaJson('meta_data_group','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <select id="" name="meta[meta_data_group][name]" class="form-control" style="width: 100%" >
                <option value="{{$setting->getSettingMeta('form_key_17_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_17_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_17_'.$lang)}}</option>
                <option value="{{$setting->getSettingMeta('form_key_18_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_18_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_18_'.$lang)}}</option>
                <option value="{{$setting->getSettingMeta('form_key_19_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_17_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_19_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_20_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_20_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_20_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_21_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_21_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_21_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_22_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_22_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_22_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_23_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_23_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_23_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_24_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_24_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_24_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_25_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_25_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_25_'.$lang) }}</option>
                <option value="{{$setting->getSettingMeta('form_key_26_'.$lang) }}"
                    {{ ($postModel->getPostMetaJson('meta_data_group','name',$data->id) == $setting->getSettingMeta('form_key_26_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_26_'.$lang) }}</option>
            </select>
        </div>
    </div>

</div>
