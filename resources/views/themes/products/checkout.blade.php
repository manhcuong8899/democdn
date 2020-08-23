@extends('themes.checkout')

@section('page_title')
 Thanh toán
@endsection
@section('main-content')
    <div id="ch4_mainNav" class="clearfix">
        <div id="ch4_continueShopping"><a href="product.html">Chọn thêm sản phẩm</a></div>
        <div id="ch4_helpContainerTopNav">
            <div class="ch4_helpFacebook"><a href="{{($settings['linkfanpage'])}}"><i class="fa fa-facebook"></i> Facebook</a></div>
            <div class="ch4_helpContactTop">{{($settings['hotline'])}}</div>

        </div>
    </div>

    <div class="container">
        <div class="product-detail">
            <div class="pageTitle">Thanh toán </div>
            <div class="row">
                <div class="col-sm-8">

                    @if (Auth::guest())
                        @include('themes.includes.formcheckout')
                        @else
                        @include('themes.includes.membercheckout')
                        @endif

                </div><!--/.col-8-->

                <div class="col-sm-4">
                    <!-- Update 24/4 -->
                    <div class="summarySection">
                        <div class="summarySectionTitle">Thông Tin Chung</div>
                        <div class="summaryContent">
                            <div class="summaryCol clearfix">
                                <div class="left">GIÁ SẢN PHẨM</div>
                                <div class="right"><span class="sum_price">{{number_format($total,'0',',','.')}}</span></div>
                            </div>
                            <div class="summaryCol clearfix">
                                <div class="left">GIÁ GIẢM TRỪ</div>
                                <div class="right"><span class="sum_sale">{{number_format($coupons,'0',',','.')}}</span></div>
                            </div>
                            <div class="summaryCol clearfix">
                                <div class="left">PHÍ VẬN CHUYỂN</div>
                                <div class="right"><span class="sum_ship">LIÊN HỆ</span></div>
                            </div>

                            <div class="summaryCol clearfix summaryTotal">
                                <div class="left">THÀNH TIỀN</div>
                                <div class="right"><span class="sum_total">{{number_format($total-$coupons,'0',',','.')}}</span></div>
                            </div>

                        </div>
                    </div>

                    <div class="summarySection">
                        <div class="summarySectionTitle">GIỎ HÀNG </div>
                        <div class="summaryContent">
                            <div class="confirmSectionTitle">GIAO HÀNG TRONG NGÀY</div>
                            <div class="summaryList">
                                @foreach( $cart as $index=>$carts )
                                <div class="cartItem">
                                    <div class="summaryItemImg"><img src="{{asset('public/images/products/'.$carts->options->model.'/'.$carts->options->images)}}" class="imgresponsive"></div>
                                    <div class="summaryItemContent">
                                        <h4 class="summaryItemTitle">{{$carts->name}}</h4>
                                        <p class="ch4_cartItemOptions">
                                            <span class="ch4_cartItemOption"><span class="ch4_cartItemLabel">Size</span>: {{$carts->options->size}}</span>
                                            <span class="ch4_cartItemOption"><span class="ch4_cartItemLabel">Số lượng</span>:{{$carts->qty}}</span>
                                            <span class="ch4_cartItemOption"><span class="ch4_cartItemLabel">Giảm giá:</span>{{number_format($carts->options->coupons,'0',',','.')}}</span>
                                        </p>
                                        <p class="orange">{{number_format(($carts->price*$carts->qty) - $carts->options->coupons,'0',',','.')}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- end Update 24/4 -->


                </div><!--/.col-4-->
            </div><!-- /.row-->

        </div><!-- /.page-view -->
    </div><!-- /.container -->

@endsection
@section('page-script')
@endsection