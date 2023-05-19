<div class="form-group">
    <label>Tên nhiệm vụ</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mission_name][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mission_name','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_10_'.$lang) : $postModel->getPostMetaJson('meta_mission_name','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mission_name][name]"
                   type="text"
                   value="{{old('meta_mission_name',$postModel->getPostMetaJson('meta_mission_name','name',$data->id))}}"
                   placeholder="Tên nhiệm vụ">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Tác giả</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mission_author][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mission_author','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_2_'.$lang) : $postModel->getPostMetaJson('meta_mission_author','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mission_author][name]"
                   type="text"
                   value="{{old('meta_mission_author',$postModel->getPostMetaJson('meta_mission_author','name',$data->id))}}"
                   placeholder="Tên tác giả">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Nhóm nghiên cứu</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mission_group][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mission_group','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_11_'.$lang) : $postModel->getPostMetaJson('meta_mission_group','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mission_group][name]"
                   type="text"
                   value="{{old('meta_mission_group',$postModel->getPostMetaJson('meta_mission_group','name',$data->id))}}"
                   placeholder="Tên nhóm nghiên cứu">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Đơn vị triển khai</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mission_company][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mission_company','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_8_'.$lang) : $postModel->getPostMetaJson('meta_mission_company','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mission_company][name]"
                   type="text"
                   value="{{old('meta_mission_company',$postModel->getPostMetaJson('meta_mission_company','name',$data->id))}}"
                   placeholder="Tên đơn vị triển khai">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Năm nghiệm thu</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_mission_expire][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_mission_expire','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_9_'.$lang) : $postModel->getPostMetaJson('meta_mission_expire','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_mission_expire][name]"
                   type="number"
                   min="1900"
                   value="{{old('meta_mission_expire',$postModel->getPostMetaJson('meta_mission_expire','name',$data->id))}}"
                   placeholder="Năm nghiệm thu">
        </div>
    </div>

</div>
