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
                        <h3 class="box-title">Thêm mới thông báo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/notification/create/'.$type->group.'/'.$type->code) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tiêu đề thông báo</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>

                            <div class="form-group">
                                <label for="title">Sơ lược</label>
                                <textarea class="form-control" id="short" type="text" name="short" rows="5"/></textarea>
                            </div>

                            <div class="form-group">
                                <label for="title">Nội dung</label>
                                <textarea class="form-control" id="content" type="text" name="content" rows="9"/></textarea>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" align="center">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                                <button type="reset" class="btn btn-defaut">Làm lại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
            <div class="col-md-12">
                <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Danh sách thông báo</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Tiêu đề thông báo</th>
                                        <th>Nội dung</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notification as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->title}}</td>
                                            <td width="45%">  {!!$value->content!!}</td>
                                            <td>  {{$value->created_at}}</td>
                                            <td>
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/notification/'.$type->group.'/'.$type->code.'/edit/'.$value->id)}}">
                                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                                </a>

                                             {{--   <a data-code="{{$value->code}}" data-orderurl="{{url('admin/send/notification/'.$value->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#StatusDialog">
                                                    <i class="fa fa-edit text-blue"></i> Gửi thông báo
                                                </a>--}}

                                                <a data-title="Xác nhận xóa thông báo!" data-body="Bạn có chắc chắn xóa thông báo?" href="{{ url('admin/notification/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

            </div>
        </div>

        <!---- Modal chuyển trạng thái đơn hàng---->
        <div class="modal fade" tabindex="-1" role="dialog" id="StatusDialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Lựa chọn hình thức gửi thông báo</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'id'=>'FormStatus']) !!}
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="type">
                                            <option value="0">Lựa chọn nhóm nhận</option>
                                            <option value="11">Thông báo hệ thống</option>
                                            <option value="21">Nhóm thành viên Vàng</option>
                                            <option value="22">Nhóm thành viên Bạc</option>
                                            <option value="23">Nhóm thành viên Đồng</option>
                                            <option value="24">Nhóm thành viên Thông thường</option>
                                            <option value="40">Nhóm quản trị</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

    </section><!-- /.content -->
    @endsection
@section('footerscripts')
    <script>
        ckeditor('content');
    </script>
@endsection