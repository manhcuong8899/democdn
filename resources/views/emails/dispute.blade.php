@extends('mailTemplate')

@section('mail-content')
<p>
    Giao dịch tranh chấp <b>#{{$transactionid}}</b>
    <br>
    <b>Nội dung tin nhắn:</b>
    {{$content}}
    <br>
    <b>Xem bằng chứng tranh chấp:</b>
    <br>
    @foreach($files as $value)
    <img src="{{url('files/dispute/'.$transactionid.'/'.$value)}}" width="550">
    <br>
    @endforeach
    <b>Tải bằng chứng</b>
    <br>
    @foreach($files as $value)
    <a href="{{url('files/dispute/'.$transactionid.'/'.$value)}}">{{$value}}</a>
    <br>
    @endforeach
</p>
@endsection

