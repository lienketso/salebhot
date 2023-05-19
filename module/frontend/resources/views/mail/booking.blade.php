<!doctype html>
<html lang="en">
<meta charset="UTF-8">
<body>
<style type="text/css">
    .tbl-order tr td{
        border: 1px solid #ccc;
        padding: 10px;
    }
</style>
<p>Bạn nhận được một đơn hàng đặt từ {{env('APP_URL')}}</p>

<p><b>THÔNG KHÁCH HÀNG :</b></p>
<p>Ngày đặt : <strong>15/05/2023</strong></p>
<p>Họ tên : <strong>{{$details['name']}}</strong></p>
<p>Điện thoại : <strong>{{$details['phone']}}</strong></p>
<p>Email : <strong>{{$details['mail']}}</strong></p>
<p>Biển số xe : <strong>{{$details['license_plate']}}</strong></p>
<p>Ngày hết hạn : <strong>{{$details['expiry']}}</strong></p>
<p>Tin nhắn khác : <strong>{{$details['message']}}</strong></p>
<p><b>THÔNG TIN ĐƠN HÀNG :</b></p>
<p>Sản phẩm : <b>Bảo hiểm TNDS ( Bắt buộc )</b></p>
<p>Hãng cung cấp : <b>BSH</b></p>

</body>
</html>
