@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý thuộc tính</h1>
    </section>

    <section class="content">
        <div class="col-md-6">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới thuộc tính</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/properties/create') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                        <div class="form-group">
                            <label for="title">Giá trị</label>
                            <input type="text" name="value" class="form-control" id="value">
                        </div>

                        <div class="form-group">
                            <label for="title">Danh mục thuộc tính</label>
                            <select class="form-control" name="categories">
                                @foreach($cates as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                </div>
            </form>

         </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gán thuộc tính cho danh mục</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ url('admin/properties/create/cates') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">

                        <div class="form-group">
                            <label for="title">Thuộc tính</label>
                            <select class="form-control" name="property" id="property">
                                <option value="0">Lựa chọn thuộc tính</option>
                                @foreach($cates as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" style="display: none" id="cateproducts">
                            <label for="title">Danh mục sản phẩm</label>
                            <select class="form-control" name="categories[]" multiple="multiple" style="height:200px;" id="rendercate">
                                <?php cate_parent($cates_products); ?>
                            </select>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-md-12">
        @foreach($properties as $key=>$properties)
        <!-- Default box -->
        <div class="col-sm-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Thuộc tính: <b>{{$key}}</b></h3>
                </div>
                <div class="box-body">

                    <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Giá trị</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(json_decode($properties) as $property)
                        <tr>
                            <td align="center"><b><font color="blue"> {{$property->value}}</font></b></td>
                            <td align="center"> @if($property->status==1)
                            Hiển thị
                            @else
                            Ẩn
                            @endif</td>
                            <td align="center">
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/properties/edit/'.$property->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>
                                <a data-title="Xác nhận xóa thuộc tính!" data-body="Bạn có chắc chắn xóa thuộc tính?" href="{{ url('admin/properties/delete/'.$property->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                {{--   <button type="button" data-propertiesid="{{ $product->id }}" data-propertiesname="{{$product->name}}" data-propertiesdeleteurl="{{ url('admin/properties/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>--}}
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.box -->
@endforeach
        </div>
</div>
        <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmproductsdeletion') }}</h4>
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
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script>
        $('#property').change(function(){
            var type = $('#property').val();
            if(type!="custom")
            {
                $("#renderdata").css("display","block");
                $("#renderlink").css("display","none");
            }else{
                $("#renderdata").css("display","none");
                $("#renderlink").css("display","block");
            }
        });
    </script>

    <script>
        $('#property').change(function(){
            var data = $('#property').val();
            if(data!=0)
            {
                $.ajax({
                    url: '{{url('admin/cateforproperty')}}',
                    dataType: "html",
                    type: "post",
                    data: {_method: 'post', _token: '{{csrf_token()}}', data: data}
                }).done(function(jsonData) {
                    $("#cateproducts").css("display","block");
                    $('#rendercate').html(jsonData);
                }).fail(function(jsonData) {
                    alert('error send data');
                });
            }else{
                $("#cateproducts").css("display","none");
            }
        });
    </script>

@endsection