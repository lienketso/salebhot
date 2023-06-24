@extends('frontend::customer.master')
@section('js-init')
    <script type="text/javascript">
        $('.SaveInfo').on('click',function (e){
           e.preventDefault();
           let _this = $(e.currentTarget);
           let mess = '';
           let url = _this.attr('data-url');
           let id = _this.attr('data-id');
           let name = $('input[name="name"]').val();
           let contact_name = $('input[name="contact_name"]').val();
           let address = $('input[name="address"]').val();
           let bank_number = $('input[name="bank_number"]').val();
           let bank_name = $('input[name="bank_name"]').val();

            if(name.length <=0){
                mess += 'err';
                $('#dName').addClass('errorClass');
                $('#errName').show();
                $('#errName').text('Vui lòng nhập');
            }else{
                $('#dName').removeClass('errorClass');
                $('#errName').text('');
                $('#errName').hide();
            }
            if(contact_name.length <=0){
                mess += 'err';
                $('#cName').addClass('errorClass');
                $('#errCName').show();
                $('#errCName').text('Vui lòng nhập');
            }else{
                $('#cName').removeClass('errorClass');
                $('#errCName').text('');
                $('#errCName').hide();
            }
            if(address.length <=0){
                mess += 'err';
                $('#cAddress').addClass('errorClass');
                $('#errcAddress').show();
                $('#errcAddress').text('Vui lòng nhập');
            }else{
                $('#cAddresse').removeClass('errorClass');
                $('#errcAddress').text('');
                $('#errcAddress').hide();
            }
            if(bank_number.length <=0){
                mess += 'err';
                $('#bankNumber').addClass('errorClass');
                $('#errBankNumber').show();
                $('#errBankNumber').text('Vui lòng nhập');
            }else{
                $('#bankNumber').removeClass('errorClass');
                $('#errBankNumber').text('');
                $('#errBankNumber').hide();
            }
            if(bank_name.length <=0){
                mess += 'err';
                $('#bankName').addClass('errorClass');
                $('#errBankName').show();
                $('#errBankName').text('Vui lòng nhập');
            }else{
                $('#bankName').removeClass('errorClass');
                $('#errBankName').text('');
                $('#errBankName').hide();
            }
            if(mess.length <=0 ) {
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    data: {id,name,contact_name,address,bank_number,bank_name},
                    success: function (result) {
                        $('.success-update').show(500);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });

        //avatar
        $('#avatar').on('change',function(e){
            let form = document.getElementById('avatar-form');
            let formData = new FormData(form);

            $.ajax({
                url: "{{ route('ajax.update-avatar.get') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Nếu upload thành công, cập nhật lại ảnh đại diện mới
                    let avatarImage = document.getElementById('preview-avatar');
                    avatarImage.src = response.avatar_url;
                    console.log(response);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })
    </script>
@endsection
@section('content')
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.70632 17.9907C1.26501 18.0166 0.830995 17.8682 0.495801 17.5767C-0.165267 16.904 -0.165267 15.8175 0.495801 15.1447L14.971 0.501017C15.6586 -0.149851 16.7375 -0.11367 17.3809 0.5819C17.9627 1.2109 17.9966 2.17769 17.4603 2.84679L2.89977 17.5767C2.56889 17.864 2.14185 18.0121 1.70632 17.9907Z" fill="black"></path>
                                <path d="M16.1645 17.9907C15.7173 17.9888 15.2886 17.8092 14.971 17.4905L0.495743 2.84675C-0.116702 2.12323 -0.0334367 1.03438 0.681756 0.414752C1.32008 -0.138251 2.26149 -0.138251 2.89976 0.414752L17.4603 15.0585C18.1477 15.7095 18.1832 16.801 17.5397 17.4964C17.5141 17.5241 17.4876 17.5508 17.4603 17.5767C17.1037 17.8904 16.6345 18.0403 16.1645 17.9907Z" fill="black"></path>
                            </svg>
                        </a>
                        <h5 class="title mb-0 text-nowrap">Sửa thông tin cá nhân</h5>
                    </div>
                    <div class="mid-content">
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);"
                           class="text-dark font-20 SaveInfo"
                           data-id="{{$data->id}}"
                           data-url="{{route('ajax.update-profile.get')}}"
                        >
                            <i class="fa-solid fa-check"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-content">
        <div class="container">
            <div class="edit-profile">
                <div class="profile-image">
                    <form id="avatar-form" enctype="multipart/form-data">
                        <div class="media media-100 rounded-circle">
                            <img id="preview-avatar"
                                 src="{{ ($data->avatar!='') ? upload_url($data->avatar) : asset('frontend/mobile/assets/images/avatar.png')}}" alt="/">
                        </div>
                        <input type="file" name="avatar" id="avatar" >
                    </form>
                </div>
                <div class="success-update">
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor"
                             stroke-width="2" fill="none" stroke-linecap="round"
                             stroke-linejoin="round" class="me-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <strong>Success!</strong> Đã cập nhật thông tin
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <form method="get" >
                    <div class="mb-3 input-group input-mini">
                        <input type="text"
                               class="form-control"
                               id="cName"
                               name="contact_name"
                               value="{{$data->contact_name}}"
                               placeholder="Họ và tên">
                        <span id="errCName"></span>
                    </div>
                    <div class="mb-3 input-group input-mini">
                        <input type="text"
                               class="form-control"
                               id="dName"
                               name="name"
                               value="{{$data->name}}"
                               placeholder="Tên cửa hàng">
                        <span id="errName"></span>
                    </div>
                    <div class="mb-3 input-group input-mini">
                        <input type="url"
                               class="form-control"
                               id="cAddress"
                               name="address"
                               value="{{$data->address}}"
                               placeholder="Địa chỉ">
                        <span id="errcAddress"></span>
                    </div>
                    <div class="mb-3 input-group input-mini">
                        <input type="text"
                               class="form-control"
                               id="bankNumber"
                               name="bank_number"
                               value="{{$data->bank_number}}"
                               placeholder="Số tài khoản ngân hàng">
                        <span id="errBankNumber"></span>
                    </div>
                    <div class="mb-3 input-group input-mini">
                        <input type="text"
                               class="form-control"
                               id="bankName"
                               name="bank_name"
                               value="{{$data->bank_name}}"
                               placeholder="Tên ngân hàng">
                        <span id="errBankName"></span>
                    </div>
                    <div class="mb-3">
                        <button type="button"
                                class="btn btn-square btn-warning w-100 SaveInfo"
                                data-id="{{$data->id}}"
                                data-url="{{route('ajax.update-profile.get')}}"
                        >Lưu thông tin</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
