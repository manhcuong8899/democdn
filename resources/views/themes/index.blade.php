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
                @include('themes.includes.menu_top')
            </div>
        </div><!-- /.header -->
        @include('themes.includes.flash')
        <div class="section-slider">
            @include('themes.includes.slide')
    </div>
    <!-- ==========  HEADER : END  ========== -->

    <!-- ==========  MAIN =================== -->
    <div class="pmain">

        @yield('main-content')
    </div>
    <!-- ==========  MAIN : END ============= -->

        @include('themes.includes.modal')
    <!-- ==========  FOOTER =================-->

    <div id="footer">
        @include('themes.includes.footer')
    </div>
    <!-- ==========  FOOTER : END =========== -->

        @include('themes.includes.script')

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
    @yield('page-script')
<!-- ===============  PAGE : END =============== -->
</body>
</html>