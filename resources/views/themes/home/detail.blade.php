@extends('themes.articles')
@section('main-content')
    <div class="container">
        <div class="page-content page-news">
            <div class="meta-date-post">{{$article->created_at}}</div>
            <h2 class="pageTitle lTitle">{{$article->name}}</h2>
            <div class="image-top">
                <img src="{{asset('public/images/articles/news/'.$article->images)}}" alt="{{$article->name}}" class="imgresponsive">
            </div>
            <div class="emty_content">
                {!!$article->long!!}
            </div>
        </div><!-- /.page-detail -->

        <div class="page-news list-more-news">
            <div class="row">
                @foreach($articles as $value)
                <div class="col-sm-4">
                    <div class="item">
                        @if($value->images!="")
                        <div class="cover">  <a href="{{url('tin-tuc/'.$value->slug)}}"><img src="{{asset('public/images/articles/news/'.$value->images)}}" alt="{{$value->name}}" class="imgresponsive"></a></div>
                        @endif
                        <div class="date-post">{{$value->created_at}}</div>
                        <h3 class="mTitle"><a href="{{url('tin-tuc/'.$value->slug)}}">{{$value->name}}</a></h3>

                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.list-more-news -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection
