@extends('layouts.mailTemplate')
@section('mail-content')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Trả lời Góp ý: {{$title}} </h3>
            </div>
                <div class="box-body">
                    <p style="font-size: 16px;"> Tiêu đề:<b>{{$title}}</b></p>

                    <p style="font-size: 16px;"><b> Nội dung gửi góp ý:<b></p>
                    <p> <textarea type="text"  rows="10" cols="80" disabled/>{{$content}}</textarea></p>
                    <p style="font-size: 16px;"> <b>Trả lời từ NEXT1688:</b></p>
                    <p> <textarea type="text"  rows="10" cols="80" disabled/>{{$reply}}</textarea></p>
                </div>
        </div>
@endsection

