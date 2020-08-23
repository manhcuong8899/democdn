<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('themes/assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('themes/assets/vendors/owcarousel/owl.carousel.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('themes/assets/vendors/zoom/easyzoom.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('themes/assets/vendors/select/css/select2.css')); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('themes/assets/css/media-style.css')); ?>">
</head>

<body>
<div id="page"  class="wsmenucontainer clearfix">
    <div class="overlapblackbg"></div>

    <!-- ==========  HEADER ================= -->
    <div id="pheader">
        <div class="header clearfix">
            <?php echo $__env->make('themes.includes.logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="hright">
                <?php echo $__env->make('themes.includes.header_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('themes.includes.menu_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div><!-- /.header -->

        <?php echo $__env->make('themes.includes.trending', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- ==========  HEADER : END  ========== -->

    <!-- ==========  MAIN =================== -->
        <div class="pmain">
            <?php echo $__env->yieldContent('main-content'); ?>
    </div>
    <!-- ==========  MAIN : END ============= -->

        <?php echo $__env->make('themes.includes.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- ==========  FOOTER =================-->

    <div id="footer">
        <?php echo $__env->make('themes.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- ==========  FOOTER : END =========== -->
        <p id="back-top" style="display: block;"> <a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> </p>

        <?php echo $__env->make('themes.includes.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <script src="<?php echo e(asset('themes/assets/vendors/icheck/icheck.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/assets/vendors/zoom/easyzoom.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/assets/vendors/select/js/select2.js')); ?>"></script>


        <script type="text/javascript">
            $(document).on('ready', function() {
                $('.add-to-cart').click(function(){
                    var qty = get_price_number($('.product-detail .btn-qty').val());
                    if(qty<1){$('.btn-qty').tooltip('show');}else{$('.btn-qty').tooltip('hide');}
                    if(qty>0){
                        $('.select2').removeClass('error-form');
                        var price = get_price_number($('.product-detail .price .new').text());
                        var shipping = 0;
                        var sum = qty*price+shipping;
                        var productid = $('#add_cart').val();
                        $('.modal-price').html('$'+price);
                        $('.modal-qty').html(qty);
                        $('.cartQty span').html(qty);
                        $('.modal-total').html('$'+sum);
                        $('#myModalCardView').modal('show');

                        /* Hàm Ajax xử lý đặt hàng online */
                        $.ajax({
                            url: '<?php echo e(url('addcart')); ?>',
                            dataType: "json",
                            type: "post",
                            data: {_method: 'post', _token: '<?php echo e(csrf_token()); ?>',productid: productid, quantity: qty}
                        }).done(function(data){
                            $('#myModalCardView [name="images"]').attr("src",data.images);
                            $('#myModalCardView [name="nameproduct"]').html(data.name);
                            $('#myModalCardView [name="quantityproduct"]').html(data.quantity);
                            $('#myModalCardView [name="quantitycart"]').html(data.quantitycart);
                            $('#myModalCardView [name="pricecart"]').html(data.pricecart);
                            $('#myModalCardView [name="totalcart"]').html(data.totalcartship);
                            $('.exp-cart-qty').html(data.total);
                        }).fail(function(data) {
                            alert('Xảy ra lỗi thêm sản phẩm vào giỏ hàng!');
                        });
                        /*Kết thúc hàm Ajax xử lý đặt hàng online */
                    }else{
                        $('.select2').addClass('error-form');
                    }
                });

                $(".select2-style").select2({
                    minimumResultsForSearch: Infinity,
                }).on("change", function(e) {
                    actual_value = $(".select2-style").find(':selected').text();
                    if (actual_value.indexOf("Số Lượng") > -1){
                        return
                    }
                    newtext = actual_value;

                    $(".select2-selection__rendered").text(newtext);
                });

                var $easyzoom = $('.easyzoom').easyZoom();
                var api = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
                $('.thumbnails a').hover(function(e) {
                    var $this = $(this);
                    $('.thumbnails li').removeClass('active');
                    $this.closest( "li" ).addClass('active');
                    e.preventDefault();
                    api.swap($this.data('standard'), $this.attr('href'));
                });
                $('.product-size li').click(function() {
                    var $this = $(this);
                    $('.product-size li').removeClass('active');
                    $this.addClass('active');
                    var lisize = $('.product-size li.active').text();
                    var productid = $('#add_cart').val();
                    /* Hàm Ajax xử lý chọn Size */
                    $.ajax({
                        url: '<?php echo e(url('addsize')); ?>',
                        dataType: "json",
                        type: "post",
                        data: {_method: 'post', _token: '<?php echo e(csrf_token()); ?>',productid: productid,size: lisize}
                    }).done(function(dulieu){
                        $('.old').html(dulieu.listprice);
                        $('.new').html(dulieu.price);
                        $('#add_cart').val(dulieu.productid);
                    }).fail(function(dulieu) {
                        alert('Xảy ra lỗi khi chọn Size!');
                    });

                    /*Kết thúc hàm Ajax xử lý đặt hàng online */
                });
            });

        </script>

</div>
    <?php echo $__env->yieldContent('page-script'); ?>
<!-- ===============  PAGE : END =============== -->
</body>
</html>