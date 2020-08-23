@extends('themes.size')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <div class="product-detail">
            <h2 class="pageTitle lTitle">BẢNG SIZE SẢN PHẨM</h2>
            <div class="row">
                <div class="col-sm-2"></div><!--/.col-4-->
                <div class="col-sm-8">
                    <div class="pageTitle-sub clearfix">
                        <h2 class="pageTitle">BẢNG {{$cate->name}}</h2>
                        <a class="contact-size text_under" href="{{url('lien-he')}}"><i class="fa fa-phone"></i>Liên Hệ</a>
                    </div>

                    <h2 class="mTitle">Biểu đồ Size</h2>
                    <div class="nike-cq-table"><!-- top header -->
                        @if($first!=null)
                        <table class="nsg-text--medium-grey top" cellpadding="5" cellspacing="5"><!-- top header -->
                            <tbody>
                            <tr class="nike-cq-table-header" style="height:65px;">
                                @foreach($title as $key=>$value)
                                <th class="">{{$key}}</th>
                                @endforeach
                            </tr>
                            @foreach($sizes as $key=>$value)
                                <?php
                                $size = json_decode($value->value,true);
                                ?>
                            <tr>
                                @foreach($size as $data)
                                <td class="nsg-bg--white" style="height:40px;">{{$data}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @endif
                    </div><!--/.tab-content-->
                </div><!--/.col-8-->
                <div class="col-sm-2"></div><!--/.col-4-->
            </div><!-- /.row-->

        </div><!-- /.page-view -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection