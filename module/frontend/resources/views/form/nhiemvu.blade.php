<form method="get" class="frmDetai">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_10_'.$lang]}}</label>
                <input type="text" name="meta_mision_name" value="{{(request()->get('meta_mision_name')) ? request()->meta_mision_name : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_10_'.$lang]}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_2_'.$lang]}}</label>
                <input type="text"
                       name="meta_mission_author"
                       value="{{(request()->get('meta_mission_author')) ? request()->meta_mission_author : ''}}"
                       class="form-control"
                       placeholder="VD : Nguyen Van A">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_8_'.$lang]}}</label>
                <input type="text"
                       name="meta_mission_company"
                       value="{{(request()->get('meta_mission_company')) ? request()->meta_mission_company : ''}}"
                       class="form-control"
                       placeholder="{{$setting['form_key_8_'.$lang]}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>{{$setting['form_key_9_'.$lang]}}</label>
                <input type="number"
                       min="1900"
                       max="3000"
                       id=""
                       name="meta_mission_expire"
                       value="{{(request()->get('meta_mission_expire')) ? request()->meta_mission_expire : date('Y')}}"
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
