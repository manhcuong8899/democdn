@extends('mailTemplate')

@section('mail-content')
<p>
    <b>{{$transaction_id}}</b>-Xác nhận hủy bỏ giao dịch mua {{$quantity}} BTC từ quảng cáo: #<b>{{$ads_id}}</b>
    <br>
    Chúng tôi đã gửi trả:  {{$quantity}} BTC sang ví của người bán.
    <br>
    Click <a href="{{ url('login/') }}">tranh chấp</a> nếu phát sinh tranh chấp từ giao dịch.
</p>
@endsection

