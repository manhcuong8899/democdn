@extends('themes.index')

@section('page_title')
Trang chủ
@endsection
@section('main-content')
    @foreach($group as $gp)
    <div class="cols-list-auto list-01">
            <div class="name-box">
                <h2><a href="{{url('nhom-san-pham/'.$gp->slug)}}"> {{$gp->name}}</a> </h2>
            </div>
            <div class="cols-list-content">
                <div class="owl-carousel">
                    @foreach(viewProduct($gp->id) as $list)
                        <div class="item">
                            <div class="cover"><a href="{{url($list->slug)}}"><img src="{{asset('public/images/products/'.$list->model.'/'.$list->images)}}"alt="{{$list->name}}" class="imgresponsive"></a></div>
                            <div class="info-color">
                                <div class="number-of-colors">
                                    <a href="{{url($list->slug)}}">{{$list->name}}</a>
                                </div>
                            </div>
                            <h3><a href="{{url($list->slug)}}">Mã sản phẩm: {{$list->code}}</a></h3>
                            <div class="price"><span>Giá bán: {{number_format($list->price,'0',',','.')}}</span><span class="old">(Chưa bao gồm VAT)</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div><!-- /.block-products -->
    @endforeach
@if($countpview >0)
    <div class="cols-list-auto list-01">
        <div class="name-box">
            <h2><a href="#"> SẢN PHẨM ĐÃ XEM</a> </h2>
        </div>
        <div class="cols-list-content">
            <div class="owl-carousel">
                @foreach($pview as $index=>$alist )
                    <div class="item">
                        <div class="cover"><a href="{{url($alist->options->slug)}}"><img src="{{asset('public/images/products/'.$alist->options->model.'/'.$alist->options->images)}}"alt="{{$alist->name}}" class="imgresponsive"></a></div>
                        <div class="info-color">
                            <div class="number-of-colors">
                                <a href="{{url($alist->options->slug)}}">{{$alist->name}}</a>
                            </div>
                        </div>
                        <h3><a href="{{url($alist->options->slug)}}">Mã sản phẩm: {{$alist->options->code}}</a></h3>
                        <div class="price"><span>Giá bán: {{number_format($alist->price,'0',',','.')}}</span><span class="old">(Chưa bao gồm VAT)</span></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div><!-- /.block-products -->
@endif
@endsection
@section('page-script')
@endsection