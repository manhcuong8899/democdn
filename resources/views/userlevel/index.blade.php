@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý cấu hình chiết khấu theo cấp độ thành viên</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới cấu hình</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/userlevel/create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tên cấu hình</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>

                            <div class="form-group">
                                <label for="title">Mã cấu hình</label>
                                <input type="text" name="code" class="form-control" id="code">
                            </div>
                            <div class="form-group">
                                <label for="title">Giá trị</label>
                                <input type="text" name="value" class="form-control" id="value">
                            </div>

                            <div class="form-group">
                                <label for="title">Danh mục cấp độ</label>
                                <select class="form-control" name="categories">
                                    @foreach($cates as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
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
                @foreach($cates as $value)
                    <!-- Default box -->
                    <div class="col-sm-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>{{$value->name}}</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên cấu hình</th>
                                        <th>Mã cấu hình</th>
                                        <th>Giá trị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userlevels[$value->id] as $ulevel)

                                        <tr>
                                            <td><b> {{$ulevel->name}}</b></td>
                                            <td align="center">  {{$ulevel->code}}</td>
                                            <td align="center">  <font color="blue">{{$ulevel->value}}%</font></td>
                                            <td align="center">
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/userlevel/edit/'.$ulevel->id)}}">
                                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                                </a>
{{--
                                                <a data-title="Xác nhận xóa cấu hình!" data-body="Bạn có chắc chắn xóa cấu hình?" href="{{ url('admin/userlevel/delete/'.$ulevel->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
--}}
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