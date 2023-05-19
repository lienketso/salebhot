//ajax add option product

$(document).on('click', '#SaveOption', function(e){
    // if($('.list-option').exists()){
    //      keyItem = $('.list-option:last-child').attr('data-index');
    // }else{
    //      keyItem = 0;
    // }
    let keyItem = $('.list-option').length;
    var count = keyItem+++1;
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    var product_id = _this.attr("data-product");
    var name = $('input[name="option_name"]').val();
    var visual = $('select[name="visual"]').val();
    if(name.length<=0){
        alert('Bạn chưa nhập tên thuộc tính');
        return false;
    }
    $.ajax({
        url: url,
        type: 'GET',
        data : {product_id,name,visual},
        dataType: 'json',
        success: function (response) {
            $('#exampleModal').modal('hide');
            $('#ListOption').append('<div class="list-option index'+count+'" data-index="'+count+'"><span class="remove-option" data-url="/api/product/ajax-remove-option" data-id="index'+count+'" data-remove="'+response.id+'"><i class="fa fa-trash"></i> '+response.name+' </span><div class="list-gt-option"><ul id="OptionValue'+response.id+'"></div><div class="form-add-value"><div class="row"><div class="col-lg-5"><label>Giá trị thuộc tính</label><input type="text" name="value['+count+'][name]" class="form-control"></div><div class="col-lg-5"><label>Nhãn</label><input type="text" name="value['+count+'][label]" class="form-control"></div><div class="col-lg-2"><button type="button" class="btn btn-primary save-tt" data-name="value['+count+'][name]" data-label="value['+count+'][label]" data-option="'+response.id+'" data-url="/api/product/ajax-create-option-value" data-product="'+response.product_id+'">Lưu lại</button></div></div></div></div>');
            $('input[name="option_name"]').val('');
            console.log(response);
        }
    });
});
//ajax remove option
$(document).on('click', '.remove-option', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    var id = _this.attr("data-id");
    var remove = _this.attr("data-remove");
    let r = confirm("Bạn có thực sự muốn xóa [OK]:Yes [Cancel]:No?");
    if (r === true) {
        $('.'+id).remove();
    } else {
        return false;
    }
    $.ajax({
        url: url,
        type: 'GET',
        data : {id,remove},
        dataType: 'json',
        success: function (response) {
            console.log(response);
        }
    });

});

//ajax create option value for option
$(document).on('click', '.save-tt', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    var nameI = _this.attr("data-name");
    var name =  $('input[name="'+nameI+'"]').val();
    var labelI = _this.attr("data-label");
    var label =  $('input[name="'+labelI+'"]').val();
    var option = _this.attr('data-option');
    var product_id = _this.attr('data-product');
    if(name.length<=0){
        alert('Bạn chưa nhập giá trị thuộc tính');
        $('input[name="'+nameI+'"]').focus();
    }

    $.ajax({
        url: url,
        type: 'GET',
        data : {name,label,option,product_id},
        dataType: 'json',
        success: function (response) {
            alert('Thêm giá trị thành công !');
            $('#OptionValue'+option).append('<li class="removeValue" data-id="'+response.id+'" data-url="/api/product/ajax-remove-option-value" title="Xóa giá trị"><span>'+response.value+'</span></li>')
            $('input[name="'+nameI+'"]').val('');
            var label =  $('input[name="'+labelI+'"]').val('');
            console.log(response);
        }
    });

});
//ajax remove option value for option
$(document).on('click', '.removeValue', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    var id = _this.attr("data-id");
    let r = confirm("Bạn có thực sự muốn xóa [OK]:Yes [Cancel]:No?");
    if (r === true) {
        _this.remove();
    } else {
        return false;
    }
    $.ajax({
        url: url,
        type: 'GET',
        data : {id},
        dataType: 'json',
        success: function (response) {
            console.log(response);
        }
    });

});


//thêm thuộc tính
$(document).on('click', '#btnAddVariant', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    var product_id = _this.attr("data-product");

    let option_id = $('input[name="option_id[]"]').serializeArray();
    let option_value = $('select[name="option_value_id[]"]').serializeArray();
    let sku_price = $('input[name="sku_price"]').val();
    let sku_variant = $('input[name="sku_variant"]').val();
    let sku_barcode = $('input[name="sku_barcode"]').val();

    $.ajax({
        url: url,
        type: 'GET',
        data : {product_id,option_id,option_value,sku_price,sku_variant,sku_barcode},
        dataType: 'json',
        success: function (response) {
           window.location.reload();
            console.log(response);
        }
    });
});
//edit sku
$(document).on('click', '#btnEditVariant', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    let sku = _this.attr('data-sku');

    let option_id = $('input[name="option_id_'+sku+'[]"]').serializeArray();
    let option_value = $('select[name="option_value_id_'+sku+'[]"]').serializeArray();
    let sku_price = $('input[name="sku_price_'+sku+'"]').val();
    let sku_variant = $('input[name="sku_variant_'+sku+'"]').val();
    let sku_barcode = $('input[name="sku_barcode_'+sku+'"]').val();
    $.ajax({
        url: url,
        type: 'GET',
        data : {sku,option_id,option_value,sku_price,sku_variant,sku_barcode},
        dataType: 'json',
        success: function (response) {
            window.location.reload();
            console.log(response);
        }
    });

});
//remove sku
$(document).on('click', '.remove-sku', function(e){
    e.preventDefault();
    let _this = $(e.currentTarget);
    let url = _this.attr('data-url');
    let id = _this.attr('data-id');
    let id_remove = _this.attr('data-remove');
    let r = confirm("Bạn có thực sự muốn xóa [OK]:Yes [Cancel]:No?");
    if (r === true) {
        $('.'+id_remove).remove();
    } else {
        return false;
    }
    $.ajax({
        url: url,
        type: 'GET',
        data : {id},
        dataType: 'json',
        success: function (response) {
            console.log(response);
        }
    });

});
