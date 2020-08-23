@extends('themes.articles')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <h2 class="pageTitle lTitle">Về chúng tôi</h2>
    <div class="b_pageBack">
        <div class="container">
            <div class="page-detail gray-panel">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="page-content">
                            <h2 class="bTitle">BF365 (BlackFriday 365)</h2>
                            <p>Là website order đặt giầy, quần áo, phụ kiện thể thao chính hãng từ Nhật Bản (Adidas, Reebok, Nike, Puma, Asics…)</p>
                            <h3 class="mTitle">BF365 cam kết</h3>
                            <ol class="list-dotstyle">
                                <li>100% hàng là chính hãng.</li>
                                <li>100% được nhập từ Nhật Bản (có hóa đơn mua hàng tại Nhật Bản).</li>
                                <li>Phát hiện hàng fake bạn sẽ được: hoàn tiền cọc 100%, đền bù 100% giá trị sản phẩm.</li>
                            </ol>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="side_infocontact">
                            <div class="item">
                                <i class="fa fa-globe"></i>
                                <h3 class="mTitle">Website:</h3>
                                <ul class="list-unstyled">
                                    <li><a href="http://BF365.vn" target="_blank">BF365.vn</a></li>
                                    <li><a href="http://Blackfriday365.vn" target="_blank">Blackfriday365.vn</a></li>
                                </ul>
                            </div>

                            <div class="item">
                                <i class="fa fa-facebook-official"></i>
                                <h3 class="mTitle">Facebook</h3>
                                <p><a href="{{url($settings['linkfanpage'])}}" target="_blank">BF365.vn</a></p>
                            </div>
                            <div class="item">
                                <i class="fa fa-phone"></i>
                                <h3 class="mTitle">Hotline</h3>
                                <p><a href="tel:{{url($settings['hotline'])}}">{{$settings['hotline']}}</a></p>
                            </div>
                            <div class="item">
                                <i class="fa fa-envelope"></i>
                                <h3 class="mTitle">Email</h3>
                                <p><a href="mailto:{{url($settings['email'])}}">{{$settings['email']}}</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.page-detail -->
        </div><!-- /.container -->
    </div><!-- /.page-detail -->

@endsection
@section('page-script')
@endsection