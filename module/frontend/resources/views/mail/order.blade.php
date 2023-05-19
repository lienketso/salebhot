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

<p>Bạn nhận được một đơn hàng từ website {{env('APP_URL')}}</p>

<p><b>THÔNG KHÁCH HÀNG :</b></p>
<p>Họ tên : <strong>{{$data['cart']->customer}}</strong></p>
<p>Điện thoại : <strong>{{$data['cart']->phone}}</strong></p>
<p><b>THÔNG TIN ĐƠN HÀNG :</b></p>

<p>Mã đơn hàng #: ORDER[{{$data['cart']->id}}]</p>
<p>Ngày đặt hàng: [ {{format_date($data['cart']->created_at)}} ]</p>
<p>Tiền hàng : [ <b>{{number_format($data['cart']->amount)}} đ</b> ]</p>

<p>Địa chỉ giao hàng :  [ {{$data['cart']->address}} ]</p>

<table class="tbl-order" style="border-collapse: collapse; border: 1px solid #ccc; width: 50%;">
    <tr>
        <td style="border: 1px solid #ccc;padding: 10px;"><strong>Sản phẩm</strong></td>
        <td style="border: 1px solid #ccc;padding: 10px;"><strong>Số lượng</strong></td>
        <td style="border: 1px solid #ccc;padding: 10px;"> <strong>Giá</strong></td>
    </tr>
    @foreach($data['products'] as $d)
    <tr>
        <td style="border: 1px solid #ccc;padding: 10px;"><a href="{{route('frontend::product.detail.get',$d->product->slug)}}" target="_blank">{{$d->product->name}}</a></td>
        <td style="border: 1px solid #ccc;padding: 10px;">{{$d->qty}}x</td>
        <td style="border: 1px solid #ccc;padding: 10px;">{{number_format($d->amount)}} đ</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="2" style="border: 1px solid #ccc;padding: 10px;"><strong>Tổng tiền</strong></td>
        <td style="border: 1px solid #ccc;padding: 10px;"><strong>{{number_format($data['cart']->amount)}} đ</strong></td>
    </tr>
</table>


</body>
</html>
