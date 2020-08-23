@extends('mailTemplate')

@section('mail-content')
<p>
    <b>{{$transaction_id}}</b>-Xác nhận đã nhận được tiền từ giao dịch mua {{$quantity}} BTC từ quảng cáo: #<b>{{$ads_id}}</b>
    <br>
    Chúng tôi đang chuyển:  {{$quantity}} BTC từ ví của bạn sang ví của khách hàng thực hiện giao dịch này.
    <br>
    Vui lòng <a href="{{ url('login/') }}">đăng nhập</a> để hoàn thành giao dịch này: {{ url('login/') }}
</p>
@endsection
