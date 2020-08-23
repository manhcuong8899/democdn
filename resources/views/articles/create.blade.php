@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('VNPCMS.pages.titles.'.$group) }}</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tạo mới bài viết {{$content->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/articles/create/'.$group) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-7">
                                    <label for="title">Danh mục</label>
                                    <select class="form-control" name="categories" multiple="multiple" style="height:200px;">
                                        <?php function_add($cates); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Hình ảnh</label>
                                    <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>

                            <div class="form-group {{ $errors->has('keywords') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Thẻ Keywords</label>
                                <textarea class="form-control" id="keywords" type="text" name="keywords" rows="2"/></textarea>
                                @if ($errors->has('keywords'))
                                    <span class="help-block">
												<strong>{{ $errors->first('keywords') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Thẻ Description</label>
                                <textarea class="form-control" id="description" type="text" name="description" rows="3"/></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Tóm tắt sơ lược</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="4"/></textarea>
                                @if ($errors->has('short'))
                                    <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('long') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Nội dung</label>
                                <textarea class="form-control" id="long" type="text" name="long"/></textarea>
                                @if ($errors->has('long'))
                                    <span class="help-block">
												<strong>{{ $errors->first('long') }}</strong>
											</span>
                                @endif
                            </div>

                           {{-- <div class="form-group">
                                <label for="title">File đính kèm</label>
                                {!! Form::file('input-files[]', array('multiple'=>true,'class'=>'file-loading','id'=>'input-files') )!!}
                            </div>--}}
                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" value="1" min="1">
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
        $("#input-files").fileinput({
            uploadUrl: "{{url('files/articles/')}}",
            uploadAsync: true,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png","pdf","docx","xlsx","xls","doc"]
        });
    </script>
@endsection