<!DOCTYPE html>
<html>
<head>
    @include('themes.includes.header')
</head>

<body>
<div id="page"  class="wsmenucontainer clearfix">
    <div class="overlapblackbg"></div>

    <!-- ==========  HEADER ================= -->
    <div id="pheader">
        <div class="header clearfix">
            @include('themes.includes.logo')
            <div class="hright">
                @include('themes.includes.header_top')
            </div>
        </div><!-- /.header -->
    <!-- ==========  HEADER : END  ========== -->

    <!-- ==========  MAIN =================== -->
    <div class="pmain">
            @include('themes.includes.flash')
            @yield('main-content')
    </div>
    <!-- ==========  MAIN : END ============= -->

        @include('themes.includes.modal')
    <!-- ==========  FOOTER =================-->

    <div id="footer">
        @include('themes.includes.footer')
    </div>
    <!-- ==========  FOOTER : END =========== -->
        <p id="back-top" style="display: block;"> <a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> </p>

        <script type="text/javascript" src="{{ asset('themes/assets/js/jquery-1.11.3.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/js/webslidemenu.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/vendors/owcarousel/owl.carousel.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/vendors/icheck/icheck.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/js/index.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/vendors/validator/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{ asset('themes/assets/vendors/validator/additional-methods.js')}}"></script>
        <script type="text/javascript">
            $(document).on('ready', function() {

                if($('input[value="creditCard"]').prop("checked")){
                    $('.creditCard').fadeIn(500);
                }

                $('input[id=giftcode]').on('ifChecked', function(event){
                    $('.giftcode').show();
                });
                $('input[id=giftcode]').on('ifUnchecked', function(event){
                    $('.giftcode').hide();
                });

                $('input[name="address-payment-other"]').on('ifChecked', function(event){
                    $('.cod-infos').show();
                });
                $('input[name="address-payment-other"]').on('ifUnchecked', function(event){
                    $('.cod-infos').hide();
                });


                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-red',
                    radioClass: 'iradio_square-red',
                    increaseArea: '80%' // optional
                });

                $(".radio_btninfo").on('ifChecked', function(event){
                    $value = $(".radio_btninfo:checked").val();
                    $('.ch4_formInfoSell .hideclass').hide();
                    $('.ch4_formInfoSell .'+$value).fadeIn(500);
                });

                $(".typeCard").on('ifChecked', function(event){
                    $value = $(".typeCard:checked").val();
                    $('.typepayment.hideclass').hide();
                    $('.typepayment.'+$value).fadeIn(500);
                });


                $(".next").click(function(){
                    var form = $("#myform");
                    form.validate({
                        errorElement: 'span',
                        errorClass: 'help-block',
                        highlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').addClass("has-error");
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).closest('.form-group').removeClass("has-error");
                        },
                        rules: {
                            username: {
                                required: true,
                                //usernameRegex: true,
                                minlength: 6,
                            },
                            password : {
                                required: true,
                            },
                            conf_password : {
                                required: true,
                                equalTo: '#password',
                            },
                            company:{
                                required: true,
                            },
                            url:{
                                required: true,
                            },
                            lastname: {
                                required: true,
                                minlength: 2,
                            },
                            firstname: {
                                required: true,
                                minlength: 2,
                            },
                            email: {
                                required: true,
                                minlength: 3,
                            },
                            address: {
                                required: true,
                                minlength: 3,
                            },

                        },
                        messages: {
                            password : {
                                required: "Vui lòng nhập mật khẩu",
                            },
                            conf_password : {
                                required: "Password required",
                                equalTo: "Password don't match",
                            },
                            lastname: {
                                required: "Vui lòng nhập tên",
                            },
                            firstname: {
                                required: "Vui lòng nhập họ",
                            },
                            email: {
                                required: "Vui lòng nhập email",
                            },
                            address: {
                                required: "Vui lòng nhập địa chỉ",
                            },
                            phone: {
                                required: "Vui lòng nhập số điện thoại",
                            },
                        }
                    });
                    if (form.valid() === true){
                        if ($('#type_payment .checkoutShippingForm').is(":visible")){
                            current_fs = $('#type_payment');
                            next_fs = $('#account_information');
                        }else if ($('#account_information .checkoutShippingForm').is(":visible")){
                            current_fs = $('#account_information');
                            next_fs = $('#company_information');
                        }else if($('#company_information .checkoutShippingForm').is(":visible")){
                            current_fs = $('#company_information');
                            next_fs = $('#personal_information');
                        }

                        current_fs.find(".checkoutHeading").addClass('checkoutHeadingClosed');
                        current_fs.find('.checkoutShippingForm').slideUp();
                        current_fs.find('.edit_step').show();

                        next_fs.find('.checkoutShippingForm').show();
                        next_fs.find(".checkoutHeading").removeClass('checkoutHeadingClosed');
                        //current_fs.hide();
                    }
                });

                $('.previous').click(function(){
                    var idstep = $(this).closest('fieldset').attr('id');
                    //alert(idstep);

                    $('.checkoutItems .checkoutShippingForm').hide();
                    $('.checkoutItems .checkoutHeading').addClass('checkoutHeadingClosed');

                    $('#'+idstep+' .checkoutHeading').removeClass('checkoutHeadingClosed');
                    $('#'+idstep+' .checkoutShippingForm').slideDown();
                    $('#'+idstep+' .edit_step').hide();

                });

            });
        </script>
</div>
    @yield('page-script')
<!-- ===============  PAGE : END =============== -->
</body>
</html>