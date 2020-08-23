@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/products/create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Danh mục sản phẩm</label>
                                    <select class="form-control" name="categories" multiple="multiple" style="height:200px;">
                                        <?php function_add($cates); ?>
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="col-md-6 form-group">
                                        <label for="title">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Mã sản phẩm</label>
                                        <input type="text" name="code" class="form-control" id="code">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Số lượng</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="title">Giá bán</label>
                                        <input type="text" name="price" class="form-control" id="price">
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
                                                <li class="active"><a href="#tab_1" data-toggle="tab"><b>Mô tả ngắn</b></a></li>
                                                <li><a href="#tab_2" data-toggle="tab"><b>Nội dung chi tiết</b></a></li>
                                                <li><a href="#tab_3" data-toggle="tab"><b>Ảnh sản phẩm</b></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                                        <textarea class="form-control" id="short" type="text" name="short" rows="5"/></textarea>
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
                                                        <textarea class="form-control" id="long" type="text" name="long" rows="5"/></textarea>
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
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>

            <!-- /.box -->

    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script>
        ckeditor('long');
        ckeditor('short');
    </script>
    <script>
        $("#images").fileinput({
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
@endsection