@extends('mailTemplate')

@section('mail-content')
<p>
    Bạn có giao dịch mua {{$quantity}} BTC từ quảng cáo: #<b>{{$ads_id}}</b>
    <br>
    Chúng tôi đã khóa:  {{$quantity}} BTC từ ví của bạn.
    <br>
    - Khi người mua chuyển tiền cho bạn. Và bạn xác nhận chuyển tiền. BTC sẽ chuyển sang ví người mua.
    <br>
    - Giao diện thực hiện không thành công. BTC sẽ được trả lại vào ví của ban.
    <br>
    Vui lòng <a href="{{ url('login/') }}">đăng nhập</a> để xem thông tin chi tiết. Link login: {{ url('login/') }}
</p>
@endsection


