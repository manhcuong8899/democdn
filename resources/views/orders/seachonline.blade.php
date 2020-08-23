@extends('layouts.orders')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Kết quả tìm kiếm {{$type->name}}</h3>
                            </div>
                            <div class="box-body">

                                <table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Giá trị</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($seachs as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->code}}</td>
                                            <td>  {{$value->full_name}}</td>
                                            <td>  {{number_format($value->total+$value->freight-$value->discount,'0',',','.')}}đ</td>
                                            <td>  {{$value->orderstatus->name}}</td>
                                            <td>
                                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/view/order/'.$value->id)}}">
                                                    <i class="fa fa-eye text-blue"></i> Xem chi tiết
                                                </a>
                                                @can('orderonline_management')
                                                <a data-code="{{$value->code}}" data-status="{{$value->status}}"  data-orderurl="{{url('admin/movestatus/order/'.$value->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#StatusDialog">
                                                    <i class="fa fa-edit text-blue"></i> Chuyển Trạng thái
                                                </a>
                                                @if($value->orderstatus->code == 'cancelled')
                                                    <a data-title="Xác nhận xóa đơn hàng!" data-body="Bạn có chắc chắn xóa đơn hàng?" href="{{ url('admin/delete/order/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                                @endif
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->

    </section><!-- /.content -->
    @stop
