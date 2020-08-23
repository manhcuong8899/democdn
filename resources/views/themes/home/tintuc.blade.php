@extends('themes.articles')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <h2 class="pageTitle lTitle">Tin tức</h2>
        <div class="page-content page-news">
            <div class="list-news">
                @foreach($articles as $value)
                <div class="item">
                    @if($value->images!="")
                    <div class="cover">
                        <a href="{{url('tin-tuc/'.$value->slug)}}"><img src="{{asset('public/images/articles/news/'.$value->images)}}" alt="{{$value->name}}" class="imgresponsive"></a>
                    </div>
                    @endif
                    <h3 class="bTitle"><a href="{{url('tin-tuc/'.$value->slug)}}">{{$value->name}}</a></h3>
                    <div class="meta-date-post">{{$value->created_at}}</div>
                    <div class="summary">
                        <p>{!!$value->short!!}</p>
                    </div>
                    <div class="view-more"><a href="{{url('tin-tuc/'.$value->slug)}}">Xem tiếp...</a></div>
                </div>
                @endforeach
            </div><!-- /.list-news -->
        </div><!-- /.page-detail -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection
