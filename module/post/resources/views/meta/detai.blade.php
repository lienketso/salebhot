<div class="form-group">
<label>Tên đề tài </label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_topic_name][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_topic_name','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_1_'.$lang) : $postModel->getPostMetaJson('meta_topic_name','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_topic_name][name]"
                   type="text"
                   value="{{old('meta_topic_name',$postModel->getPostMetaJson('meta_topic_name','name',$data->id))}}"
                   placeholder="Tên đề tài">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Tác giả</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_topic_author][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_topic_author','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_2_'.$lang) : $postModel->getPostMetaJson('meta_topic_author','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_topic_author][name]"
                   type="text"
                   value="{{old('meta_topic_author',$postModel->getPostMetaJson('meta_topic_author','name',$data->id))}}"
                   placeholder="Tên tác giả">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Đề tài cấp</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_topic_level][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_topic_level','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_3_'.$lang) : $postModel->getPostMetaJson('meta_topic_level','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <select id="" name="meta[meta_topic_level][name]" class="form-control" style="width: 100%" >
                <option value="{{$setting->getSettingMeta('form_key_4_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_topic_level','name',$data->id) == $setting->getSettingMeta('form_key_4_'.$lang) ) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_4_'.$lang)}}</option>
                <option value="{{$setting->getSettingMeta('form_key_5_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_topic_level','name',$data->id) ==$setting->getSettingMeta('form_key_5_'.$lang)) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_5_'.$lang)}}</option>
                <option value="{{$setting->getSettingMeta('form_key_6_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_topic_level','name',$data->id) == $setting->getSettingMeta('form_key_6_'.$lang)) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_6_'.$lang)}}</option>
                <option value="{{$setting->getSettingMeta('form_key_7_'.$lang)}}"
                    {{ ($postModel->getPostMetaJson('meta_topic_level','name',$data->id) ==$setting->getSettingMeta('form_key_7_'.$lang)) ? 'selected' : ''}}>{{$setting->getSettingMeta('form_key_7_'.$lang)}}</option>
            </select>
        </div>
    </div>

</div>
<div class="form-group">
    <label>Đơn vị triển khai</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_topic_company][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_topic_company','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_8_'.$lang) : $postModel->getPostMetaJson('meta_topic_company','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_topic_company][name]"
                   type="text"
                   value="{{old('meta_topic_company',$postModel->getPostMetaJson('meta_topic_company','name',$data->id))}}"
                   placeholder="Tên đơn vị triển khai">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Năm nghiệm thu</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_topic_expire][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_topic_expire','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_9_'.$lang) : $postModel->getPostMetaJson('meta_topic_expire','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_topic_expire][name]"
                   type="number"
                   min="1900"
                   value="{{old('meta_topic_expire',$postModel->getPostMetaJson('meta_topic_expire','name',$data->id))}}"
                   placeholder="Năm nghiệm thu">
        </div>
    </div>

</div>
