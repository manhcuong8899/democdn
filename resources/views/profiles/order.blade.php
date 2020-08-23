@extends('layouts.profiles')

@section('profiles')
    <!-- Main content -->
    <section class="content">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Lọc đơn hàng</h3>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/waitquotation') }}">Chờ báo giá<span class="badge"> {{$cusorderInfo[1]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/waitdeposits') }}">Chờ đặt cọc<span class="badge"> {{$cusorderInfo[2]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/wasdeposits') }}">Đã đặt cọc<span class="badge "> {{$cusorderInfo[3]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/wasorder') }}">Đã đặt hàng <span class="badge "> {{$cusorderInfo[4]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/completed') }}">Đã hoàn thành<span class="badge "> {{$cusorderInfo[5]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/needconfirmation') }}">Cần xác nhận lại <span class="badge"> {{$cusorderInfo[6]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/order/'.$user->email.'/cancelled') }}">Đã hủy<span class="badge"> {{$cusorderInfo[7]}}</span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Default box -->
                            <div class="col-sm-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Danh sách đơn hàng</h3>
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
                                                    <td>
                                                        <a class="btn btn-xs btn-default btn-flat" href="{{url('order/show?id='.$value->id)}}">
                                                            <i class="fa fa-eye text-blue"></i> Xem
                                                        </a>
                                                        <a class="btn btn-xs btn-default btn-flat" href="{{url('order/mapOrderCart?id='.$value->id)}}">
                                                            <i class="fa fa-eye text-blue"></i> Sửa
                                                        </a>
                                                        <a href="{{url('order/changestatus?id='.$value->id)}}" class="btn btn-xs btn-default btn-flat">
                                                            <i class="fa fa-edit text-blue"></i> Chuyển Trạng thái
                                                        </a>
                                                        @if($value->statusorder->code == 'cancelled')
                                                            <a data-title="Xác nhận xóa đơn hàng!" data-body="Bạn có chắc chắn xóa đơn hàng?" href="{{ url('order/delete/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
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
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
    </section><!-- /.content -->
@stop