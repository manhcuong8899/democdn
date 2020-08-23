@extends('layouts.mailTemplate')
@section('mail-content')
<p><b>Thông báo reset mật khẩu từ hệ thống NEXT1688</b></p>
<p>Email đăng ký: {{$email}}</p>
<p>Mật khẩu mới:{{$password}}</p>
@endsection
