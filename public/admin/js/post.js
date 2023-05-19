var nodeall = $('.nodeall');

$(".nodeall :input").attr("disabled", true);
nodeall.hide();

var nodeType = $('select[name="category"]');

node = nodeType.val();
$('.n' + node).show();
$('.n' + node + ' :input').attr("disabled", false);

nodeType.on('change', function (e) {
    var _this = $(e.currentTarget);
    var id = _this.val();
    let url = _this.attr('data-url');
    $.ajax({
        type: "GET",
        url: url,
        data: {
            id
        },
    })
        .done(function (res) {
            if (res == 'detai') {
                $('.detai').show();
                $('.detai :input').attr("disabled", false);
            } else {
                $('.detai').hide();
                $('.detai :input').attr("disabled", true);
            }
            if (res == 'nhiemvu') {
                $('.nhiemvu').show();
                $('.nhiemvu :input').attr("disabled", false);
            } else {
                $('.nhiemvu').hide();
                $('.nhiemvu :input').attr("disabled", true);
            }
            if (res == 'caythuoc') {
                $('.caythuoc').show();
                $('.caythuoc :input').attr("disabled", false);
            } else {
                $('.caythuoc').hide();
                $('.caythuoc :input').attr("disabled", true);
            }
            if (res == 'conthuoc') {
                $('.conthuoc').show();
                $('.conthuoc :input').attr("disabled", false);
            } else {
                $('.conthuoc').hide();
                $('.conthuoc :input').attr("disabled", true);
            }
            if (res == 'khoangvat') {
                $('.khoangvat').show();
                $('.khoangvat :input').attr("disabled", false);
            } else {
                $('.khoangvat').hide();
                $('.khoangvat :input').attr("disabled", true);
            }
            if (res == 'vithuoc') {
                $('.vithuoc').show();
                $('.vithuoc :input').attr("disabled", false);
            } else {
                $('.vithuoc').hide();
                $('.vithuoc :input').attr("disabled", true);
            }
            if (res == 'baithuoc') {
                $('.baithuoc').show();
                $('.baithuoc :input').attr("disabled", false);
            } else {
                $('.baithuoc').hide();
                $('.baithuoc :input').attr("disabled", true);
            }
            if (res == 'congdong') {
                $('.congdong').show();
                $('.congdong :input').attr("disabled", false);
            } else {
                $('.congdong').hide();
                $('.congdong :input').attr("disabled", true);
            }

        });
})
