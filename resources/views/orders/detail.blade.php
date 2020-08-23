@extends('layouts.ordersdetail')

@section('content')
    <!-- Content Header (Page header) -->


    <section class="content">
        <div class="row">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin chi tiết đơn hàng:</h3>
            </div>
            <div class="col-md-6">
            <div class="box">
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Người mua hàng</label>
                            <input type="email" class="form-control" disabled value="{{$order->full_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Điện thoại</label>
                            <input type="email" class="form-control" disabled value="{{$order->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ</label>
                            <input type="email" class="form-control" disabled value="{{$order->address}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình thức thanh toán</label>
                            <input type="email" class="form-control" disabled value="{{$order->typeCard}}">
                        </div>


                    </div>
                    <!-- /.box-body -->
                </form>
            </div><!-- /.box -->
            </div>

            <div class="col-md-6">
                <div class="box">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Người nhận hàng</label>
                                <input type="email" class="form-control" disabled value="{{$order->full_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Điện thoại thanh toán</label>
                                <input type="email" class="form-control" disabled value="{{$order->phonepay}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Điện thoại thanh toán khác</label>
                                <input type="email" class="form-control" disabled value="{{$order->phone2pay}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ thanh toán</label>
                                <input type="email" class="form-control" disabled value="{{$order->address}}">
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Thông tin đơn hàng: <b>{{$order->code}}</b> - Trạng thái:<font color="blue">{{$order->orderstatus->name}}</font> - Thanh toán:<font color="#ff0000">{{number_format($order->total+$order->freight-$order->discount,0,',','.')}}đ</font></h3>
                            </div>
                            <div class="box-body">
                                <table  class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($details as $key=>$value)
                                        <tr>
                                            <td><b> {{$key+1}}</b></td>
                                            <td>  {{$value->product->name}}</td>
                                            <td>  {{$value->quantity}}</td>
                                            <td>  {{$value->size}}</td>
                                            <td>  {{$value->color}}</td>
                                            <td>  {{number_format($value->price,'0',',','.')}}đ</td>
                                            <td>  {{number_format($value->price*$value->quantity,'0',',','.')}}đ</td>
                                        </tr>
                                    @endforeach

                                   <tr>
                                       <td colspan="6" align="right">Tổng chi phí</td>
                                       <td>{{number_format($order->total,0,',','.')}}đ</td>
                                   </tr>
                                   <tr>
                                       <td colspan="6" align="right">Giảm trừ</td>
                                       <td>{{number_format($order->discount,0,',','.')}}đ</td>
                                   </tr>
                                   <tr>
                                       <td colspan="6" align="right">Vận chuyển</td>
                                       <td>{{number_format($order->freight,0,',','.')}}đ</td>
                                   </tr>
                                   <tr>
                                       <td colspan="6" align="right"><b>Thanh toán</b></td>
                                       <td><font color="#ff0000">{{number_format($order->total+$order->freight-$order->discount,0,',','.')}}đ</font></td>
                                   </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->
        </div><!-- /.box -->
    </section><!-- /.content -->
    @endsection
@section('footerscripts')

    @endsection

