@extends('layouts.order')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý {{$type->name}}</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tìm kiếm {{$type->name}}</h3>
                    </div>
                </div>
            </div>

                    <!-- Default box -->
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Danh sách {{$type->name}}</h3>
                            </div>
                            <div class="box-body">

                                <table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Đặt cọc</th>
                                        <th>Còn nợ</th>
                                        <th>Khách hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($orders as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->code}}</td>
                                            <td>  {{number_format($value->cost,'0',',','.')}}</td>
                                            <td>  {{number_format($value->deposit,'0',',','.')}}</td>
                                            <td>  {{number_format($value->havepay,'0',',','.')}}</td>
                                            <td>  {{$value->customer->username}}</td>
                                            <td>  {{$value->orderstatus->name}}</td>
                                            <td>
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/view/order/'.$value->id)}}">
                                                    <i class="fa fa-eye text-blue"></i> Xem
                                                </a>
                                                <a data-code="{{$value->code}}" data-status="{{$value->status}}" data-orderurl="{{url('admin/movestatus/order/'.$value->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#StatusDialog">
                                                    <i class="fa fa-edit text-blue"></i> Chuyển Trạng thái
                                                </a>

                                                @if($value->orderstatus->code == 'cancelled')
                                                    <a data-title="Xác nhận xóa đơn hàng!" data-body="Bạn có chắc chắn xóa đơn hàng?" href="{{ url('admin/delete/order/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
    @endsection