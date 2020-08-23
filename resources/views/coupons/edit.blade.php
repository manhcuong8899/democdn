@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý mã giảm giá</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tạo mã giảm giá</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/coupons/edit/'.$coupon->id)}}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="title">Loại mã giảm giá</label>
                        <select class="form-control" name="type" id="type">
                            <option value="0">Lựa chọn loại giảm giá</option>
                            <option @if($coupon->type==1) selected @endif value="1">Số lần sử dụng</option>
                            <option @if($coupon->type==2) selected @endif value="2" >Theo thời gian</option>
                            <option @if($coupon->type==3) selected @endif value="3" >Số lần và thời gian</option>
                        </select>
                    </div>
                        @if($coupon->type==1)
                            <div class="form-group" id="quantity">
                                <label for="title">Số lần</label>
                                <input type="text" name="quantity" class="form-control" value="{{$coupon->quantity}}">
                            </div>
                            <div class="form-group" id="date" style="display: none">
                                <label>Thời gian sử dụng đến</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="enddate" name="end_date">
                                </div>
                                <!-- /.input group -->
                            </div>
                        @endif

                        @if($coupon->type==2)
                            <div class="form-group" id="quantity" style="display: none">
                                <label for="title">Số lần</label>
                                <input type="text" name="quantity" class="form-control">
                            </div>
                            <div class="form-group" id="date">
                                <label>Thời gian sử dụng đến</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="enddate" name="end_date" value="{{$coupon->end_date}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                        @endif

                        @if($coupon->type==3)
                            <div class="form-group" id="quantity">
                                <label for="title">Số lần</label>
                                <input type="text" name="quantity" class="form-control" value="{{$coupon->quantity}}">
                            </div>
                            <div class="form-group" id="date">
                                <label>Thời gian sử dụng đến</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="enddate" name="end_date" value="{{$coupon->end_date}}">
                                </div>
                                <!-- /.input group -->
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="title">Counpon(%)</label>
                            <input type="text" name="value" class="form-control" value="{{$coupon->value}}">
                        </div>

                        <div class="form-group">
                            <label class="radio-inline">
                                <input name="status" value="1"  @if($coupon->status==1) checked="checked" @endif  type="radio">
                                Sử dụng</label>
                            <label class="radio-inline">
                                <input name="status" value="0" @if($coupon->status==0) checked="checked" @endif type="radio">
                                Không sử dụng</label>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Tên chương trình giảm giá</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$coupon->name}}">
                        </div>

                        <div class="form-group">
                            <select class="form-control">
                                <option disabled selected>{{$coupon->data}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Áp dụng</label>
                            <select class="form-control" name="data" id="data">
                                <option value="0">Lựa chọn nội dung áp dụng</option>
                                <option value="categories">Theo danh mục sản phẩm</option>
                                <option value="products" >Theo sản phẩm</option>
                                <option value="all" >Tất cả sản phẩm</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: none" id="renderurl">
                            <label for="title">Danh mục sản phẩm</label>
                            <select class="form-control select2"  name="group_cate[]" id="url" multiple="multiple" style="width:100%;">
                            </select>
                        </div>

                        <div class="form-group" style="display: none" id="renderarticle">
                            <label for="title">Sản phẩm</label>
                            <select class="form-control select2" name="group_product[]" id="article" multiple="multiple" style="width:100%;">
                            </select>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-defaut">Làm lại</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách mã khuyến mãi</h3>
            </div>

            <div class="box-body">
                @can('coupons_management')
                <table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mã giảm giá</th>
                        <th>Giảm trừ %</th>
                        <th>Loại giảm giá</th>
                        <th>Áp dụng</th>
                        @can('coupons_management')
                        <th>Thao tác</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $cp )
                        <tr>
                            <td>{{ $cp->id }}</td>
                            <td>
                                {{$cp->name}}
                            </td>
                            <td>
                                {{$cp->code}}
                            </td>
                            <td>
                                {{$cp->value}}
                            </td>
                            <td>
                                @if($cp->type==1)
                                    Số lần sử dụng
                                @endif
                                @if($cp->type==2)
                                    Theo thời gian
                                @endif
                                @if($cp->type==3)
                                    Số lần và thời gian
                                @endif
                            </td>
                            <td>
                                {{$cp->data}}
                            </td>
                            {{-- <td>
                                 @if($coupon->status==1)
                                   Sử dụng
                                 @else
                                    Ngừng sử dụng
                                 @endif
                             </td>--}}
                            <td>
                                @can('coupons_management')
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/coupons/edit/'.$cp->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>
                                @endcan
                                @can('coupons_management')
                                <button type="button" data-productid="{{ $cp->id }}" data-productname="{{$cp->name}}" data-productdeleteurl="{{ url('admin/coupons/delete/'.$cp->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>
                                @endcan

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                @endcan
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        @can('coupons_management')
        <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Xác nhận xóa mã khuyến mãi</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="productname"></span></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
                        {!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('VNPCMS.forms.buttons.delete') }}</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        @endcan
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script>
        /* Loại giảm giá */
        $('#type').change(function(){
            var type = $('#type').val();
            if(type==1)
            {
                $("#quantity").css("display","block");
                $("#date").css("display","none");
            }
           if(type==2){
                $("#quantity").css("display","none");
                $("#date").css("display","block");
            }
            if(type==3){
                $("#quantity").css("display","block");
                $("#date").css("display","block");
            }
        });
    </script>
    <script>
        $('#data').change(function(){
            var data = $('#data').val();
            var type = 'products';
            var couponid = '{{$coupon->id}}';

            if(data=="categories")
            {
                $("#renderarticle").css("display","none");
                $.ajax({
                    url: '{{url('admin/editcouponscate')}}',
                    dataType: "html",
                    type: "post",
                    data: {_method: 'post', _token: '{{csrf_token()}}', data: data, type: type,coupon: couponid}
                }).done(function(jsonData) {
                    $("#renderurl").css("display","block");
                    $('#url').html(jsonData);
                }).fail(function(jsonData) {
                    alert('error send data');
                });
            }
            if(data=="products"){
                $("#renderurl").css("display","none");

                $.ajax({
                    url: '{{url('admin/editurlproducts')}}',
                    dataType: "html",
                    type: "post",
                    data: {_method: 'post', _token: '{{csrf_token()}}', data: data, type: type, pon: couponid}
                }).done(function(jsonData) {
                    $("#renderarticle").css("display","block");
                    $('#article').html(jsonData);
                }).fail(function(jsonData) {
                    alert('error send data');
                });
            }
            if(data=="all"){
                $("#renderurl").css("display","none");
                $("#renderarticle").css("display","none");
            }
        });

        $('#enddate').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd',
            language: 'vn'
        });
    </script>
@endsection