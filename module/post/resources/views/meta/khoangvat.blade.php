<div class="form-group">
    <label>Tên khoa học</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mineral_science][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mineral_science','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_13_'.$lang) : $postModel->getPostMetaJson('meta_mineral_science','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mineral_science][name]"
                   type="text"
                   value="{{old('meta_mineral_science',$postModel->getPostMetaJson('meta_mineral_science','name',$data->id))}}"
                   placeholder="Tên khoa học">
        </div>
    </div>

</div>
