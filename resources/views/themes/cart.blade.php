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
        @include('themes.includes.script')

        <script type="text/javascript">
            function get_info_cart() {
                var num = $('.cart_list li').length;
                $('.cart_list .num_product').html(num);
                var totalWidth = 0;
                $('.cart_list li').each(function(index) {
                    var class_id = $(this).find('.ch4_contentItems').attr('class').split(' ');
                    var id = class_id[1];
                    var price = $('.'+id + ' .ch4_cartItemPrice').text();
                    var price = price.replace('$', '');
                    totalWidth += Number(price);
                });
                $('#subTotalAmount').html('$'+totalWidth);
                var shipping = get_price_number($('.ch4_summaryShippingDropDown').val());
                var total= totalWidth+shipping;
                $('#totalAmt').html('$'+total);
            }
            function delRowProduct(id,rowid){
                var $div = $('.ch4_contentItems.'+id).closest('li');
                $div.slideUp(function(){
                    $div.remove();
                    get_info_cart();
                });
                $.ajax({
                    url: '{{url('cart/deleteitem')}}',
                    dataType: "html",
                    type: "post",
                    data: {_method: 'post', _token: '{{csrf_token()}}', rowId: rowid}
                }).done(function(data) {
                    window.location.href = data;
                }).fail(function(data) {
                    alert('Xảy ra lỗi xóa sản phẩm trong giỏ hàng!');
                });
            }

        </script>
</div>
    @yield('page-script')
<!-- ===============  PAGE : END =============== -->
</body>
</html>