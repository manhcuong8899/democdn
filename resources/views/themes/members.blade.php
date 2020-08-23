<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Oswald&amp;subset=vietnamese" rel="stylesheet">
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
        @include('themes.includes.trending')
    <!-- ==========  HEADER : END  ========== -->

    <!-- ==========  MAIN =================== -->
    <div class="pmain">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                @include('themes.includes.left_member')
                </div>
                @yield('main-content')
            </div><!-- /.row -->
        </div><!-- /.container -->
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
</div>
    @yield('page-script')
<!-- ===============  PAGE : END =============== -->
</body>
</html>