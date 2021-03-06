@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý hình ảnh</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa đổi hình ảnh</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/images/edit/'.$image->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="title">Chủ đề</label>
                                    <select class="form-control" name="categories">
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @foreach($cates as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Vị trí</label>
                                    <select class="form-control" name="position">
                                        <option value="top" @if($image->position=='top') selected @endif>Phía trên cùng</option>
                                        <option value="center" @if($image->position=='center') selected @endif>Ở giữa trang</option>
                                        <option value="left" @if($image->position=='left') selected @endif>Bên trái trang</option>
                                        <option value="right" @if($image->position=='right') selected @endif>Bên phải trang</option>
                                        <option value="bottom" @if($image->position=='bottom') selected @endif>Phía dưới trang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Tiêu đề</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$image->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Liên kết</label>
                                        <input type="text" name="url" class="form-control" id="url" value="{{$image->url}}">
                                    </div>
                                <div class="form-group">
                                    <img src="{{asset('public/images/images/'.$image->cates->code.'/'.$image->images)}}" width="120">
                                </div>
                                    <div class="form-group">
                                        <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                                    </div>


                            <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Mô tả</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="5"/>{{$image->short}}</textarea>
                                @if ($errors->has('short'))
                                    <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                @endif
                            </div>



                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" value="1" min="1">
                            </div>

                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-defaut">Làm lại</button>
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

        var btnCust = '';
        $("#images").fileinput({
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
            uploadUrl: "{{url('images/articles/')}}",
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