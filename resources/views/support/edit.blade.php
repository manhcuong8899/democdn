@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý hỗ trợ các tuyến vận chuyển</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa thông tin hỗ trợ</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/support/edit/'.$support->id) }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tên hỗ trợ</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$support->name}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Điện thoại</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{$support->phone}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Skype</label>
                                <input type="text" name="skype" class="form-control" id="skype" value="{{$support->skype}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{$support->email}}">
                            </div>

                            <div class="form-group">
                             {{--   <label for="title">Mã cấu hình</label>--}}
                                <input type="hidden" name="code" class="form-control" id="code" value="{{$support->phone}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Tuyến vận chuyển</label>
                                <select class="form-control" name="categories">
                                    <option value="{{$support->cate_id}}">{{$support->cates->name}}</option>
                                    @foreach($addcates as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
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
            <div class="col-md-12">
                <!-- Default box -->
                @foreach($cates as $value)
                    <!-- Default box -->
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>{{$value->name}}</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên hỗ trợ</th>
                                        <th>Điện thoại</th>
                                        <th>Email</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supports[$value->id] as $support)

                                        <tr>
                                            <td><b> {{$support->name}}</b></td>
                                            <td>  {{$support->phone}}</td>
                                            <td>  <font color="blue">{{$support->email}}</font></td>
                                            <td align="center">
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/support/edit/'.$support->id)}}">
                                                    <i class="fa fa-edit text-blue"></i>Sửa
                                                </a>
                                                <a data-title="Xác nhận xóa hỗ trợ tuyến!" data-body="Bạn có chắc chắn xóa hỗ trợ?" href="{{ url('admin/support/delete/'.$support->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="Xóa"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->
                @endforeach
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmproductsdeletion') }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="productname"></span></b>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
                            {!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('VNPCMS.forms.buttons.delete') }}</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

        </div>
    </section><!-- /.content -->
@endsection