@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý thông báo</h1>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Danh sách góp ý</b></h3>
                            </div>
                            <div class="box-body">

                                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Tiêu đề góp ý</th>
                                        <th>Email góp ý</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày gửi</th>
                                        <th>Trả lời</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($feedback as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->title}}</td>
                                            <td>  {{$value->email}}</td>
                                            <td>  {{$value->phone}}</td>
                                            <td>  {{$value->created_at}}</td>
                                            <td>  @if($value->status=='reply'){{$value->updated_at}}@else Chưa trả lời @endif</td>
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