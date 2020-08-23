@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý thông báo</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa thông báo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/notification/edit/'.$notification->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề thông báo</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{$notification->title}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Nội dung</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="5"/>{{$notification->short}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">Nội dung</label>
                                <textarea class="form-control" id="content" type="text" name="content" rows="9"/>{{$notification->content}}</textarea>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" align="center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-defaut">Làm lại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section><!-- /.content -->
    @endsection
@section('footerscripts')
    <script>
        ckeditor('content');
    </script>
@endsection