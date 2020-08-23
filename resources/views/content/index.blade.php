@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cấu hình nội dung Website</h1>
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới nội dung</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/content/create') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Tên nội dung</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('code') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Mã nội dung</label>
                            <input type="text" name="code" class="form-control" id="code">
                            @if ($errors->has('code'))
                                <span class="help-block">
												<strong>{{ $errors->first('code') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('vn') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Link Tiếng Việt</label>
                            <input type="text" name="vn" class="form-control" id="vn">
                            @if ($errors->has('fa'))
                                <span class="help-block">
												<strong>{{ $errors->first('vn') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('fa') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Biểu tượng</label>
                            <input type="text" name="fa" class="form-control" id="fa">
                            @if ($errors->has('fa'))
                                <span class="help-block">
												<strong>{{ $errors->first('fa') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">Loại nội dung</label><br>
                            <input type="radio" name="category" id="category" value="1" checked> Websites <input type="radio" name="category" id="category" value="0"> Systems
                        </div>
                        <div class="form-group">
                            <label for="title">Trạng thái</label><br>
                            <input type="radio" name="status" id="status" value="1" checked> Kích hoạt <input type="radio" name="status" id="status" value="0"> Ngừng kích hoạt
                        </div>
                        <div class="form-group">
                            <label for="title">Thứ tự</label>
                            <input type="text" name="order" class="form-control" id="order" value="1">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer" align="center">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <form role="form" action="{{ url('admin/content/order')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách tiêu điểm</h3>
            </div>
            <div class="box-body">
                <br style="clear:both;">
                <br style="clear:both;">

                <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Nội dung</th>
                        <th>Mã nội dung</th>
                        <th>Link VN</th>
                        <th>Biểu tượng</th>
                        <th>Loại nội dung</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contents as $key=>$cont )
                        <tr>
                            <td><input class="form-control" value="{{$cont->order}}" name="{{'order['.$cont->id.']'}}" style="width: 50px"> </td>

                            <td>{{ $cont->name }}</td>
                            <td>{{ $cont->code }}</td>
                            <td>{{ $cont->vn }}</td>
                            <td>{{ $cont->fa }}</td>
                            <td>
                                <input class="form-control" value="{{$cont->category}}" name="{{'category['.$cont->id.']'}}" style="width: 50px">
                            </td>
                            <td>
                                <input class="form-control" value="{{$cont->status}}" name="{{'status['.$cont->id.']'}}" style="width: 50px">
                            </td>
                            <td>
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/content/edit/'.$cont->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>

                                <a data-title="Xác nhận xóa Tips!" data-body="Bạn có chắc chắn xóa Nội dung?" href="{{ url('admin/content/delete/'.$cont->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                           </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center"><button type="submit" class="btn btn-primary">Cập nhật</button> </td>
                    </tr>
                    </tbody>
                </table>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
            </form>

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
@section('footerscripts')
@endsection