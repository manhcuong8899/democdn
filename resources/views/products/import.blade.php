@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý sản phẩm</h1>
    </section>
        <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nhập liệu/ Sửa đổi nhanh bằng Excel</h3>
                    </div>
                    <!-- /.box-header -->
                <div class="row">
                    <!-- left column -->
                    <form role="form" class="form-horizontal" method="post" action="{{url('admin/products/import')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">

                                <div class="box-body">

                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Danh mục sản phẩm</label>
                                                    <select class="form-control" name="categories" multiple="multiple" style="height:240px;">
                                                        <?php function_add($cates); ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                    <div class="col-md-12">
                                        <input type="file" name="input_file" class="file-loading" id="input_file">
                                    </div>


                                </div>
                                <div class="box-footer" align="right">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    <button type="reset" class="btn btn-default">Làm lại</button>
                                </div>

                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                    </form>
                    <!-- right column -->
                </div>   <!-- /.row -->


            <!-- /.box -->
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>

    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        $("#input_file").fileinput({
            uploadUrl: "{{url('')}}",
            uploadAsync: true,
            showUpload: false,
            browseLabel: 'Tải file',
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: null, // set to empty, null or false to disable preview for all types
            previewFileIconSettings: {
                'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                'htm': '<i class="fa fa-file-code-o text-info"></i>',
                'txt': '<i class="fa fa-file-text-o text-info"></i>',
                'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
                'mp3': '<i class="fa fa-file-audio-o text-warning"></i>'
            },
            previewFileExtSettings: {
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function(ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function(ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function(ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function(ext) {
                    return ext.match(/(php|js|css|htm|html)$/i);
                },
                'txt': function(ext) {
                    return ext.match(/(txt|ini|md)$/i);
                },
                'mov': function(ext) {
                    return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                },
                'mp3': function(ext) {
                    return ext.match(/(mp3|wav)$/i);
                }
            }
        });
    </script>


@endsection