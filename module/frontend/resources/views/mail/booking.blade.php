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
@php 
	$product = json_decode($details['products'])
@endphp
<p>Bạn nhận được một đơn hàng đặt từ {{env('APP_URL')}}</p>

<p><b>THÔNG KHÁCH HÀNG :</b></p>
<p>Ngày đặt : <strong>{{format_date($details->created_at)}}</strong></p>
<p>Họ tên : <strong>{{$details->name}}</strong></p>
<p>Điện thoại : <strong>{{$details->phone}}</strong></p>
<p>Biển số xe : <strong>{{$details->license_plate}}</strong></p>
<p>Ngày hết hạn : <strong>{{format_date($details->expiry)}}</strong></p>
<p>Tin nhắn khác : <strong>{{$details->message}}</strong></p>
<p><b>THÔNG TIN ĐƠN HÀNG :</b></p>
@foreach($details->orderProduct as $p)
<p>Sản phẩm : <b>{{$p->product->name}}</b></p>
@endforeach
@if(!is_null($details->hang) || $details->company_id!=0)
<p>Hãng: <strong>{{$details->hang->name}}</strong></p>
@endif
@if(!is_null($details->trancategory) || !is_null($details->category))
<p>Loại xe: <strong>{{$details->trancategory->name}}</strong></p>
@endif

</body>
</html>
