@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('VNPCMS.pages.titles.'.$group) }}</h1>
    </section>
        <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa thông tin bài viết {{$content->name}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/articles/'.$group.'/edit/'.$article->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-7">
                                    <select class="form-control" name="categories" multiple="multiple" style="height:200px;">
                                        <?php product_categories($category,0,"--",$article); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <img src="{{asset('public/images/articles/'.$group.'/'.$article->id.'/'.$article->images)}}" height="120">
                                </div>

                            </div>
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" name="name" class="form-control" value="{{$article->name}}">
                                </div>

                            <div class="form-group {{ $errors->has('keywords') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Thẻ Keywords</label>
                                <textarea class="form-control" id="keywords" type="text" name="keywords" rows="2"/>{{$article->keywords}}</textarea>
                                @if ($errors->has('keywords'))
                                    <span class="help-block">
												<strong>{{ $errors->first('keywords') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Thẻ Description</label>
                                <textarea class="form-control" id="description" type="text" name="description" rows="3"/>{{$article->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
												<strong>{{ $errors->first('description') }}</strong>
											</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Tóm tắt sơ lược</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="5"/> {{$article->short}}</textarea>
                                @if ($errors->has('short'))
                                    <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('long') ? ' has-error' : ' has-feedback' }}">
                                <label for="title">Nội dung</label>
                                <textarea class="form-control" id="long" type="text" name="long" rows="5"/>{{$article->long}}</textarea>
                                @if ($errors->has('long'))
                                    <span class="help-block">
												<strong>{{ $errors->first('long') }}</strong>
											</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title">File đính kèm</label>
                                {!! Form::file('input-files[]', array('multiple'=>true,'class'=>'file-loading','id'=>'input-files') )!!}
                            </div>
                            <div class="box-body">

                                <table id="attachments"  class="table table-bordered">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên file</th>
                                        <th>Loại file</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    <tbody>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            @foreach( $files_images as $index=>$file )
                                                <tr id="{{\Illuminate\Support\Facades\File::name('files/'.$file)}}">
                                                    <td>{{$index+1}}</td>
                                                    <td> {{\Illuminate\Support\Facades\File::name('files/'.$file)}}. {{\Illuminate\Support\Facades\File::extension('files/'.$file)}}</td>
                                                    <td class="hidden-xs">
                                                        {{\Illuminate\Support\Facades\File::extension('files/'.$file)}}
                                                    </td>

                                                    <td class="text-right">
                                                        <a class="btn-group  btn-danger btn-xs" onclick="ajax_dl_files('{{$file}}','{{\Illuminate\Support\Facades\File::name('files/'.$file)}}')"><i class="fa fa-trash-o"></i> Xóa </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </div>
                                    </div>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                <input type="number" name="order" class="form-control" id="order" value="{{$article->order}}" min="1">
                            </div>
                            <div class="form-group">
                                <label for="title">Trạng thái</label>
                                <input type="radio" name="status"  id="status" value="1" @if($article->status==1) checked @endif> Hiện
                                <input type="radio" name="status"  id="status" value="0" @if($article->status==0) checked @endif> Ẩn
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm lại</button>
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
            maxFileSize: 20000,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải Files',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png","pdf","docx","xlsx","xls","doc"]
        });
    </script>
    <script>
        function ajax_dl_files(url,id) {
            $.ajax({
                url: '{{url('admin/article/files_delete')}}',
                type: 'post',
                cache: false,
                data: {_method: 'delete',_token: '{{csrf_token()}}',link: url},
                success: function(data){
                    $('#attachments #'+ id).remove();
                }
            });
        };
    </script>
@endsection