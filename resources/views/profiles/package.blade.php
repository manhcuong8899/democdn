@extends('layouts.profiles')

@section('profiles')
    <!-- Main content -->
    <section class="content">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tìm kiếm đơn hàng</h3>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/wait')}}">Chờ xử lý<span class="badge"> {{$cuspackageInfo[8]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/needconfirmation')}}">Xác nhận lại<span class="badge"> {{$cuspackageInfo[9]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/tochinesewarehouse')}}">Đang về kho TQ<span class="badge"> {{$cuspackageInfo[10]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/chinesewarehouse')}}">Đến kho TQ<span class="badge"> {{$cuspackageInfo[11]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/tovietnamwarehouse')}}">Đang về VN<span class="badge"> {{$cuspackageInfo[12]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/vietnamwarehouse')}}">Đến kho VN<span class="badge"> {{$cuspackageInfo[13]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/delivered')}}">Đang giao hàng<span class="badge"> {{$cuspackageInfo[14]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/completed')}}">Đã nhận hàng<span class="badge"> {{$cuspackageInfo[15]}}</span></a></li>
                                        <li><a href="{{ url('admin/members/package/'.$user->email.'/cancelled')}}">Đã hủy<span class="badge"> {{$cuspackageInfo[16]}}</span></a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Default box -->
                            <div class="col-sm-12">
                                @foreach($packages as $package)
                                    <div class="item">
                                        <div class="top">
                                            <strong>Mã kiện: {{$package->code}}</strong>
                                            <span class="badge" style="background-color: {{$package->statusorder->color}}">{{$package->statusorder->name}}</span>
                                            <a href="{{url('package/changestatus?id='.$package->id)}}" class="btn btn-xs btn-default btn-flat">
                                                <i class="fa fa-edit text-blue"></i> Chuyển Trạng thái
                                            </a>
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Mã đơn hàng</td>
                                                <td>Loại hàng</td>
                                                <td>Cân nặng</td>
                                                <td>Tổng phí</td>
                                            </tr>
                                            <tr>
                                                <td><b></b></td>
                                                <td>Hàng ký gửi</td>
                                                <td>Đang chờ</td>
                                                <td><span class="price">0<em>đ</em></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            <a  class="detail-link"><i class="fa fa-caret-right" aria-hidden="true"></i> Xem chi tiết sản phẩm</a>
                                        </div>
                                        <div>
                                            <a class="history-link" data-id='{{$package->id}}'>
                                                <i class="fa fa-caret-right" aria-hidden="true"></i> Lịch sử trạng thái kiện hàng
                                            </a>
                                            <table class="sticky-enabled tableheader-processed sticky-table " style="display: none;">
                                                <tbody>
                                                <tr>
                                                    <th>Ngày thay đổi</th>
                                                    <th>Nhân viên</th>
                                                    <th>Tình trạng</th>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                @endforeach
                            </div><!-- /.box -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
    </section><!-- /.content -->
@stop