@extends('layouts.mailTemplate')
@section('mail-content')
<p><b>Bạn đã thực hiện kiểm tra thông tin mã kiện hàng:{{$code}}</b></p>
<p>Xem thông tin chi tiết đơn hàng: {{url('package/index')}}</p>
@endsection