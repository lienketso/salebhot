//Update sort
$('.sortclass').on('blur',function(e){

    e.preventDefault();
    let _this = $(e.currentTarget);
    let id = _this.attr('data-id');
    let old = _this.attr('data-old-sort');
    let new_n = $('#sortID_'+id).val();
    let url = _this.attr('data-url');
    let newsort = $('#sortID_'+ id).val();
    if (old != new_n) {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id, newsort
            },
        })
            .done(function(res) {
                $('#sortID_' + id).attr('data-old-sort', new_n);
                $('.badge-alert').notify("Cập nhật thành công", 'success');
            });
    }
});
//Update parent
$('.parentclass').on('change',function(e){

    e.preventDefault();
    let _this = $(e.currentTarget);
    let id = _this.attr('data-id');
    let parent = $('#parentID_'+id).val();
    let url = _this.attr('data-url');
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id, parent
            },
        })
            .done(function(res) {
                $('.badge-alert').notify("Cập nhật thành công", 'success');
            });

});

//upload multi file media
$('#mutilFile').change(function(e){
    let domaim = window.location.protocol+'//'+window.location.hostname+'/upload/';
    let public_url = window.location.protocol+'//'+window.location.hostname;
    let productid = $('#productid').val();
    e.preventDefault();
    let _this = $(e.currentTarget);
    var form_data = new FormData();
    let url = _this.attr('data-url');
    // Read selected files
    var totalfiles = document.getElementById('mutilFile').files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("media[]", document.getElementById('mutilFile').files[index]);
    }
    form_data.append('productid',productid);
    // AJAX request
    $.ajax({
        url: url,
        type: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {

            for(var index = 0; index < response.length; index++) {
                var src = response[index];
                // Add img element in <div id='preview'>
                $('#listMedia').append('<div class="img_att_list" id="del'+index+'"><span data-id="'+index+'" data-link="'+src+'" data-url="'+domaim+'/api/media/delete" class="del_image"><img src="'+public_url+'/admin/themes/images/delete.png"></span><img class="img_at" src="'+domaim+src+'"></div>');
            }
            window.location.reload();

        }
    });

});

//del media file ajax
$(document).on('click', '.del_image', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    let link = _this.attr('data-link');
    var img_id = _this.attr("data-id");
    let r = confirm("Bạn có thực sự muốn xóa [OK]:Yes [Cancel]:No?");
    if (r === true) {
        $('#del'+img_id+'').remove();
    } else {
        return false;
    }
    //ajax unlink and remove database
    $.ajax({
        url: url,
        type: 'post',
        data : {link,img_id},
        success: function (response) {
            console.log('success');
        }
    });

});
// Get company ajax
$(document).on('blur', '.select2-search__field', function (e) {
    e.preventDefault();
    let _this = $(e.currentTarget);
    let keyword = $('.select2-search__field').val();
    let url = $('#select1').attr('data-url');

    $.ajax({
        type: "GET",
        url: url,
        dataType: 'JSON',
        data: {
            keyword
        },
    })
        .done(function(res){
            var len = res.length;
            for (var i=0;i<len;i++){
                var id = res[i].id;
                var name = res[i].name;
                var optionlist = '<option value="'+ id +'">'+ name +'</oprion>';
                $('#select1').append(optionlist);
            }
        })
        .always(function(resp) {
            setTimeout(() => {
                $('.loading').css('display', 'none');
            }, 2000)
        })
//end select

});

//ajax add option

