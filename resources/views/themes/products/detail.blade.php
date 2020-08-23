@extends('themes.productsdetail')

@section('page_title')
    Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <div class="product-detail">
            <div class="row">
                <div class="col-sm-7">
                    <div class="product-img clearfix">
                        <div class="easyzoom easyzoom--adjacent easyzoom--with-thumbnails">
                            <a href="{{asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)}}">
                                <img src="{{asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)}}" alt="" class="imgresponsive"/>
                            </a>
                        </div>
                    </div>
                    <ul id="thumblist" class="thumbnails clearfix" >
                        @foreach($files_images as $key=>$url)
                        <li @if($key==0)class="active" @endif>
                            <a href='{{asset('public/images/'.$url)}}' data-standard="{{asset('public/images/'.$url)}}" >
                                <img src='{{asset('public/images/'.$url)}}'>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-5">
                    <h1 class="product-title">{{$detailproduct->name}}</h1>
                    @if($detailproduct->cates->parent!=null)
                    <h2 class="product-subtitle">{{$detailproduct->cates->parent->name}}-{{$detailproduct->cates->name}}</h2>
                    @else
                        <h2 class="product-subtitle">{{$detailproduct->cates->name}}</h2>
                    @endif

                        <div class="price">Giá bán: @if($detailproduct->listprice!=0)<span class="old">{{number_format($detailproduct->listprice,'0',',','.')}}</span>@endif<span class="new">{{number_format($detailproduct->price,'0',',','.')}}</span> (Chưa bao gồm VAT)</div>
                    <div class="product-button">
                        <select class="p-btn btn-qty select2-style" title="Vui lòng chọn số lượng." id="quantity">
                            <option value="1">1</option>
                            <?php
                                    $n=10;
                                ?>
                            @for($i=2; $i<=$n; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <button class="p-btn add-to-cart" id="add_cart" value="{{$detailproduct->id}}">THÊM VÀO GIỎ</button>
                    </div>
                    <div class="product-links">
                        <a href="{!! $settings['linkfanpage']!!}" class="facebook" TARGET="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{!! $settings['instagram']!!}" TARGET="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="product-shipping"> {!!$detailproduct->short!!}</div>
                </div><!--/.col-->
            </div><!-- /.row-->

            <div class="product-info-more">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{asset('public/images/products/'.$detailproduct->model.'/'.$detailproduct->images)}}" alt="" class="imgresponsive"/>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="product-title">{{$detailproduct->name}}</h3>
                        <div class="pi-pdpmainbody">
                            {!!$detailproduct->long!!}
                        </div>
                    </div><!--/.col-->
                </div><!--/row-->
            </div><!--/.product-info-more-->
        </div><!-- /.page-view -->

        <div class="product-more list-products">
            <h3 class="product-title">SẢN PHẨM TƯƠNG TỰ</h3>
            <div class="product-more-content">
                <div class="row">
                    @foreach($alsolikes as $key=>$list)
                    <div class="col-xs-6 col-sm-3">
                        <div class="item">
                            <div class="cover"><a href="{{url($list->slug)}}"><img src="{{asset('public/images/products/'.$list->model.'/'.$list->images)}}" alt="{{$list->name}} " class="imgresponsive"></a></div>
                            <div class="info-product">
                                <div class="info-color">
                                    <div class="number-of-colors"> <a href="{{url($list->slug)}}">{{$list->name}}</a></div>
                                </div>
                                <h3><a href="{{url($list->slug)}}">{{$list->name}}</a></h3>
                                <div class="price"><span> Giá bán: {{number_format($list->price,'0',',','.')}}</span><span class="old"> (Chưa bao gồm VAT)</span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!--/.row-->
            </div><!--/.product-more-content-->
        </div><!--/.product-more-->

    </div><!-- /.container -->
@endsection
@section('page-script')

@endsection