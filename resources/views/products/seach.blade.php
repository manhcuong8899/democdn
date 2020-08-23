@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý sản phẩm</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tìm kiếm sản phẩm</h3>
            </div>
            <form role="form" action="{{ url('admin/products/seach') }}" method="GET" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Danh mục sản phẩm</label>
                                <select class="form-control" name="categories">
                                    <?php function_add($cates); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Thông tin sản phẩm</label>
                                <input type="text" name="nameseach" class="form-control" placeholder="Nhập Tên, Mã, nhãn hiệu sản phẩm">
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer" align="center">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </form>

        </div>
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách kết quả tìm kiếm sản phẩm</h3>
            </div>
            <div class="box-body">
                @can('product_management')
                    <a class="btn btn-success btn-md" href="{{url('admin/create/products')}}">
                        <i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
                    </a>
                @endcan
                <br style="clear:both;">
                <br style="clear:both;">
                @can('product_management')
                    <table  class="table table-responsive table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>
                            <th>{{ trans('VNPCMS.forms.tables.columns.code') }}</th>
                            <th>{{ trans('VNPCMS.forms.tables.columns.name') }}</th>
                            <th>Nhãn hiệu</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            @can('product_management')
                                <th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $products as $product )
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->code}}</td>
                                <td>{{ $product->name }}</td>
                                {{-- <td>
                                     {{ $product->cates->name }}
                                 </td>--}}

                                    <td><input class="form-control" value="{{ $product->size}}" id="price{{$product->id}}" style="width: 100px"></td>

                                    <td><input class="form-control" value="{{ $product->quantity}}" id="quantity{{$product->id}}" style="width: 65px"></td>

                                <td>
                                    @can('product_management')
                                        @if($product->isaProduct($product->slug_name)==true)
                                            <a data-productname="{{$product->name}}" data-productid="{{$product->id}}" data-updaterurl="{{url('admin/products/aupdate/'.$product->id)}}" title="Cập nhật sản phẩm" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#aUpdateDialog">
                                                <i class="fa fa-edit text-blue"></i>Cập nhật
                                            </a>
                                            <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/products/edit/'.$product->id)}}">
                                                <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                            </a>
                                            <button type="button" data-productid="{{ $product->id }}" data-productname="{{$product->name}}"  data-productdeleteurl="{{ url('admin/products/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="Xóa sản phẩm"></i></button>
                                        @else
                                            <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/products/listdetail/'.$product->slug_name)}}">
                                                <i class="fa fa-eye text-blue"></i>Xem
                                            </a>
                                            <button type="button" data-productid="{{ $product->id }}" data-productname="{{$product->name}}"  data-productdeleteurl="{{ url('admin/products/deleteall/'.$product->slug_name) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="Xóa toàn bộ"></i></button>
                                        @endif
                                    @endcan</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{ trans('VNPCMS.forms.tables.columns.id') }}</th>

                            <th>{{ trans('VNPCMS.forms.tables.columns.name') }}</th>

                            <th>{{ trans('VNPCMS.forms.tables.columns.status') }}</th>
                            <th>{{ trans('VNPCMS.forms.tables.columns.createdat') }}</th>
                            @can('product_management')
                                <th>{{ trans('VNPCMS.forms.tables.columns.action') }}</th>
                            @endcan
                        </tr>
                        </tfoot>
                    </table>
                @endcan
                <div class="pagination-wrap">
                    <ul>
                        {!! $products->render() !!}
                    </ul>
                </div><!-- /.pagination-wrap -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        @can('product_management')
            <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Xác nhận xóa sản phẩm</h4>
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
        @endcan
        <div class="modal fade" tabindex="-1" role="dialog" id="aUpdateDialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Xác nhận cập nhật sản phẩm</h4>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn cập nhận sản phẩm <b><span id="productname"></span></b>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
                        {!! Form::open(['method' => 'UPDATE', 'id'=>'aupdate']) !!}
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-edit"></i> Cập nhật</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </section><!-- /.content -->
@stop