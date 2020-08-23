@extends('mailTemplate')

@section('mail-content')
<p>
    <b>{{$transaction_id}}</b>-Bạn có giao dịch mua {{$quantity}} BTC từ quảng cáo: #<b>{{$ads_id}}</b>
    <br>
    Chúng tôi đang tạm giữ:  {{$quantity}} BTC từ ví của bạn.
    <br>
    Vui lòng <a href="{{ url('login/') }}">đăng nhập</a> để hoàn thành giao dịch này: {{ url('login/') }}
</p>
@endsection