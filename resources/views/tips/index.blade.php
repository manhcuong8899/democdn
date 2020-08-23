@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý Tips chạy quảng cáo</h1>
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm mới tiêu điểm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ url('admin/tips/create') }}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <input type="file" id="images" name="images" class="file-loading" accept="image/*">
                        </div>

                        <div class="form-group {{ $errors->has('short') ? ' has-error' : ' has-feedback' }}">
                            <label for="title">Mô tả</label>
                            <textarea class="form-control" id="short" type="text" name="short" rows="5"/></textarea>
                            @if ($errors->has('short'))
                                <span class="help-block">
												<strong>{{ $errors->first('short') }}</strong>
											</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">Liên kết</label>
                            <input type="text" name="url" class="form-control" id="url">
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
        <form role="form" action="{{ url('admin/tips/order')}}" method="POST" enctype="multipart/form-data">
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
                        <th>Tiêu đề</th>
                        <th>Liên kết</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tips as $key=>$tip )
                        <tr>
                            <td><input class="form-control" value="{{$tip->order}}" name="{{'order['.$tip->id.']'}}" style="width: 50px"> </td>

                            <td>{{ $tip->name }}</td>
                            <td>{{ $tip->url }}</td>
                            <td>
                                @if($tip->status==1)
                                    Sử dụng
                                    @else
                                    Ngừng sử dụng
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/tips/edit/'.$tip->id)}}">
                                    <i class="fa fa-edit text-blue"></i>{{ trans('VNPCMS.forms.titles.edit') }}
                                </a>

                                <a data-title="Xác nhận xóa Tips!" data-body="Bạn có chắc chắn xóa Tips?" href="{{ url('admin/tips/delete/'.$tip->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                             {{--   <button type="button" data-Banksid="{{ $product->id }}" data-Banksname="{{$product->name}}" data-Banksdeleteurl="{{ url('admin/Banks/delete/'.$product->id) }}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmProductsDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></button>--}}
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
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script>

        var btnCust = '';
        $("#images").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',

            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>

    <script>
        $("#input-image").fileinput({
            uploadUrl: "{{url('images/articles/')}}",
            uploadAsync: true,
            maxFileCount: 5,
            validateInitialCount: true,
            browseLabel: ' &nbsp;&nbsp;Tải ảnh',
            overwriteInitial: false,
            showUpload: false,
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>
@endsection