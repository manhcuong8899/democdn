<div class="modal fade" id="myModalCardView">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content pd-10">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">
                    <span>Thêm vào giỏ hàng thành công</span>
                    <span data-dismiss="modal" class="btn_continue_shopping" title="Continue Shopping">Chọn thêm sản phẩm</span>
                </h3>
            </div>
            <div class="modal-body">
                <div class="line"></div>
                <div class="dialog-cart">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-6"><img src="" alt="" class="imgresponsive" name="images"/></div>
                                <div class="col-sm-6">
                                    <h3 class="product-title" name="nameproduct"></h1>
                                        <div class="product-style" name="colorproduct"></div>
                                        <div class="product-style" >Số lượng: <span class="modal-qty" name="quantityproduct"></span></div>
                                </div><!--col-sm-6 -->
                            </div>
                        </div><!--col-sm-6 -->
                        <div class="col-sm-5">
                            <div class="minicart_summery">
                                <div class="cartQty"name="quantitycart"><span>7</span> sản phẩm</div>
                                <div class="summary_row">
                                    <div class="summary_label">Giá sản phẩm:</div>
                                    <div class="summary_value modal-price" name="pricecart"></div>
                                </div>
                                <div class="summary_row">
                                    <div class="summary_label">Phí vận chuyển:</div>
                                    <div class="summary_value modal-ship" name="ship"> Liên hệ</div>
                                </div>
                                <div class="summary_row summary_total">
                                    <div class="summary_label">Tổng chi phí:</div>
                                    <div class="summary_value modal-total" name="totalcart"></div>
                                </div>

                                <div class="summary_row summary_btnshowcart">
                                    <a class="summary_btn btn-black" href="{{url('cart')}}">Xem giỏ hàng</a>
                                    <a class="summary_btn" href="{{url('checkout')}}">Thanh Toán</a>
                                </div>
                            </div>
                        </div><!--col-sm-6 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!---- Modal Form Đăng nhập thành viên --->
<div class="modal fade" id="myModalSignIn">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="login-logo"></div>

                <div class="box-hide box-login">
                    <form class="login-form" role="form" method="POST" action="{{ url('/admin/login') }}">
                        {!! csrf_field() !!}
                        <div class="row-input">
                            <input class="f-login-input" type="email" placeholder="Email" name="email">
                            <div class="tip">Please enter a valid email address.</div>
                        </div>
                        <div class="row-input">
                            <input class="f-login-input" type="password" placeholder="Mật khẩu" name="password">
                            <div class="tip">Please enter a password.</div>
                        </div>
                        <div class="row-input">
                            <div class="box-inline">
                                <input type="checkbox" name="keepMeLoggedIn" checked="checked">
                                <span>Lưu mật khẩu</span>
                            </div>

                            <div class="box-inline text-right">
                                <a class="btn_forgot" href="javascript:void(0);">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="row-input">
                            <button type="submit" class="login_button btn-black">ĐĂNG NHẬP</button>
                            <button type="button" class="login_button btn-facebook">ĐĂNG NHẬP BẰNG FACEBOOK</button>
                            <button type="button" class="login_button btn-gmail">ĐĂNG NHẬP BẰNG GMAIL</button>
                        </div>
                    </form>
                </div>
                <div class="box-hide box-forgot">
                    <div class="login-title">RESET PASSWORD</div>
                    <div class="row-input text-center">Nhập email của bạn để nhận lại mật khẩu.</div>
                    <form class="login-form" role="form" method="POST" action="{{ url('member/forgotpassword') }}">
                        {!! csrf_field() !!}
                        <div class="row-input">
                            <input class="f-login-input" type="text" placeholder="Nhập email lấy lại mật khẩu" name="email">
                            <div class="tip">Không đúng định dạng email!.</div>
                        </div>
                        <div class="row-input">
                            <button class="login_button btn_create btn-black">Reset</button>
                        </div>
                        <div class="row-input text-center">
                            <p>Quay lại <a class="btn_login"  href="javascript:void(0);" style="text-decoration: underline;">Đăng nhập</a>.</p>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<!---- Modal Form Đăng ký thành viên --->
<div class="modal fade" id="myModalRegister">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="login-logo"></div>

                <div class="box-register">
                    <form class="login-form" method="POST" action="{{ url('member/register') }}" id="idFormregister">
                        {!! csrf_field() !!}
                        <div class="row-input">
                            <span name="message" style="color: #ff0000; display: none;"></span>
                        </div>
                        <div class="row-input">
                            <input class="f-login-input" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="row-input">
                            <input class="f-login-input" type="password" placeholder="Mật khẩu" name="password">
                        </div>
                        <div class="row-input">
                            <input class="f-login-input" type="password" placeholder="Xác nhận lại mật khẩu" name="confirmpassword">
                        </div>
                        <div class="row-input">
                            <input class="f-login-input" type="text" placeholder="Họ và tên" name="full_name">

                        </div>

                        <div class="row-input">
                            <input class="f-login-input" type="text" placeholder="Số điện thoại" name="phone">
                        </div>
                        <div class="row-input">
                            <select class="selectBox" name="city">
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
                        <div class="row-input">
                            <input class="f-login-input" type="text" placeholder="Địa chỉ" name="address">
                        </div>
                        <div class="row-input text-center">
                            <p class="sm2-padding">Bằng việc đăng ký tài khoản, bạn đã đồng ý với <a href="{{url('dieukhoansudung.html')}}" TARGET="_blank"> <span style="text-decoration: underline;">điều kiện sử dụng BF365.vn</span></a></p>
                        </div>

                        <div class="row-input">
                            <button type="button" class="login_button btn_create btn-black" id="submitregister">ĐĂNG KÝ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!---- Modal Form Thay đổi mật khẩu--->
<div class="modal fade" id="myModalChangepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="login-form" role="form" method="POST" action="{{ url('member/changepass') }}">
                    {!! csrf_field() !!}
                    <div class="mTitle">THAY ĐỔI MẬT KHẨU</div>
                    <div class="form-group font12">
                        <label for="inputName" class="control-label">Mật khẩu cũ<b>*</b></label>
                        <input type="password" class="form-control" required name="oldpassword">
                    </div>
                    <div class="form-group font12">
                        <label for="inputName" class="control-label">Mật khẩu mới <b>*</b></label>
                        <input type="password" class="form-control" required name="newpassword">
                    </div>
                    <div class="form-group font12">
                        <label for="inputName" class="control-label">Xác nhận lại mật khẩu <b>*</b></label>
                        <input type="password" class="form-control" required name="confirmpassword">
                    </div>
                    <div class="ch4_formButtonRow">
                        <button data-dismiss="modal"  class="ch4_btn ch4_btnBlack">HỦY BỎ</button>
                        <button type="submit" class="ch4_btn ch4_btnOrange">LƯU LẠI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>