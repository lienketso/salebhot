{{--vị thuốc--}}
<div class="form-group">
    <label>Text tìm kiếm</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_community_name][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_community_name','title',$data->id)=='null')) ? $setting->getSettingMeta('keyword_20_'.$lang)  : $postModel->getPostMetaJson('meta_community_name','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_community_name][name]"
                   type="text"
                   value="{{old('meta_community_name',$postModel->getPostMetaJson('meta_community_name','name',$data->id))}}"
                   placeholder="Tên tác giả">
        </div>
    </div>

</div>
<div class="form-group">
    <label>Tên tác giả</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_community_author][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_community_author','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_2_'.$lang)  : $postModel->getPostMetaJson('meta_community_author','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_community_author][name]"
                   type="text"
                   value="{{old('meta_community_author',$postModel->getPostMetaJson('meta_community_author','name',$data->id))}}"
                   placeholder="Tên tác giả">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Thời gian từ</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_community_start][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_community_start','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_27_'.$lang)  : $postModel->getPostMetaJson('meta_community_start','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_community_author][name]"
                   type="date"
                   value="{{old('meta_community_start',$postModel->getPostMetaJson('meta_community_start','name',$data->id))}}"
                   placeholder="dd/mm/yyyy">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Thời gian đến</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_community_end][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_community_end','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_28_'.$lang)  : $postModel->getPostMetaJson('meta_community_end','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_community_end][name]"
                   type="date"
                   value="{{old('meta_community_end',$postModel->getPostMetaJson('meta_community_end','name',$data->id))}}"
                   placeholder="dd/mm/yyyy">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Nguồn</label>
    <div class="row">
        <div class="col-lg-4">
            <input class="form-control"
                   name="meta[meta_community_source][title]"
                   type="text"
                   value="{{($postModel->getPostMetaJson('meta_community_source','title',$data->id)=='null')) ? $setting->getSettingMeta('form_key_29_'.$lang)  : $postModel->getPostMetaJson('meta_community_source','title',$data->id}}"
                   placeholder="Tiêu đề trường (hiển thị ở trường search)">
        </div>
        <div class="col-lg-8">
            <input class="form-control"
                   name="meta[meta_community_source][name]"
                   type="text"
                   value="{{old('meta_community_source',$postModel->getPostMetaJson('meta_community_source','name',$data->id))}}"
                   placeholder="Nguồn bài viết">
        </div>
    </div>
</div>

