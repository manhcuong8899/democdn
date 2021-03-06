<form action="{{url('order')}}" method="POST" id="myform" class="form-horizontal">
    {!! csrf_field() !!}
    <!-- Update 24/4 -->
    <fieldset id="account_information" class="checkoutItems">
        <div class="checkoutHeading">
            1. Thông tin vận chuyển
            <button type="button" class="hideclass edit_step previous">Sửa</button>
        </div>
        <div class="checkoutShippingForm" style="display: block">
            <div class="shippingSection">
                <div class="singleAddress">
                    <div class="form-group">
                        <label class="col-sm-3 ch4_formLabel">Tên <span class="requiredColor">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastname" name="full_name" required value="{{\Illuminate\Support\Facades\Auth::user()->full_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 ch4_formLabel">Email <span class="requiredColor">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstname" name="email" required value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 ch4_formLabel">Thành phố/Tỉnh <span class="requiredColor">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="city" id="city">
                                <option>Thành phố/Tỉnh</option>
                                <option value="SG">Hồ Chí Minh</option>
                                <option value="HN" selected="selected">Hà Nội</option>
                                <option value="DDN">Đà Nẵng</option>
                                <option value="BD">Bình Dương</option>
                                <option value="DNA">Đồng Nai</option>
                                <option value="KH">Khánh Hòa</option>
                                <option value="HP">Hải Phòng</option>
                                <option value="LA">Long An</option>
                                <option value="QNA">Quảng Nam</option>
                                <option value="VT">Bà Rịa Vũng Tàu</option>
                                <option value="DDL">Đắk Lắk</option>
                                <option value="CT">Cần Thơ</option>
                                <option value="BTH">Bình Thuận  </option>
                                <option value="LDD">Lâm Đồng</option>
                                <option value="TTH">Thừa Thiên Huế</option>
                                <option value="KG">Kiên Giang</option>
                                <option value="BN">Bắc Ninh</option>
                                <option value="QNI">Quảng Ninh</option>
                                <option value="TH">Thanh Hóa</option>
                                <option value="NA">Nghệ An</option>
                                <option value="HD">Hải Dương</option>
                                <option value="GL">Gia Lai</option>
                                <option value="BP">Bình Phước</option>
                                <option value="HY">Hưng Yên</option>
                                <option value="BDD">Bình Định</option>
                                <option value="TG">Tiền Giang</option>
                                <option value="TB">Thái Bình</option>
                                <option value="BG">Bắc Giang</option>
                                <option value="HB">Hòa Bình</option>
                                <option value="AG">An Giang</option>
                                <option value="VP">Vĩnh Phúc</option>
                                <option value="TNI">Tây Ninh</option>
                                <option value="TN">Thái Nguyên</option>
                                <option value="LCA">Lào Cai</option>
                                <option value="NDD">Nam Định</option>
                                <option value="QNG">Quảng Ngãi</option>
                                <option value="BTR">Bến Tre</option>
                                <option value="DNO">Đắk Nông</option>
                                <option value="CM">Cà Mau</option>
                                <option value="VL">Vĩnh Long</option>
                                <option value="NB">Ninh Bình</option>
                                <option value="PT">Phú Thọ</option>
                                <option value="NT">Ninh Thuận</option>
                                <option value="PY">Phú Yên</option>
                                <option value="HNA">Hà Nam</option>
                                <option value="HT">Hà Tĩnh</option>
                                <option value="DDT">Đồng Tháp</option>
                                <option value="ST">Sóc Trăng</option>
                                <option value="KT">Kon Tum</option>
                                <option value="QB">Quảng Bình</option>
                                <option value="QT">Quảng Trị</option>
                                <option value="TV">Trà Vinh</option>
                                <option value="HGI">Hậu Giang</option>
                                <option value="SL">Sơn La</option>
                                <option value="BL">Bạc Liêu</option>
                                <option value="YB">Yên Bái</option>
                                <option value="TQ">Tuyên Quang</option>
                                <option value="DDB">Điện Biên</option>
                                <option value="LCH">Lai Châu</option>
                                <option value="LS">Lạng Sơn</option>
                                <option value="HG">Hà Giang</option>
                                <option value="BK">Bắc Kạn</option>
                                <option value="CB">Cao Bằng</option>
                            </select>
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->hasProfile()==true)
                    <div class="form-group">
                        <label class="col-sm-3 ch4_formLabel">Địa chỉ <span class="requiredColor">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" required value="{{\Illuminate\Support\Facades\Auth::user()->profile->address}}">
                        </div>
                    </div>
                    @else
                        <div class="form-group">
                            <label class="col-sm-3 ch4_formLabel">Địa chỉ <span class="requiredColor">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        @endif
                    <div class="form-group">
                        <label class="col-sm-3 ch4_formLabel">Số điện thoại <span class="requiredColor">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" required value="{{\Illuminate\Support\Facades\Auth::user()->profile->phone}}">
                        </div>
                    </div>

                </div>

                <div class="shippingMethod">
                    <div class="mTitle">Phí vận chuyển trong Việt Nam <br><span class="text-normal">(từ Shop đến nơi nhận)</span></div>
                    <ul class="list-dotstyle">
                        <li>Tính theo phí vận chuyển của hãng vận chuyển.</li>
                        <li>Khách hàng thanh toán phí vận chuyển khi nhận hàng</li>
                        <li>Báo giá tại Website chưa bao gồm phí vận chuyển</li>
                    </ul>
                </div>
            </div><!-- shippingSection -->

            <div class="ch4_formButtonRow">
                <span class="requiredLabel"><span class="requiredColor">*</span>&nbsp;Thông tin bắt buộc</span>
                <input type="button" value="Tiếp Tục" class="ch4_btn ch4_btnOrange next">
            </div>
        </div>
    </fieldset>

    <fieldset id="company_information" class="checkoutItems">
        <div class="checkoutHeading checkoutHeadingClosed">2. Thông tin thanh toán</div>
        <div class="checkoutShippingForm">
            <div class="paymentOptions">
                <div class="bTitle">Chọn phương thức thanh toán:</div>
                <div class="ch4_billingPaymentOptions">
                    <div class="cbrUnit">
                        <input type="radio" name="typeCard" class="typeCard" value="creditCard" checked="checked" >
                        <span><span id="creditLogo"></span>Chuyển Khoản</span>
                    </div>
                    <div class="cbrUnit">
                        <input type="radio" name="typeCard" class="typeCard" value="cod" >
                        <span> Tiền mặt khi nhận hàng (COD)</span>
                    </div>
                </div>
            </div><!--/.paymentOptions-->

            <div class="formSection">
                <div class="singleAddress">

                    <div class="typepayment hideclass creditCard">
                        @foreach($banks as $bank)
                        <div class="form-group">
                            <div class="col-sm-3">
                                <img src="{{asset('public/images/categories/banks/'.$bank->cates->images)}}" class="imgresponsive hvr-forward" alt="{{$bank->name}}">
                            </div>
                            <div class="col-sm-9">
                                <ul>
                                    <li>{{$bank->cates->name}}</li>
                                    <li>Chủ tài khoản: {{$bank->accountbank}}</li>
                                    <li>Số tài khoản: {{$bank->banknumber}}</li>
                                    <li>Chi nhánh: {{$bank->branch}}</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        <div class="creditCard_note">
                            <h2 class="mTitle">Lưu ý</h2>
                            <p> Đối với khách hàng thanh toán chuyển khoản trước khi giao hàng:</p>
                            <p>Nội dung thanh toán khi chuyển khoản:<br> <b>"Tên tài khoản tại Website + Số điện thoại liên hệ" </b></p>
                        </div>

                    </div><!--/.creditCard-->

                    <div class="typepayment hideclass cod">
                        <div class="billAddress">
                            <div class="lineTitle">Địa chỉ thanh toán</div>
                            <div class="cbrUnit">
                                <input type="checkbox" name="address-payment-other">
                                <span >Địa chỉ thanh toán của tôi khác với địa chỉ giao hàng của tôi.</span>
                            </div>
                        </div>

                        <div class="cod-infos hideclass">
                            <div class="form-group two-col clearfix">
                                <div class="ch4_colField">Điện thoại thanh toán <span class="requiredColor">*</span></div>
                                <div class="col">
                                    <div class="ch4_formField">
                                        <input type="text" class="form-control" required="required" value="{{\Illuminate\Support\Facades\Auth::user()->phone}}" name="phonepay">
                                    </div>
                                </div>
                                <div class="col sText">
                                    <span>Số đăng ký của bạn với người phát hành thanh toán là bắt buộc để xử lý đơn hàng của bạn.</span>
                                </div>
                            </div>
                            <div class="form-group two-col clearfix">
                                <div class="ch4_colField">Số điện thoại khác</div>
                                <div class="col">
                                    <div class="ch4_formField">
                                        <input type="text" class="form-control" name="phone2pay">
                                    </div>
                                </div>
                                <div class="col sText">
                                    <span>Vui lòng cung cấp số thay thế mà chúng tôi có thể gọi khi có câu hỏi về đơn hàng của bạn.</span>
                                </div>
                            </div>
                            <div class="form-group ch4_formRow two-col clearfix">
                                <div class="ch4_colField">Email <span class="requiredColor">*</span></div>
                                <div class="col">
                                    <div class="ch4_formField">
                                        <input type="text" class="form-control" id="email-bill" name="emailbill"  value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                                    </div>
                                </div>
                                <div class="col sText">
                                    <span>Đây là nơi chúng tôi sẽ gửi xác nhận đơn đặt hàng của bạn.</span>
                                </div>
                            </div>
                        </div>

                    </div><!--/.creditCard-->

                    <div class="ch4_formButtonRow linebox">
                        <input class="ch4_btn ch4_btnOrange next" type="submit" value="Hoàn Thành">
                    </div>
                </div><!-- /.singleAddress -->


            </div><!-- /.formSection -->

            <div class="ch4_yourPrivacy sText">
                <p class="sText"><span class="requiredColor">*</span> Thông tin bắt buộc</p>
            </div>

        </div><!-- /.checkoutShippingForm -->
    </fieldset>
    <!-- end Update 24/4 -->
</form>