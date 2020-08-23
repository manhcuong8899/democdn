@extends('themes.cart')

@section('page_title')
   Giỏ hàng
@endsection
@section('main-content')
    <div id="ch4_mainNav" class="clearfix">
        <div id="ch4_continueShopping"><a href="/">Chọn thêm sản phẩm</a></div>
        <div id="ch4_helpContainerTopNav">
            <div class="ch4_helpFacebook"><a href="{{($settings['linkfanpage'])}}"><i class="fa fa-facebook"></i> Facebook</a></div>
            <div class="ch4_helpContactTop">{{($settings['hotline'])}}</div>

        </div>
    </div>
    <div class="container">
        <div class="product-detail">
            <div class="row">
                <div class="col-sm-8">
                    <div class="cart_list">
                        <h2 class="heading">Sản phẩm đã chọn (<span class="num_product">{{$cart->count()}}</span>)</h2>
                        <ul class="list-unstyled">
                            @foreach($cart as $index=>$carts )
                            <li>
                                <div class="ch4_contentItems {{$carts->id}}">
                                    <div class="row">
                                        <div class="col-sm-4 cart_img">
                                            <a href="{{url($carts->options->slug)}}">
                                                <img src="{{asset('public/images/products/'.$carts->options->model.'/'.$carts->options->images)}}" class="imgresponsive">
                                            </a>
                                        </div><!--.col-4-->
                                        <div class="col-sm-8">
                                            <div class="ch4_cartItemPricing">
                                                <p class="ch4_cartItemPrice"><span>{{number_format(($carts->price*$carts->qty) - $carts->options->coupons,'0',',','.')}}</span> <br>@if($carts->options->coupons!=0)<span style="text-decoration: line-through; color: #000000">{{number_format($carts->price*$carts->qty,'0',',','.')}}</span>@endif</p>
                                            </div>
                                            <div class="ch4_cartItemOptionsContainer">
                                                <a href="{{url($carts->options->slug)}}" class="ch4_cartItemTitle">{{$carts->name}}</a>
                                                <div class="ch4_cartItemOptions">
                                                    <div class="ch4_cartItemOption">
                                                        <span class="ch4_cartItemLabel">Đơn giá:</span>
                                                        <span class="cartnum_price">{{number_format($carts->price,'0',',','.')}}</span>
                                                    </div>
                                                    <div class="ch4_cartItemOption">
                                                        <span class="ch4_cartItemLabel">Thành tiền:</span>
                                                        <span class="cartnum_qty">{{$carts->qty}}</span> x
                                                        <span class="cartnum_price">{{number_format($carts->price,'0',',','.')}}</span>
                                                    </div>
                                                    <div class="ch4_cartItemOption">
                                                        <span class="ch4_cartItemLabel">Giảm theo mã:</span>
                                                        <span class="cartnum_price">{{number_format($carts->options->coupons,'0',',','.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="ch4_miniTools">
                                                    <div class="style-select-model">
                                                        <label>Số lượng</label>
                                                        <select class="model_cart_qty" name="newquantity{{$carts->id}}">
                                                            <option value="{{$carts->qty}}" selected>{{$carts->qty}}</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ch4_cartItemActions ch4_lgRes">
                                                <button id="{{$carts->id}}" class="ch4_btn" onclick="delRowProduct(this.id,this.value);" value="{{$index}}">Xóa</button>
                                                <button id="{{$carts->id}}" class="ch4_btn" onclick="updateRowProduct(this.id,this.value);" value="{{$index}}">Cập nhật</button>
                                            </div>

                                        </div><!--.col-8-->
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>


                </div><!--/.col-8-->
                <div class="col-sm-4">
                    <div id="ch4_summaryContent">
                        <div class="ch4_summaryTitle">Thông tin chung</div>
                        <div class="ch4_summaryRow">
                            <span class="ch4_promoLabel">Mã giảm giá</span>
                            @if(\Illuminate\Support\Facades\Session::has('counpons'))
                            <div class="promoCode">
								<span>
									<input type="text" class="promoCode-input" placeholder="{{\Illuminate\Support\Facades\Session::get('counpons')[0]['code']}}" name="coupon" disabled>
								</span>
								<span>
									<input type="button" value="Hủy" class="promoCode-btn btn_White" id="btncancercoupon">
								</span>
                            </div>
                                @else
                                <div class="promoCode">
								<span>
									<input type="text" class="promoCode-input" placeholder="Mã Code" name="coupon">
								</span>
								<span>
									<input type="button" value="Nhập" class="promoCode-btn btn_White" id="btncoupon">
								</span>
                                </div>
                            @endif
                        </div>
                        <div class="ch4_summarySubtotal ch4_summaryRow">
                            Giá sản phẩm
                            <span id="subTotalAmount" class="ch4_right">{{number_format($total,'0',',','.')}}</span>
                        </div>

                        <div id="ch4_summaryTotal" class="ch4_itemName ch4_summaryRow">
                            Giảm giá <span id="totalAmt" class="ch4_right">{{number_format($coupons,'0',',','.')}}</span>
                        </div>
                        <div id="ch4_summaryTotal" class="ch4_itemName ch4_summaryRow">
                            Tổng chi phí<span id="totalAmt" class="ch4_right">{{number_format($total-$coupons,'0',',','.')}}</span>
                        </div>

                        <div id="ch4_summaryButtons" class="ch4_summaryRowEnd ">
                            <a href="{{url('checkout')}}" class="ch4_btn ch4_btnOrange ch4_itemName">Thanh Toán</a>
                        </div>
                    </div>

                    <div class="ch4_siderbar sidebar_transport">
                        <div class="ch4_title">PHÍ VẬN CHUYỂN</div>
                        <p>(Phí trên chưa bao gồm giao hàng tận nhà) chi tiết xem tại <a class="text_under_big" href="{{url('giaohang.html')}}" target="_blank">Chính sách vận chuyển</a></p>
                    </div>

                </div><!--/.col-4-->
            </div><!-- /.row-->

        </div><!-- /.page-view -->
    </div><!-- /.container -->

@endsection
@section('page-script')
<script>
        function updateRowProduct(id,rowid){
            var sizeproduct = $('select[name=newsize'+id+']').val();
            var quantity = $('select[name=newquantity'+id+']').val();
            $.ajax({
                url: '{{url('cart/updateitem')}}',
                dataType: "html",
                type: "post",
                data: {_method: 'post', _token: '{{csrf_token()}}', rowId: rowid, newsize: sizeproduct, newquantity: quantity}
            }).done(function(data) {
                window.location.href = data;
            }).fail(function(data) {
                alert('Xảy ra lỗi update sản phẩm trong giỏ hàng!!');
            });
        }

        /* Get Coupon*/
        $('#btncoupon').click(function(){
            var code = $('input[name=coupon]').val();
            var url = '{{url('cart')}}'
            $.ajax({
                url: '{{url('coupons')}}',
                dataType: "html",
                type: "post",
                data: {_method: 'post', _token: '{{csrf_token()}}', code: code}
            }).done(function(data){
                if(data=='true'){
                    window.location.href = url;
                }else{
                    alert('Mã giảm giá không chính xác!');
                }
            }).fail(function(data) {
                alert('Xảy ra lỗi!!');
            });
        });
        /* Get Coupon*/
        $('#btncancercoupon').click(function(){
            $.ajax({
                url: '{{url('cancercoupons')}}',
                dataType: "html",
                type: "post",
                data: {_method: 'post', _token: '{{csrf_token()}}'}
            }).done(function(data){
                window.location.href = data;
            }).fail(function(data) {
                alert('Xảy ra lỗi!!');
            });
        });
</script>
@endsection