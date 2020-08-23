@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý sản phẩm</h1>
    </section>
        <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa thông tin sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/products/update/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Danh mục sản phẩm</label>
                                    <select class="form-control" name="categories" multiple="multiple" style="height:200px;">
                                        <?php product_categories($category,0,"--",$product); ?>
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="col-md-6 form-group">
                                        <label for="title">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Mã sản phẩm</label>
                                        <input type="text" name="code" class="form-control" id="code" value="{{$product->code}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Số lượng</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" value="{{$product->quantity}}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Giá bán</label>
                                        <input type="text" name="price" class="form-control" id="price" value="{{$product->price}}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="1" selected>Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Thứ tự</label>
                                        <input type="number" name="order" class="form-control" id="order" value="1" min="1">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Mô tả ngắn</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Nội dung chi tiết</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Ảnh sản phẩm</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="title">Sơ lược sản phẩm</label>
                                                    <textarea class="form-control" id="short" type="text" name="short" rows="5"/>{{$product->short}}</textarea>
                                                    @if ($errors->has('short'))
                                                        <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">

                                                <div class="form-group {{ $errors->has('long') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="title">Chi tiết sản phẩm</label>
                                                    <textarea class="form-control" id="long" type="text" name="long" rows="5"/>{{$product->long}}</textarea>
                                                    @if ($errors->has('long'))
                                                        <span class="help-block">
												<strong>{{ $errors->first('long') }}</strong>
											</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_3">
                                                <div class="form-group">
                                                    @foreach($files_images as $url)
                                                        <div class="col-md-2 col-sm-3 col-xs-3 thumb" id="{{File::name('images/'.$url)}}">
                                                            <div class="close_images">
                                                                <a onclick="ajax_dl_images('{{$url}}','{{File::name('images/'.$url)}}')"><i class="fa fa-times"></i></a>
                                                            </div>
                                                            <a class="thumbnail">
                                                                <img class="img-responsive" src="{{asset('public/images/'.$url)}}">
                                                            </a>

                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::file('input-image[]', array('multiple'=>true,'class'=>'file-loading','accept'=>'image/*','id'=>'input-image') )!!}
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Sửa đổi</button>
                            <button type="reset" class="btn btn-default">Làm lại</button>
                        </div>
                    </form>
                </div>

            <!-- /.box -->

    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>

    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('short');
            CKEDITOR.replace('long');
        };
    </script>

    <script>

        var btnCust = '';
        $("#images").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: ' &nbsp;&nbsp;Ảnh đại diện',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',

            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","png","jpeg"]
        });
    </script>

    <script>
        $("#input-image").fileinput({
            uploadUrl: "{{url('images/articles/')}}",
            uploadAsync: true,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png","jpeg"]
        });
    </script>

    <script>
        function ajax_dl_images(url, id) {
            $.ajax({
                url: '{{url('admin/products/ajax_images')}}',
                type: 'post',
                cache: false,
                data: {_method: 'delete',_token: '{{csrf_token()}}',link: url},
                success: function(data){
                    $('#'+id).hide();
                    console.log(data);
                }
            });
        };
    </script>
@endsection