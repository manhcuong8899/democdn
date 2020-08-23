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
        <?php echo $__env->make('themes.includes.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="section-slider">
            <?php echo $__env->make('themes.includes.slide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
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

        <?php echo $__env->make('themes.includes.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <p id="back-top" style="display: block;"> <a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> </p>
        <script type="text/javascript">
            $(document).on('ready', function() {
                $('.list-01 .owl-carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    navSpeed:700,
                    nav:true,
                    dots:false,
                    responsive:{
                        0:{items:2},
                        600:{items:3},
                        1000:{items:4},
                        1400:{items:5}
                    }
                });
                $('.list-02 .owl-carousel').owlCarousel({
                    loop:true,
                    margin:10,
                    navSpeed:700,
                    nav:true,
                    dots:false,
                    responsive:{
                        0:{items:2},
                        600:{items:3},
                        1000:{items:4},
                        1400:{items:5}
                    }
                });
            });
        </script>

</div>
    <?php echo $__env->yieldContent('page-script'); ?>
<!-- ===============  PAGE : END =============== -->
</body>
</html>