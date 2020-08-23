@extends('layouts.mailTemplate')

@section('mail-content')
<p>Kích hoạt tài khoản trên hệ thống mua và vận chuyển hàng trung quốc SCD1688.COM: {{ url('member/login/'.$email.'/'.$code) }}</p>
@endsection

