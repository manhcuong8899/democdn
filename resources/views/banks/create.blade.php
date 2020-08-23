@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý ngân hàng</h1>
    </section>
        <section class="content">
            <div align="center">
                <a class="btn btn-success btn-md" href="{{url('admin/banks')}}">
                    <i class="fa fa-list"></i> Danh sách tài khoản
                </a>
                <a class="btn btn-success btn-md" href="{{url('admin/cate/banks')}}">
                    <i class="fa fa-list"></i> Danh sách ngân hàng
                </a>
                <br style="clear:both;">
                <br style="clear:both;">
            </div>
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới tài khoản</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/banks/create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Ngân hàng</label>
                                    <select class="form-control select2" name="categories">
                                        @foreach($cates as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Số tài khoản</label>
                                        <input type="text" name="banknumber" class="form-control" id="banknumber">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Tên tài khoản</label>
                                        <input type="text" name="accountbank" class="form-control" id="accountbank">
                                    </div>

                                <div class="form-group">
                                    <label for="title">Chi nhánh</label>
                                    <input type="text" name="branch" class="form-control" id="branch">
                                </div>

                                <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" value="1" min="1">
                            </div>

                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                        </div>
                        </div>
                    </form>


            <!-- /.box -->
    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script>
        $(".select2").select2();
    </script>
    <script>
        var btnCust = '';
        $("#Banks").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
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
        $("#input-image").fileinput({
            uploadUrl: "{{url('Banks/articles/')}}",
            uploadAsync: true,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>
@endsection