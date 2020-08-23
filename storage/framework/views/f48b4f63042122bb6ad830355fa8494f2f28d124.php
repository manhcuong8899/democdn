<!DOCTYPE html>
<html>
<head>
    <?php echo $__env->make('themes.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
        <div class="list-col-tow clearfix">
            <?php echo $__env->make('themes.includes.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('main-content'); ?>
            <?php echo $__env->make('themes.includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>

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

        <script type="text/javascript">
            $(document).on('ready', function() {
                // update 2017-04-28
                $( ".list-products .grid-item" ).hover(function() {
                            $(this).addClass('on');
                            $(this).find('.info-view-color').show();
                            _id = $(this).find('.color-wrap').attr('id');
                            $("#"+_id+' .carousel-color').jCarouselLite({
                                btnNext: "#"+_id+" .next",
                                btnPrev: "#"+_id+" .prev",
                                circular: false,
                            });
                        }, function() {
                            $(this).removeClass('on');
                            $(this).find('.info-view-color').hide();
                        }
                );
                $('.carousel-color ul').each(function(){
                    var num = $(this).children().length;
                    if(num<='2'){
                        $(this).parents('.color-wrap').addClass('off').find('.btn-control').hide();
                    }
                });
                // end update 2017-04-28
               /* $('.dropdown li a').click(function(){
                    var href = $(this).attr('href');
                });*/

            });
        </script>

</div>
    <?php echo $__env->yieldContent('page-script'); ?>
<!-- ===============  PAGE : END =============== -->
</body>
</html>