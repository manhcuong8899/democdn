@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý hình ảnh</h1>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Tìm kiếm hình ảnh</h3>
            </div>
            <form role="form" action="{{ url('admin/images/seach') }}" method="GET" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <select class="form-control" name="categories">
                                @foreach($cates as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2"> <button type="submit" class="btn btn-primary">Tìm kiếm</button></div>
                        <div class="col-md-2"></div>
                    </div>

                </div>
                <!-- /.box-body -->
            </form>
        </div>

        <!-- Default box -->
        <form role="form" action="{{ url('admin/images/order')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách hình ảnh</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-success btn-md" href="{{url('admin/create/images')}}">
                    <i class="fa fa-plus"></i> {{ trans('VNPCMS.forms.buttons.addnew') }}
                </a>
                <br style="clear:both;">
                <br style="clear:both;">

                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Hình ảnh</th>
                        <th>Chủ đề</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $images as $img )
                        <tr>
                            <td><input class="form-control" value="{{$img->order}}" name="{{'order['.$img->id.']'}}" style="width: 50px"> </td>
                            <td>{{ $img->name }}</td>
                            <td><img src="{{asset('public/images/images/'.$img->cates->code.'/'.$img->images)}}" width="60" alt="{{$img->name}}"></td>
                            <td>{{ $img->cates->name }}</td>
                            <td>{{ $img->position }}</td>
                            <td>{{ $img->position }}</td>
                            <td>
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/images/edit/'.$img->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>

                                <a data-title="Xác nhận xóa chủ đề hình ảnh!" data-body="Bạn có chắc chắn xóa chủ đề?" href="{{ url('admin/images/delete/'.$img->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                             {{--   <button type="button" data-imagesid="{{ $product->id }}" data-imagesname="{{$product->name}}" data-imagesdeleteurl="{{ url('admin/images/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>--}}
                           </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7" align="center"><button type="submit" class="btn btn-primary">Cập nhật</button> </td>
                    </tr>
                    </tbody>
                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
            </form>
    </section><!-- /.content -->
@stop