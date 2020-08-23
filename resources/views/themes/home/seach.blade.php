@extends('themes.seach')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="col-md-12">
        <div class="list-products">
            <h2>Kết quả tìm kiếm</h2>
            <div class="row">
@foreach($listproducts as $key=>$list)
                    <div class="col-5">
                        <div class="grid-item hot-product">
                            <div class="item-box">
                                <div class="cover"><a href="{{url($list->slug)}}"><img src="{{asset('public/images/products/'.$list->model.'/'.$list->images)}}" alt="{{$list->name}}" class="imgresponsive"></a></div>
                                <div class="info-product">
                                    <div class="info-color">
                                        <div class="number-of-colors">{{\VNPCMS\Products\Products::colors($list->name)}} Màu</div>
                                    </div>

                                    <div class="info-view-color">
                                        <!-- // update 2017-04-28 -->
                                        <div class="color-wrap" id="inner-product-{{$key}}">
                                            <button class="btn-control prev"><i class="fa fa-angle-left"></i></button>
                                            <button class="btn-control next"><i class="fa fa-angle-right"></i></button>
                                            <div class="carousel-color">
                                                <ul>
                                                    @foreach(\VNPCMS\Products\Products::Models($list->name) as $key=>$model)
                                                        <li><a href="{{url($model->slug)}}" data-img-big="{{asset('public/images/products/'.$model->model.'/'.$model->images)}}"><img src="{{asset('public/images/products/'.$model->model.'/'.$model->images)}}" class="img-responsive" width="60" height="60"></a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- // end update 2017-04-28 -->
                                    </div>
                                    <h3><a href="{{url($list->slug)}}">{{$list->name}}</a></h3>
                                    <div class="product-subtitle">{{$list->cates->parent->name}}-{{$list->cates->name}}</div>
                                    <div class="price"><span>{{number_format($list->price,'0',',','.')}}</span>@if($list->listprice!=0)<span class="old">{{number_format($list->listprice,'0',',','.')}}</span>@endif</div>
                                    @if($list->listprice!=0)<div class="hot-percent">-{{round(100-($list->price/$list->listprice)*100,0)}}%</div>@endif
                                </div>
                            </div>
                        </div>
                    </div>
@endforeach
            </div>
        </div>
        <div align="center">{!! $listproducts->render() !!}</div>

    </div><!-- /.list-col-right -->
@endsection
@section('page-script')
@endsection