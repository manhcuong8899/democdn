@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý Góp ý</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Trả lời Góp ý</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/feedback/reply') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" value="{{$feedback->title}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Người gửi</label>
                            <input type="text"  class="form-control" id="title" value="{{$feedback->name}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text"  class="form-control" id="title" value="{{$feedback->email}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Điện thoại liên hệ</label>
                            <input type="text"  class="form-control" id="title" value="{{$feedback->phone}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Nội dung</label>
                            <textarea class="form-control" id="content" type="text"  rows="5" disabled/>{{$feedback->content}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="title"><font style="color: #ff0000;">Trà lời nội dung góp ý</font> </label>
                            <textarea class="form-control" id="reply" type="text" name="reply" rows="5"/>{{$feedback->reply}}</textarea>
                            <input type="hidden" name="feedbackid" value="{{$feedback->id}}">
                        </div>
                        <div class="form-group" align="center">
                            <button type="submit" class="btn btn-primary">Trả lời</button>
                            <button type="reset" class="btn btn-defaut">Làm lại</button>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Danh sách chưa trả lời</b></h3>
                    </div>
                    <div class="box-body">

                        <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                            <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Tiêu đề góp ý</th>
                                <th>Ngày gửi</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedbacks as $key=>$value)
                                <tr>
                                    <td><b> {{$key+1}}</b></td>
                                    <td>  {{$value->title}}</td>
                                    <td>  {{$value->created_at}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/feedback/view/'.$value->id)}}">
                                            <i class="fa fa-edit text-blue"></i>Trả lời
                                        </a>
                                        <a data-title="Xác nhận xóa góp ý!" data-body="Bạn có chắc chắn xóa góp ý?" href="{{ url('admin/feedback/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>
        </div>
    </section><!-- /.content -->
@endsection
