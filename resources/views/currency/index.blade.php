@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý tỷ giá</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới tỷ giá</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/currency/create') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Tên tỷ giá</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="title">Mã tỷ giá</label>
                                <input type="text" name="code" class="form-control" id="code">
                            </div>
                            <div class="form-group">
                                <label for="title">Tỷ giá</label>
                                <input type="number" name="value" class="form-control" id="value">
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
            <div class="col-md-7">
                <!-- Default box -->
                    <!-- Default box -->
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Danh sách tỷ giá</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Tên tỷ giá</th>
                                        <th>Tỷ giá VNĐ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($currency as $key=>$value)

                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td width="40%">  {{$value->name}}</td>
                                            <td width="30%">  {{number_format($value->value,'0',',','.')}}</td>
                                            <td>
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/currency/edit/'.$value->id)}}">
                                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                                </a>
{{--
                                                <a data-title="Xác nhận xóa tỷ giá!" data-body="Bạn có chắc chắn xóa tỷ giá?" href="{{ url('admin/currency/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
    @endsection