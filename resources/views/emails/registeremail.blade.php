@extends('layouts.mailTemplate')

@section('mail-content')
<p>Kích hoạt email đăng ký nhận thông tin từ SCD1688.COM: {{ url('kich-hoat-email/'.$email.'/'.$code)}}</p>
@endsection

