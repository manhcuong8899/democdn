@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Gửi khiếu nại đơn hàng: {{$order->code}}</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gửi khiếu nại đơn hàng: {{$order->code}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('order/complaints/'.$order->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>

                            <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Nội dung khiếu nại</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="4"/></textarea>
                                @if ($errors->has('short'))
                                    <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title">File đính kèm</label>
                                <div class="col-sm-12">
                                    <input id="input-file" name="input-file[]" multiple type="file" class="file-loading">
                                </div>
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
    </script>
    <script>
        CKEDITOR.replace('short',{
            toolbar:[
                ['Source','-','NewPage','Preview','-','Templates'],
                ['Styles','Format','Font','FontSize'],
                ['TextColor','BGColor'],
            ]
        });
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
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>

    <script>
        $("#input-file").fileinput({
            uploadAsync: true,
            showUpload: false,
            browseLabel: 'Chọn file',
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