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
            <div class="pageTitle">Đặt Hàng Thành Công</div>
        </div><!-- /.page-view -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection