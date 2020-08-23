@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý địa chỉ giao hàng</h1>
    </section>

    <section class="content">
        <!-- Default box -->

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới địa chỉ</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/members/address/create') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Người nhận hàng</label>
                            <input type="text" name="receiver_user" class="form-control" id="receiver_user">
                        </div>
                        <div class="form-group">
                            <label for="title">Điện thoại nhận hàng</label>
                            <input type="text" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="title">Địa chỉ giao hàng</label>
                            <input type="text" name="address" class="form-control" id="address">
                        </div>

                        <div class="form-group">
                            <label for="title">Tỉnh/Thành phố</label>
                            <select class="form-control select2" name="city" id="city">
                                <option value="0">Lựa chọn tỉnh thành phố</option>
                                @foreach($cates as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Chế độ</label>
                            <select class="form-control" name="is_primary" id="is_primary">
                                <option value="0">Dự phòng</option>
                                <option value="1">Chính thức</option>
                            </select>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách địa chỉ giao hàng</h3>
            </div>
            <div class="box-body">

                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Người nhận</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Tỉnh/Thành phố</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($address as $key=>$add)
                        <tr>
                            <td>{{ $key=1 }}</td>
                            <td>{{ $add->receiver_user }}</td>
                            <td>{{ $add->phone }}</td>
                            <td>{{ $add->address }}</td>

                            <td>{{ $add->cates->name }}</td>
                            <td>
                                @if($add->is_primary==1)
                                  Chính thức
                                @else
                                  Dự phòng
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/members/address/edit/'.$add->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>

                                <a data-title="Xác nhận xóa địa chỉ giao hàng!" data-body="Bạn có chắc chắn xóa địa chỉ giao hàng?" href="{{ url('admin/members/address/delete/'.$add->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                {{--   <button type="button" data-Banksid="{{ $product->id }}" data-Banksname="{{$product->name}}" data-Banksdeleteurl="{{ url('admin/Banks/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->

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
    </section><!-- /.content -->
@stop