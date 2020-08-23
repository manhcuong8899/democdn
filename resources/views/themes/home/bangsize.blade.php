@extends('themes.articles')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <div class="product-detail">
            <h2 class="pageTitle lTitle">HƯỚNG DẪN CHỌN SIZE</h2>
            <div class="row">
                <div class="col-sm-2"></div><!--/.col-4-->
                <div class="col-sm-8">

                    <div class="psize">
                        <div class="psize-nav">
                            <ul class="mar-b15 psize-menu">
                                @foreach($cateproducts as $cate)
                                <li @if($cate->id==$parent_id)class="active" @endif><a href="{{url('bangsize.html?size='.$cate->id)}}">{{$cate->name}}</a></li>
                                @endforeach
                            </ul>
                            @foreach($cateproducts as $cate)
                                @if($cate->children->count()!=0)
                            <div class="tab-content">
                                <div @if($cate->id==$parent_id)class="tab-pane tab-sub active"@else class="tab-pane tab-sub"@endif>
                                    <ul class="nav nav-tabs nav-justified tab-size" role="tablist">
                                        @foreach($cate->children as $child)
                                        <li @if($nowsize==$child->id) class="active" @endif><a href="">{{$child->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        </div><!--/.psize-nav-->
                    </div><!--/.psize-->
@if($catesize!=null)
                 {{--   <h2 class="mTitle">Bảng Size</h2>--}}
                    <div class="nike-cq-table"><!-- top header -->
                        <!-- Update 24/4 -->
                        @if($firsttable!=null)
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                @foreach($title as $key=>$value)
                                    <th>{{$key}}</th>
                                @endforeach
                            </tr>
                            @foreach($tablesizes as $key=>$value)
                                <?php
                                $size = json_decode($value->value,true);
                                ?>
                                <tr>
                                    @foreach($size as $data)
                                        <td class="nsg-bg--white" style="height:40px;">{{$data}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @endif
                    </div><!--/.tab-content-->
                    @endif
                    <!-- end Update 24/4 -->
                </div><!--/.col-8-->
                <div class="col-sm-2"></div><!--/.col-4-->
            </div><!-- /.row-->

        </div><!-- /.page-view -->
    </div><!-- /.container -->

@endsection
@section('page-script')
    <script type="text/javascript">
        $(document).on('ready', function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '80%' // optional
            });

            $(".radio_btninfo").on('ifChecked', function(event){
                $value = $(".radio_btninfo:checked").val();
                $('.ch4_formInfoSell .hideclass').hide();
                $('.ch4_formInfoSell .'+$value).fadeIn(500);
            });

            $(".btn_step").click(function(){
                var $this = $(this);
                var idstep = $this.attr( "data-id" );
                var idnext = $this.attr( "data-next" );
                $('.'+idstep + ' .checkoutShippingForm').slideUp(function(){
                    $('.'+idstep + ' .checkoutHeading').addClass('checkoutHeadingClosed');
                    $('.'+idstep + ' .checkoutHeading .edit_step').show();
                });
                $('.'+idnext + ' .checkoutShippingForm').slideDown(function(){
                    $('.'+idnext + ' .checkoutHeading').removeClass('checkoutHeadingClosed');
                    $('.'+idnext + ' .checkoutHeading .edit_step').hide();

                });
            });
            $(".edit_step").click(function(){
                var $this = $(this);
                var idstep = $this.attr( "data-id" );
                //$('.checkoutItems ').fadeOut();
                $('.checkoutItems').addClass('inhide');
                $('.'+idstep).removeClass('inhide');


                $('.'+idstep + ' .checkoutShippingForm').slideDown(function(){
                    $('.checkoutHeading').addClass('checkoutHeadingClosed');
                    $('.'+idstep + ' .checkoutHeading').removeClass('checkoutHeadingClosed');
                    $('.'+idstep + ' .checkoutHeading .edit_step').hide();
                    $('.checkoutItems.inhide .checkoutShippingForm').fadeOut();
                });

            });
        });
    </script>
@endsection