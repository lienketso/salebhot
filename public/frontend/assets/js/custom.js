// disable on enter
$('form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });



  // form validiation
var inputschecked = false;


function formvalidate(stepnumber)
{
  // check if the required fields are empty
  inputvalue = $("#step"+stepnumber+" :input").not("button").map(function()
  {
    if(this.value.length > 0)
    {
      $(this).removeClass('invalid');
      return true;

    }
    else
    {

      if($(this).prop('required'))
      {
        $(this).addClass('invalid');
        return false
      }
      else
      {
        return true;
      }

    }
  }).get();


  // console.log(inputvalue);

  inputschecked = inputvalue.every(Boolean);

  // console.log(inputschecked);
}


$(document).ready(function()
   {
       // $('#successID').hide();
       $("#btnSubmit").on('click' , function(e)
       {
           e.preventDefault();
           let _this = $(e.currentTarget);
           let mess = '';
           let name = $('input[name="name"]').val();
           let npp = $('input[name="npp"]').val();
           let phone = $('input[name="phone"]').val();
           let email = $('input[name="email"]').val();
           let license_plate = $('input[name="license_plate"]').val();
           let expiry = $('input[name="expiry"]').val();
           let message = $('input[name="message"]').val();
           // let products = $('input[name="products"]:checked').val();
           var products = [];
           $(":checkbox").each(function () {
               var ischecked = $('input[name="products"]:checked');
               if (ischecked) {
                   products.push($(this).val());
               }
           });

           let url = _this.attr('data-url');

           if (name.length <= 0) {
               mess += 'err';
               $('input[name="name"]').addClass('err_alert');
               $('#sp_name').text('Vui lòng nhập họ tên !');
               $('#txt_success').text('');
           }else{
               $('input[name="name"]').removeClass('err_alert');
               $('#sp_name').text('');
           }
           if (isNaN(phone) || phone.length<=5) {
               mess += 'err';
               $('input[name="phone"]').addClass('err_alert');
               $('#sp_phone').text('Số điện thoại không đúng !');
               $('#txt_success').text('');
           }else{
               $('input[name="phone"]').removeClass('err_alert');
               $('#sp_phone').text('');
           }
           if(mess.length <=0 ) {
               $.ajax({
                   type: "POST",
                   url: url,
                   dataType: "json",
                   data: {name,phone,email,license_plate,expiry,message,products,npp},
                   success: function (result) {
                       console.log(result);
                       $('#txt_success').text('Gửi thông tin thành công ! Chuyên viên tại 4Car sẽ liên hệ quý khách hàng trong vài phút tới');
                       $('input[name="name"]').val('');
                       $('input[name="phone"]').val('');
                   },
                   error: function (data, status) {
                       $("#btnSubmit").html("Đã có lỗi xảy ra !");
                       console.log(data);
                   }
               });
           }
            });

   });

